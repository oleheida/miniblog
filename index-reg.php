<?php
    require_once("includes/db.php");

?>
<?php if(isset($_SESSION['logged-user'])) : ?>
    Authorised as <?php echo $_SESSION['logged-user']->login;?>
    <a href="models/logout.php">Log out</a>
<?php else : ?>
<a href="models/reg.php">Sign up</a>
<a href="models/log.php">Sign in</a>
<?php endif; ?>