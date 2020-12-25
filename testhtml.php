<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Document</title>
    <?php
        if (!isset($message)) {
            echo "in if";
            $message="BEFORE";
        }
    ?>
  </head>
  <body>
    <h1><?= $message ?></h1>
    <form method="POST" action="/testphp.php">
        <button type="submit">Submit</button>
    </form>
  </body>
</html>