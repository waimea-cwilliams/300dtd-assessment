<?php

$isAdmin = $_SESSION['user']['admin'] ?? false;
if (!$isAdmin) header('location: home.php');

require_once 'lib/db.php' ;

consoleLog($_POST);

$userID = $_GET['id'];

$db = connectToDB();

$query = 'UPDATE users SET admin = !admin WHERE id = ?'; 

try {
    $stmt = $db ->prepare($query);
    $stmt ->execute([$userID]);
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB update', ERROR);
    die('There was an error removing from the database');
}

header ('location: player');