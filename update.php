<?php
require_once "DBBlackbox.php";
require_once "Song.php";
require_once 'Session.php';
//start session
$session = Session::instance();
// find the ID of the record we want to edit in the request
$id = $_GET['id'];
// somehow retrieve existing data from some storage
$song = find( $id, 'Song' );
//validation
//decalre everything is valid
$valid = true;
$error_messages = [];

if (trim($_POST['name']) === ''){
    // if name is empty
    $valid = false;
    // add error message
    $error_messages['name'][] = "Name is mandatory";
}
if (trim($_POST['author']) === ''){
    $valid = false;
    $error_messages['author'][] = "Author is mandatory";
}

if ($valid === false){
    // flash error messages
//$_SESSION['error_messages'] = $error_messages;
Session::instance()->flash('error_messages',$error_messages);
//flash incoming $POST data
Session::instance()->flashRequest();
    // redirect
header('Location: edit.php?id='.$id);
exit();

}
// update data from request
$song->name = $_POST['name'] ?? $song->name;
$song->author = $_POST['author'] ?? $song->author;
$song->length = $_POST['length'] ?? $song->length;
$song->album = $_POST['album'] ?? $song->album;
// ...
// somehow save the data into the database (using the unique ID)
update($id, $song);

Session::instance()->set('success_message','Song successfully updated.');
//$_SESSION['success-message'] = 'Song successfully updated.';
//redirect to edit
header('Location: edit.php?id='.$id);