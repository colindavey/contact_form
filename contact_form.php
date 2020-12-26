<?php
$name_warning = $email_warning = $subject_warning = $message_warning = "";
$name = $email = $subject = $message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    $success = true;
    $_POST = array_map("trim", $_POST);

    list($name, $name_warning) = check_required_post_var("name");
    if (!empty($name_warning)) {
        $success = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        echo "in else<br>";
        $name_warning = "Only letters, apostrophes, dashes and white space allowed";
        $success = false;
    }

    list($email, $email_warning) = check_required_post_var("email");
    if (!empty($email_warning)) {
        $success = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_warning = "Invalid email format";
        $success = false;
    }

    list($subject, $subject_warning) = check_required_post_var("subject");
    if (!empty($subject_warning)) {
        $success = false;
    }

    list($message, $message_warning) = check_required_post_var("message");
    if (!empty($message_warning)) {
        $success = false;
    }
}

if ($success) {
    header("location: thank_you.php");
}

require "contact_html.php";

function check_required_post_var($var_name) {
    $value = $_POST[$var_name];
    return array(
        $value, 
        empty($value) ? "Required" : ""
    );
}