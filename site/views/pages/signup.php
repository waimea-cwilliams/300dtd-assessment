
<form hx-post="/do-signup"
      hx-trigger="submit">

    <label>Forename</label>
    <input name="forename" type="text" required>

    <label>Surname</label>
    <input name="surname" type="text" required>

    <label>Username</label>
    <input name="user" type="text" required>

    <label>Player?</label>
    <p>
    <input name="player" type="radio" value="1" >Yes
    <input name="player" type="radio" value="0" required>No
</p>

    <label>Password</label>
    <input name="pass" type="password" required>

    <input type="submit" value="Signup">

</form>
