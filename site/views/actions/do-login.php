<?php

require_once 'lib/debug.php';
require_once 'lib/db.php' ;
consoleLog($_POST, 'Form Data');

$user = $_POST['username'];
$pass = $_POST['password'];

$db = connectToDB();

$query = 'SELECT * FROM users WHERE username = ?';
$stmt = $db ->prepare($query);
$stmt->execute([$user]);
$userData = $stmt ->fetch();

consoleLog($userData);

// Did we actually get a user account?
if ($userData) {

    // Have an account, so check password
    if (password_verify($pass, $userData['hash'])) {
        // We got here, so user and password both ok
        $_SESSION['user']['loggedIn'] = true ;
        $_SESSION['user']['username'] = $userData['username'] ;
        $_SESSION['user']['forename'] = $userData['forename'] ;
        $_SESSION['user']['surname'] = $userData['surname'] ;
        $_SESSION['user']['admin'] = $userData['admin'] ;
        $_SESSION['user']['player'] = $userData['player'] ;
        $_SESSION['user']['id'] = $userData['id'] ;
        // Head over to the home page
        header('HX-Redirect: ' . SITE_BASE . '/home');
    }

    else {
        echo '<h2>Incorrect password!</h2>' ;
        header('HX-Redirect: ' . SITE_BASE . '/login');
    }
}
else {
    echo '<h2>User account does not exist!</h2>' ;
}       
