<?php
$name_warning = "";
$email_warning = "";
$subject_warning = "";
$message_warning = "";
$name = "";
$email = "";
$subject = "";
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    $success = true;
    $_POST = array_map("trim", $_POST);

    $name = $_POST["name"];
    if (empty($name)) {
        $name_warning = "Required";
        $success = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $name_warning = "Only letters, apostrophes, dashes and white space allowed";
        $success = false;
    }

    $email = $_POST["email"];
    if (empty($email)) {
        $email_warning = "Required";
        $success = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_warning = "Invalid email format";
        $success = false;
    }

    $subject = $_POST["subject"];
    if (empty($subject)) {
        $subject_warning = "Required";
        $success = false;
    }

    $message = $_POST["message"];
    if (empty($message)) {
        $message_warning = "Required";
        $success = false;
    }
}

if ($success) {
    header("location: thank_you.php");
}

require "contact_html.php";