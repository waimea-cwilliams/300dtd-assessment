<?php

//-------------------------------------------------------------
// Libraries
require_once 'lib/debug.php';
require_once 'lib/router.php';

//-------------------------------------------------------------
// Setup a session
session_name('TEAMTRACKER');
session_start();

//-------------------------------------------------------------
// Site Configuration
const SITE_NAME  = 'Team Attendance Tracker';
const SITE_OWNER = 'Coen Williams';


//-------------------------------------------------------------
// Initialise the router
$router = new Router(['debug' => true]);

//-------------------------------------------------------------
//
$userName   = $_SESSION['user']['name']     ?? 'Guest';
$isLoggedIn = $_SESSION['user']['loggedIn'] ?? false;

//-------------------------------------------------------------
// Define routes

$router->route(GET,     PAGE, '/',      'pages/welcome.php');
$router->route(GET,     PAGE, '/home',      'pages/home.php');
$router->route(GET,     PAGE, '/attendance',      'pages/attendance.php');
$router->route(GET,     PAGE, '/player',      'pages/player-list.php');

$router->route(GET,     PAGE, '/event',      'pages/event.php');
$router->route(GET,     PAGE, '/form-event',      'pages/form-newevent.php');
$router->route(POST,     HTMX, '/new-event',      'actions/process-newevent.php');
$router->route(GET,   PAGE, '/delete-event',    'actions/delete-event.php');

$router->route(GET,     PAGE, '/login',     'pages/login.php');
$router->route(POST,    HTMX, '/do-login',     'actions/do-login.php');
$router->route(POST,    HTMX, '/logout',    'actions/logout.php');

$router->route(GET,     PAGE, '/signup',     'pages/signup.php');
$router->route(POST,    HTMX, '/do-signup',     'actions/do-signup.php');

$router->route(GET,     PAGE, '/toggle-attendance', 'actions/toggle-attendance.php');
$router->route(GET,   PAGE, '/toggle-useradmin',    'actions/toggle-useradmin.php');
$router->route(GET,   PAGE, '/toggle-userplayer',    'actions/toggle-userplayer.php');
$router->route(GET,   PAGE, '/delete-user',    'actions/delete-user.php');


//-------------------------------------------------------------
// Generate the required view
$router->view();
