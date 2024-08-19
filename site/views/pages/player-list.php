<php
    global $isLoggedIn;
?>

<?php
    require_once 'lib/debug.php';
    require_once 'lib/db.php';

    $db = connectToDB();

    $query = 'SELECT * FROM users';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt ->fetchAll();
   
    echo '<div class="heading">';
    echo '<h2>Waimea Junior A Basketball Team</h2>';
    echo '</div>';
    
    echo '<table class="table">';
    echo '<tr>';
    echo '<th>Username</th>';
    echo '<th>Full Name</th>';
    echo '<th>Attendance</th>';
    echo '<th>Admin</th>';
    echo '<th>Player</th>';
    echo '<th>Delete User</th>';
    
    foreach($users as $user) {
        echo '</tr>';
        echo '<tr>';

        echo '<td>';
        echo '<p>' . $user['username'] . ' </p>';
        echo '</td>';
    
        echo '<td>';
        echo '<p>' . $user['forename'] . ' ' . $user['surname'] .  ' </p>';
        echo '</td>';

        echo '<td>';
        if(!$user['admin']) 
        echo  '<a href="attendance?id=' . $user['id'] . '"
        onclick="return confirm(`Viewing '. $user['username'] . 's profile`)">
        '.'View</a>';
        else 
        echo '</td>';

        echo '<td>';
        if(!$user['admin'])
        
                echo  '<a href="toggle-useradmin?id=' . $user['id'] . '"
                onclick="return confirm(`Are you sure?`)"> No </a>';
    
        else 
            echo  '<a href="toggle-useradmin?id=' . $user['id'] . '"
            onclick="return confirm(`Are you sure?`)"> Yes </a>';
        echo '</td>';
        
        echo '<td>';
        if (!$user['player'])
            echo '<a href="toggle-userplayer?id='. $user['id'] . '"
            onclick="return confirm(`Are you sure?`)"> No </p>';

        else 
            echo '<a href="toggle-userplayer?id='. $user['id'] . '"
            onclick="return confirm(`Are you sure?`)"> Yes </p>';
        echo '</td>';
            
        echo '<td>';
        echo  '<a href="delete-user?id=' . $user['id'] . '"
            onclick="return confirm(`Are you sure?`)"> Delete User </a>';
        echo '</td>';

        
        echo '</tr>';
    
    }
    echo '</table>';
    