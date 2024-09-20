<?php
    global $isLoggedIn;    


consoleLog($_SESSION, 'Session Data');

$isLoggedIn = $_SESSION['user']['loggedIn'] ?? false ;
$isAdmin = $_SESSION['user']['admin']       ?? false ;
$isUser = $_SESSION['user']['user']       ?? false ;
$isAttending = $_SESSION['user']['user']       ?? false ;

if ($isLoggedIn) {
    $name = $_SESSION['user']['forename'];
    echo '<h1>Welcome, ' .$name . '</h1>';
    if ($isAdmin && !$isUser){
        echo'<p>You are an Admin</p>' ;
        echo '<a href="player"><input type ="submit" value="See all Users"</a>';
        echo '<a href="event"><input type ="submit" value="See/Add Events"</a>';
    }
    
        if (!$isUser && !$isAdmin){
            require_once 'lib/db.php';
            $isLoggedIn = $_SESSION['user']['loggedIn'] ?? false ;
            $db = connectToDB();
            $name = $_SESSION['user']['username'];
            $user_id = $_SESSION['user']['id'];
            $forename = $_SESSION['user']['forename'];
            $surname = $_SESSION['user']['surname'];
    
            
            $query = 'SELECT * FROM users WHERE id = :user_id';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $users = $stmt->fetchAll();
            
            echo '<h1>User ID: ' .$user_id. '</h1>';
            
            echo '<table class="table">';
            echo '<tr>';
            echo '<th>Attendance</th>';
            
            foreach($users as $user) {
                echo '</tr>';
                echo '<tr>';
        
                echo '<td>';
                if(!$user['attendance'])
                
                        echo  '<a href="toggle-attendance?id=' . $user_id . '"
                        onclick="return confirm(`Are you sure?`)"> Not Available </a>';
            
                else 
                    echo  '<a href="toggle-attendance?id=' . $user_id . '"
                    onclick="return confirm(`Are you sure?`)"> Available </a>';
                echo '</td>';
                
                echo '</tr>';
            
            }
            echo '</table>';

            echo '<a href="event"><input type ="submit" value="See Events"</a>';
            
        }
}

    else {

    }

?>

