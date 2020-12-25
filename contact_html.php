<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
    <h1>Contact Colin Davey</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name" class="">Your name:</label>
        <span id="name-warn" style="display:inline;color:red"> <?= $name_warning ?></span>
        <br>
        <input type="text" id="name" name="name" class="form-control" value="<?= $name ?>">
        <br><br>

        <label for="email" class="">Your email address:</label>
        <span id="emal-warn" style="display:inline;color:red"> <?= $email_warning ?></span>
        <br>
        <input type="text" id="email" name="email" class="form-control" value="<?= $email ?>">
        <br><br>

        <label for="subject" class="">Subject:</label>
        <span id="subject-warn" style="display:inline;color:red"> <?= $subject_warning ?></span>
        <br>
        <input type="text" id="subject" name="subject" class="form-control" value="<?= $subject ?>">
        <br><br>

        <label for="message" class="">Message:</label>
        <span id="message-warn" style="display:inline;color:red"> <?= $message_warning ?></span>
        <br>
		<textarea type="text" id="message" name="message" rows="3" value="<?= $message ?>"></textarea>
        <br><br>

        <button type="submit">Submit</button>
    </form>
</body>