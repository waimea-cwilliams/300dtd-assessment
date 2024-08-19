<?php

    require_once 'lib/db.php';

    $db = connectToDB();

    $query = 'SELECT * FROM users';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll();

    echo '<table class="other">';
    echo '<tr>';
    echo '<th>Username</th>';
    echo '<th>ID</th>';
    foreach($users as $user) {
    echo '</tr>';

    echo '<tr>';

    echo '<td>';
        echo '<p>' . $user['forename'] . '</p>';
    echo '</td>';

    echo '<td>';
        echo '<p>' . $user['id'] . '</p>';
    echo '</td>';

    echo '</tr>';

    }
echo '</table>';


?>
<article>
    <form hx-post="/new-event"
          hx-trigger="submit">

            <label>Event</label>
            <input name="name" type="text" required>

            <label>User ID:</label>
            <input name="ID" type="text" required>

            <label>Description</label>
            <textarea name="description" type="text"  required>Type Here...</textarea>

            <label>Date</label>
            <input name="date" type="date" min="<?= Date('Y-m-d') ?>" required>

            <input class="button" type="submit" value="Add Event"></p>

            </form>
</article>