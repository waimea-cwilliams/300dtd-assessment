<form 
    hx-post="/do-login"
    hx-trigger="submit">

    <label>Username</label>
    <input name="username" type="text" required>

    <label>Password</label>
    <input name="password" type="password" required>

    <input type="submit" value="Login">

</form>
