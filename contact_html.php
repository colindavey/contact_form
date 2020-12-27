<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>contact test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <section class="m-5">
            <h1>Contact Colin Davey</h1>
            <form method="post" class="form-group">
                <div class="form-group">
                    <label for="name" >Name:</label>
                    <span id="name-warn" style="display:inline;color:red"> <?= $name_warning ?></span>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email address:</label>
                    <span id="emal-warn" style="display:inline;color:red"> <?= $email_warning ?></span>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                    <small id="emailHelp" class="form-text text-muted">Colin will never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <span id="subject-warn" style="display:inline;color:red"> <?= $subject_warning ?></span>
                    <input type="text" class="form-control" id="subject" name="subject" value="<?= $subject ?>">
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <span id="message-warn" style="display:inline;color:red"> <?= $message_warning ?></span>
                    <textarea type="text" class="form-control" id="message" name="message" rows="3"><?= $message ?></textarea>
                </div>

                <fieldset class="form-group">
                    <legend>Please check the boxes that apply:</legend>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="yes" name="robot_check" id="robot_check" <?= $robot_check ?>>
                        <label for="robot-check" class="form-check-label">I am a robot.</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="yes" name="not_robot_check" id="not_robot_check" <?= $not_robot_check ?>>
                        <label for="not_robot_check" class="form-check-label">I am a not robot.</label>
                        <span id="robot-warn" style="color:red"> <?= $robot_warning ?></span>
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        </section>
    </body>
</html>