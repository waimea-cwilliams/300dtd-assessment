<?php

require_once 'lib/db.php';
require_once 'lib/debug.php';
consoleLog($_POST, 'Form Data') ;

$user = $_POST['ID'];
$name = $_POST['name'];
$desc = $_POST['description'];
$date = $_POST['date'];

$db = connectToDB() ;

$query = 'INSERT INTO events (user, name, description, date) VALUES(?, ?, ?, ?)' ;
$stmt = $db->prepare($query) ;
$stmt->execute([$user, $name, $desc, $date]) ;

header('HX-Redirect: ' . SITE_BASE . '/event');