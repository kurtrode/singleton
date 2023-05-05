<?php

require_once "DBBlackbox.php";
require_once "Song.php";
require_once 'Session.php';
// start the session
session_start();

// prepare empty entity

$song = new Song;

 

// update entity from request

$song->name = $_POST['name'] ?? $song->name;

$song->author = $_POST['author'] ?? $song->author;

$song->length = $_POST['length'] ?? $song->length;

$song->album = $_POST['album'] ?? $song->album;

// ...

 

// somehow insert the entity into the database and generate a unique ID

// here done using DBBlackbox

$id = insert($song);
//$_SESSION['success-message'] = 'Song successfully inserted.';
Session::instance()->flash('success_message','Song successfully inserted.');

//redirect to edit
header('Location: edit.php?id='.$id);