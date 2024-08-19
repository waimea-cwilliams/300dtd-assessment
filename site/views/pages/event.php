<?php

    global $isLoggedIn;
    require_once 'lib/db.php';

    if ($isLoggedIn): ?>

        <?php
        $isAdmin = $_SESSION['user']['admin']       ?? false ;
        $isPlayer = $_SESSION['user']['player']       ?? false ;
            if ($isAdmin && !$isPlayer){
                ?>  
                <nav id="add-button">
                <a href="form-event">+</a>
                </nav>
                <?php
            }
        else {
            
        }

    endif;


    $db = connectToDB();
    $name = $_SESSION['user']['username'];
    $user_id = $_SESSION['user']['id'];
    $forename = $_SESSION['user']['forename'];
    $surname = $_SESSION['user']['surname'];

    $query = 'SELECT * FROM events';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $events = $stmt->fetchAll();
    

    if($isPlayer && !$isAdmin){

        $query = 'SELECT * FROM events WHERE user = :user_id ORDER BY date asc';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $events = $stmt->fetchAll();

        if(empty($events)) {
            echo '<h2>No events found for:  '. $forename. ' ' . $surname . ' - User ID: ' . $user_id . '</h2>';
        } 
        else {
            echo '<ul>';
            foreach ($events as $event) {
            echo '<li><h2>' . $event['name'] . ' ' . $event['description'] . '</h2>';
            echo '<p>' . $event['date'] . '</li>';
            }
        echo '</ul>';
    }    
    }

    if($isAdmin && !$isPlayer){

        $query = 'SELECT * FROM events ORDER BY date asc';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $events = $stmt->fetchAll();

        if(empty($events)) {
            echo '<h2>Hello ' . $name . ', there are no Events right now. Please add some using the button down the bottom right.</h2>';
        } 
        else {
            echo '<ul>';
            foreach ($events as $event) {
            echo '<li><h2>' . $event['name'] . ' ' . $event['description'] . '</h2>';
            echo '<p>' . $event['date'] . ' | ' . '<a href="delete-event?id=' . $event['id'].'"
            onclick="return confirm(`Are you sure?`)"
            >Delete Event</a>';'</p>'; 
            }
        echo '</ul>';
    }    
    }
     ?>  