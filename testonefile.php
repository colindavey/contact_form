<head>
    <meta charset="utf-8">
    <title>Document</title>
    <?php
        $message = "BEFORE";
        // if(isset($_POST["submitted"])) 
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        { 
            $message = "AFTER";
        }
    ?>
</head>
<body>
    <h1><?= $message ?></h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <!-- <button type="submit" name="submitted" value="yes">Submit</button> -->
        <button type="submit">Submit</button>
    </form>
</body>