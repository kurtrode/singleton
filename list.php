<?php
require_once "DBBlackbox.php";
require_once 'Session.php';
require_once "Song.php";
//start session
session_start();
//extract success message
$success_message = $_SESSION['success-message'] ?? null;
//delete success message
unset($_SESSION['success-message']);
// retrieve all songs from database
$songs = select(null, null, "Song");?>
<?php include 'top-menu.php';?>
<?php if ($success_message) : ?>
    <style>
        .success-message{
            background-color: red;
            padding: 1em;
        }
        </style>
    <div class="success-message">
        <?= $success_message ?>
</div>
<?php endif; ?>
<ul>
    <?php foreach($songs as $song):?>
<li>
   <?= $song->name?><br>
   by <?= $song->author?><br>
   <?= $song->getLengthFormatted()?><br>
   Album: <?= $song->album?>
   <a href="edit.php?id=<?= $song->id?>">edit</a>
   <form action="delete.php?id=<?= $song->id?>" method="post" onsubmit ="if (!confirm('Really delete?')) return false;">
   <button>Delete</button>
    </form>
</li>
        <?php endforeach;?>
</ul>
