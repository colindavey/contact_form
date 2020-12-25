<?php
$message = "BEFORE";
// if(isset($_POST["submitted"])) 
if ($_SERVER["REQUEST_METHOD"] === "POST")
{ 
    $message = "AFTER";
}
require("contact_html.php");