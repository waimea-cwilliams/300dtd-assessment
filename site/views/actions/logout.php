<?php
    session_destroy();
    header('HX-Redirect: ' . SITE_BASE . '/');
?>

