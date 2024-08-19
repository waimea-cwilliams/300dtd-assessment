<!-- Main navigation menu. Can add logic for user type / access -->
<?php 
    global $isLoggedIn;    
?>

<nav id="main-nav">

    <menu hx-boost="true">


        <?php if ($isLoggedIn): ?>

            <?php
            $isAdmin = $_SESSION['user']['admin']       ?? false ;
            $isPlayer = $_SESSION['user']['player']       ?? false ;
                if ($isAdmin && !$isPlayer){
                    ?>  
                    <li><a href="/home">Home</a>
                    <li><a href="/player">Player-list</a>
                    <li><a href="/signup">Signup</a>
                    <?php
                }
            
                if ($isPlayer && !$isAdmin){ 
                    ?>
                    <li><a href="/home">Home</a>
                    <?php
                }

                if ($isPlayer && $isAdmin){
                }
         ?>  
        <li><a hx-post="/logout" href="/logout">Logout</a>
        
        <?php else: ?>        
            <li><a href="/">Home</a>
            <li><a href="/login">Login</a>

        <?php endif ?>

    </menu>

</nav>


<!-- Update the nav links -->
<script>configureNav();</script>