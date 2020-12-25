<?php
$name_msg = "";
$success = false;
// if(isset($_POST["submitted"])) 
if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    $success = true;
    if ($_POST["name"] === "") {
        $name_msg = "Required";
        $success = false;
    }
}
if ($success) {
    header("location: thank_you.php");
}
require("contact_html.php");