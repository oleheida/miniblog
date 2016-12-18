<?php
    require_once("db.php");

?>
<?php if(isset($_SESSION['logged-user'])) : ?>
    Authorised as <?php echo $_SESSION['logged-user']->login;?>
    <a href="views/logout.php">Log out</a>
<?php else : ?>
<a href="views/reg.php">Sign up</a>
<a href="views/log.php">Sign in</a>
<?php endif; ?>