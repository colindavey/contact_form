<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
    <h1>Contact Colin Davey</h1>
    <!-- <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"> -->
    <form method="post" >
        <label for="name" >Your name:</label>
        <span id="name-warn" style="display:inline;color:red"> <?= $name_warning ?></span>
        <br>
        <input type="text" id="name" name="name" value="<?= $name ?>">
        <!-- <input type="text" id="name" name="name" class="form-control"> -->
        <br><br>

        <label for="email">Your email address:</label>
        <span id="emal-warn" style="display:inline;color:red"> <?= $email_warning ?></span>
        <br>
        <input type="text" id="email" name="email" value="<?= $email ?>">
        <br><br>

        <label for="subject">Subject:</label>
        <span id="subject-warn" style="display:inline;color:red"> <?= $subject_warning ?></span>
        <br>
        <input type="text" id="subject" name="subject" value="<?= $subject ?>">
        <br><br>

        <label for="message">Message:</label>
        <span id="message-warn" style="display:inline;color:red"> <?= $message_warning ?></span>
        <br>
		<textarea type="text" id="message" name="message" rows="3"><?= $message ?></textarea>
        <br><br>

        <fieldset style="width:10em">
            <legend>Please check the boxes that apply:</legend>
            <div>
                <input type="checkbox" value="yes" name="robot_check" id="robot_check" <?= $robot_check ?>>
                <label for="robot-check">I am a robot.</label>
            </div>
            <div>
                <input type="checkbox" value="yes" name="not_robot_check" id="not_robot_check" <?= $not_robot_check ?>>
                <label for="not_robot_check">I am a not robot.</label>
            </div>
        </fieldset>
        <span id="robot-warn" style="color:red"> <?= $robot_warning ?></span>
        <br>

        <button type="submit">Submit</button>
    </form>
</body>