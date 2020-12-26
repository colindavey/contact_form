<?php
$name_warning = $email_warning = $subject_warning = $message_warning = "";
$name = $email = $subject = $message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    // Doing trim in loop below instead.
    // $_POST = array_map("trim", $_POST);
    // Note: Map isn't able to create an associate array. There is a trick for doing it with reduce,
    // but this loop seems clearer. 
    // https://stackoverflow.com/questions/11563119/how-to-convert-an-array-of-arrays-or-objects-to-an-associative-array
    $result = array();
    foreach(["name", "email", "subject", "message"] as $var_name) {
        $value = trim($_POST[$var_name]);
        $result[$var_name] = array("value" => $value, "warning" => empty($value) ? "Required" : "");
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
    // Which is better? 
    $success = array_reduce($result, "is_success", true);
    // $success = array_reduce(
    //     $result, 
    //     function ($carry, $item) {
    //         return $carry && empty($item["warning"]);
    //     },
    //     true
    // );

    // Redirect to the thank-you page if successful
    if ($success) {
        header("location: thank_you.php");
    }
    // These assignments are so the html piece doesn't need longer array expressions.
    $name_warning = $result["name"]["warning"];
    $email_warning = $result["email"]["warning"];
    $subject_warning = $result["subject"]["warning"];
    $message_warning = $result["message"]["warning"];

    $name = $result["name"]["value"];
    $email = $result["email"]["value"];
    $subject = $result["subject"]["value"];
    $message = $result["message"]["value"];
}
require "contact_html.php";

function is_success($carry, $item) {
    return $carry && empty($item["warning"]);
}

function dd($var, $do_die=true) {
    var_dump($var);
    echo "<br>";
    if ($do_die) {
        die();
    }
}