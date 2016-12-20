<?php
require_once "config.php";

$connection = mysqli_connect('localhost','root','','blog');

if($connection == false)
{
    echo "Failed to load database";
    echo mysqli_connect_error();
    exit();
}

?>