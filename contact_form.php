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
$whitelist = ["name", "email", "subject", "message", "robot_check", "not_robot_check"];
$required = ["name", "email", "subject", "message"];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    validate_white_list($whitelist, $_POST);
    $_POST = trim_array($_POST);
    $error = required_field_check($required, $_POST);

    // If there is a name, check that it is valid
    if (!empty($_POST["name"])) {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) {
            $error["name"] = "Only letters, apostrophes, dashes and white space allowed";
        }
    }

    // If there is an email, check that it is valid
    if (!empty($_POST["email"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $error["email"] = "Invalid email format";
        }
    }

    $success = array_reduce($error, "is_success", true);

    // Handle the "are you a robot" checkboxes
    $robot_bool = isset($_POST["robot_check"]);
    $not_robot_bool = isset($_POST["not_robot_check"]);
    // Of the four possible combinations of the robot/not-robot checkboxes
    // (off/off off/on on/off on/on) the only allowed one is robot unchecked, 
    // and not-robot checked. 
    $robot_success = !$robot_bool && $not_robot_bool;
    $error["robot"] = !$robot_success ? "Robots may not email Colin Davey" : "";

    // Add "are you a robot" to the success calculation
    $success = $success && $robot_success;

    // If successful, send mail and redirect to the thank-you page
    if ($success) {
        $mailheader = 
            "From: $from_email\r\n".
            "Reply-To: $name <$email>\r\n"
        ;
        if (isset($_POST["cc_check"])) {
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