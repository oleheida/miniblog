<?php
require "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']?></title>

    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <script src="https://use.fontawesome.com/6f039addd0.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="/miniblog/styles/style.css">
</head>
<body>

<div id="wrapper">

    <header id="header">
            <nav class="navbar navbar-fixed-top container-fluid">
                <ul class="nav navbar-nav header-left ">
                    <li><a href="/miniblog/articles_home.php">DRB</a></li>
                    <li><a href="<?php echo $config['about']?>" target="_blank">About</a></li>
                    <li><a href="<?php echo $config['news']?>" target="_blank"">News</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right header-right">
                    <?php if ($_SESSION['logged-user'] != 'm'){
                        echo "<li style='display: none'><a href=''>Admin (for admin only)</a></li>";
                    }else{
                    echo "<li><a href='/miniblog/articles_admin.php'>Admin(for admin only)</a></li>"; }?>
                    <li><a href="/miniblog/models/logout.php">Sign out</a></li>
            </nav>
    </header>