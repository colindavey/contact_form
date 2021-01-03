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
    $trimmed_post = trim_array($_POST);
    $error = required_field_check($required, $trimmed_post);

    //  Check if the name contains illegal characters
    if (!preg_match("/^[a-zA-Z-' ]*$/", $trimmed_post["name"])) {
        $error["name"] = "Only letters, apostrophes, dashes and white space allowed";
    }

    // If there is an email, check that it is valid
    if (!empty($trimmed_post["email"])) {
        if (!filter_var($trimmed_post["email"], FILTER_VALIDATE_EMAIL)) {
            $error["email"] = "Invalid email format";
        }
    }

    if (isset($trimmed_post["robot_check"]) || !isset($trimmed_post["not_robot_check"])) {
        $error["robot"] = !$robot_success ? "Robots may not email Colin Davey" : "";
    }

    // If successful, send mail and redirect to the thank-you page
    if (!$error) {
        $mailheader = 
            "From: $from_email\r\n".
            "Reply-To: ".$trimmed_post["name"]." <".$trimmed_post["email"].">\r\n"
        ;
        // $mailheader .= "CC: $email\r\n";
        mail($to_email, $trimmed_post["subject"], $trimmed_post["message"], $mailheader) or die("Error!");

        header("location: thank_you.php");
        exit;
    }
}

require "contact_html.php";