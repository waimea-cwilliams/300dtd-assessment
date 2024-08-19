<?php

$isAttending = $_SESSION['user']['attendance'] ?? false;
if (!$isAttending) header('location: home');

require_once 'lib/db.php' ;

consoleLog($_POST);

$userID = $_GET['id'];

$db = connectToDB();

$query = 'UPDATE users SET attendance = !attendance WHERE id = ?'; 
try {
    $stmt = $db ->prepare($query);
    $stmt ->execute([$userID]);
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB update', ERROR);
    die('There was an error removing from the database');
}

header ('location: home');