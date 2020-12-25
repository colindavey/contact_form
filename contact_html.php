<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
    <h1>Contact Colin Davey</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name" class="">Your name:</label>
        <span id="name-warn" style="display:inline;color:red"> <?= $name_msg ?></span>
        <br>
        <input type="text" id="name" name="name" class="form-control">
        <br><br>

        <button type="submit">Submit</button>
    </form>
</body>