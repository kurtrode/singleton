<?php

require_once "DBBlackbox.php";
require_once "Song.php";
require_once 'Session.php';
require_once 'helpers.php';
//start session
$session = Session::instance();
var_dump($session);
//extract success message
$success_message = Session::instance()->get('success_message',null);
//delete success message
//unset($_SESSION['success_message']);
//extract error messages
$error_messages = Session::instance()->get('error_messages',[]);
//delete the error messages from the session
//unset($_SESSION['error_messages']);
// find the ID of the record we want to edit in the request
$id = $_GET['id'];
// somehow retrieve existing song from some storage
$song = find( $id, 'Song' );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include 'top-menu.php';?>
<?php if ($success_message) : ?>
    <style>
        .success-message{
            background-color: lightgreen;
            padding: 1em;
        }
        </style>
    <div class="success-message">
        <?= $success_message ?>
</div>
<?php endif; ?>
<?php if ($error_messages) : ?>
    <?php foreach ($error_messages as $input_name => $errors):?>
        <?php foreach ($errors as $error) : ?>
            <div class="error-message" style="background-color: red">
                <?= $error ?>
        </div>
        <?php endforeach?>
    <?php endforeach?>
    <?php endif; ?>
<body>
<form action="update.php?id=<?=$id?>" method="post">
<!-- display the form prefilled with entity data -->
Name:<br>
<input type="text" name="name" value="<?= htmlspecialchars((string)old('name',$song->name)) ?>"><br>
<br>
Author:<br>
<input type="text" name="author" value="<?= htmlspecialchars((string)old('author',$song->author)) ?>"><br>
<br>
Length:<br>
<input type="number" name="length" value="<?= htmlspecialchars((string)old('length',$song->length)) ?>"> seconds<br>
<br>
Album:<br>
<input type="text" name="album" value="<?= htmlspecialchars((string)old('album',$song->album)) ?>"><br>
<br>
<button type="submit">Save</button>
</form>
</body>
</html>