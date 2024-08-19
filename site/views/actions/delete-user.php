<?php

$isAdmin = $_SESSION['user']['admin'] ?? false;
if (!$isAdmin) header('location: home.php');

require_once 'lib/db.php' ;

consoleLog($_POST);

$userID = $_GET['id'];

$db = connectToDB();

$query = 'DELETE FROM users WHERE id = ? '; 

try {
    $stmt = $db ->prepare($query);
    $stmt ->execute([$userID]);
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB insert', ERROR);
    die('There was an giving user admin');
}

header ('location: player');