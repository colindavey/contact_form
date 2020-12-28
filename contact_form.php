<?php
// secrets contains your email addresses, and is of the form:
//   $from_email = <from address>;
//   $to_email = <to address>;
// where the from address is where the email will be sent from, e.g. forms@domain.com
// and the to address is the recipient, e.g. support@domain.com. 
// Note that the customers address will be the Reply-To. 
require "secrets.php";
require "contact_functions.php";
require "utility_functions.php";
$name_warning = $email_warning = $subject_warning = $message_warning = "";
$name = $email = $subject = $message = "";
$robot_warning = $robot_check = $not_robot_check = "";
$cc_check = "";

if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    $_POST = trim_array($_POST);

    // Note: array_map() isn't able to create an associate array. There is a trick for doing it
    // with array_reduce(), but this loop seems clearer. 
    // https://stackoverflow.com/questions/11563119/how-to-convert-an-array-of-arrays-or-objects-to-an-associative-array
    $result = array();
    foreach(["name", "email", "subject", "message"] as $var_name) {
        $value = $_POST[$var_name];
        $result[$var_name] = array(
            "value" => $value, 
            "warning" => empty($value) ? "Required" : "",
            "safe" => html_escape($value)
        );
    }

    // If there is a name, check that it is valid
    if (empty($result["name"]["warning"])) {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $result["name"]["value"])) {
            $result["name"]["warning"] = "Only letters, apostrophes, dashes and white space allowed";
        }
    }

    // If there is an email, check that it is valid
    if (empty($result["email"]["warning"])) {
        if (!filter_var($result["email"]["value"], FILTER_VALIDATE_EMAIL)) {
            $result["email"]["warning"] = "Invalid email format";
        }
    }

    // Success means there are no warnings, ie, the warnings are all empty
    // Calculate success based on the above
    $success = array_reduce($result, "is_success", true);

    // These assignments are so the html piece doesn't need longer array expressions
    $name = $result["name"]["safe"];
    $email = $result["email"]["safe"];
    $subject = $result["subject"]["safe"];
    $message = $result["message"]["safe"];

    $name_warning = $result["name"]["warning"];
    $email_warning = $result["email"]["warning"];
    $subject_warning = $result["subject"]["warning"];
    $message_warning = $result["message"]["warning"];

    // Handle the "are you a robot" checkboxes
    list($robot_bool, $robot_check) = get_check("robot_check");
    list($not_robot_bool, $not_robot_check) = get_check("not_robot_check");
    $robot_success = !$robot_bool && $not_robot_bool;
    $robot_warning = !$robot_success ? "Robots may not email Colin Davey" : "";

    // Add "are you a robot" to the success calculation
    $success = $success && $robot_success;

    list($cc_bool, $cc_check) = get_check("cc_check");

    // Send mail and redirect to the thank-you page if successful
    if ($success) {
        $mailheader = 
            "From: $from_email\r\n".
            "Reply-To: $name <$email>\r\n"
        ;
        if ($cc_bool) {
            $mailheader .= "CC: $email\r\n";
        }
        // $summary=
        //     "Name: $name <br>
        //     Recipient: $to_email <br>
        //     Subject: $subject <br>
        //     Header: $mailheader <br>
        //     Message: $message";
        // dd($summary);
        mail($to_email, $subject, $message, $mailheader) or die("Error!");
        header("location: thank_you.php");
        exit;
    }
}

require "contact_html.php";