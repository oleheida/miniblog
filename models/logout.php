<?php
require ("../includes/db.php");

unset($_SESSION['logged-user']);

header('Location: log.php');
?>