
<?php 

require_once 'lib/db.php';
$db = connectToDB();

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
}

if ($user_id === 0) {
    echo 'No valid user provided.';
    exit;
}

$query = 'SELECT * FROM users WHERE id = :user_id';
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$users = $stmt->fetchAll();

echo '<h1>User ID: ' .$user_id. '</h1>';

    echo '<ul>';
    foreach ($users as $user) {
        if($user['attendance']) {
        echo '<h2>' . $user['forename'] . ' ' . $user['surname'] . ' is available for any events at the moment.</h2>';
        }

        if(!$user['attendance']) {
            echo '<h2>' . $user['forename'] . ' ' . $user['surname'] . ' is not available for any events at the moment.</h2>';
        }
    }
    echo '</ul>';

?>