<?php
require_once "DBBlackbox.php";
require_once 'Session.php';
require_once "Song.php";
//start session
//session_start();
$id = $_GET['id'];
delete($id);
Session::instance()->flash('success-message',"Song was deleted.");
// redirect to list of songs
header('Location: list.php');