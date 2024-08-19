<?php

$isAdmin = $_SESSION['user']['admin'] ?? false;
if (!$isAdmin) header('location: home.php');

require_once 'lib/db.php' ;

consoleLog($_POST);

$id = $_GET['id'];

$db = connectToDB();

$query = 'DELETE FROM events WHERE id = ? '; 

try {
    $stmt = $db ->prepare($query);
    $stmt ->execute([$id]);
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB insert');
    die('There was an error deleting shift');
}

header ('location: event');