<?php

require_once 'lib/db.php';
require_once 'lib/debug.php';
consoleLog($_POST, 'Form Data') ;

$user = $_POST['user'];
$pass = $_POST['pass'];
$sur = $_POST['surname'];
$fore = $_POST['forename'];
$play = $_POST['player'];



$db = connectToDB() ;

$query = 'SELECT * FROM users WHERE username = ?' ;
$stmt = $db ->prepare($query) ;
$stmt->execute([$user]) ;
$userData = $stmt ->fetch() ;

$hash = password_hash($pass, PASSWORD_DEFAULT) ;

consoleLog($userData) ;

$query = 'INSERT INTO users (forename,surname,username,hash,player) VALUES(?, ?, ?, ?, ?)' ;
$stmt = $db->prepare($query) ;
$stmt->execute([$fore, $sur, $user, $hash, $play]) ;

header('HX-Redirect: ' . SITE_BASE . '/player');



   