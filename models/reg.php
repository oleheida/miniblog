<?php
    require ("../includes/db.php");
    require ("../includes/config.php");
    $data = $_POST;
    if(isset($data['do-reg'])){
        $errors = array();
            if(trim($data['login']) == ''){
                $errors[] = 'Enter the login';
            }
            if(trim($data['email']) == ''){
                $errors[] = 'Enter the email';
            }
            if(trim($data['password']) == ''){
                $errors[] = 'Enter the password';
            }
            if($data['passwordrep'] != $data['password']){
                $errors[] = 'Passwords do not match';
            }
            if( R::count
            ('users', "login=?", array($data['login'])) > 0){
                $errors[] = "Login is already in use. Try another login.";
            }
            if( R::count
            ('users', "email=?", array($data['email'])) > 0){
                $errors[] = "Email is already in use. Try another Email.";
            }

        if(empty($errors)){
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            header('Location: /miniblog/models/log.php');
        }
        else
        { ?>


    <?php $er = '<div class="text-center" style="color: red;">'.array_shift($errors).'</div>';
    }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']?></title>

    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <script src="https://use.fontawesome.com/6f039addd0.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>

<div id="wrapper">

    <header id="header">
        <nav class="navbar container-fluid">
            <ul class="nav navbar-nav header-left">
                <li><a href="">DRB</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right header-right">
                <li><a href="/miniblog/models/log.php">Sign in</a></li>
                <li><a href="/miniblog/models/reg.php">Sign up</a></li>
        </nav>
    </header>
    <?php if (!empty($errors)){ echo $er;}?>
<form class="text-center logform col-lg-12 " action="reg.php" method="POST">
    <p>
        <label for="login">Login</label><br>
        <input type="text" name="login" id="login" value="<?php echo @$data['login'];?>">
    </p>
    <p>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="<?php echo @$data['email'];?>">
    </p>
    <p>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password">
    </p>
    <p>
        <label for="passwordrep">Repeat the password</label><br>
        <input type="password" name="passwordrep" id="passwordrep">
    </p>
    <p>
        <button class="btn btn-success" type="submit" name="do-reg">Sign up</button>
    </p>

</form>
    <footer class="footer" style="position: fixed; left: 0; bottom: 0; ">
        <div class="container">
            <div class="footer-1 row">
                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                    <p class="footer-p-head">
                        Contacts
                    </p>
                    <p class="footer-p-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br/>
                        Aut autem consectetur culpa delectus dicta dolorum ducimus eveniet<br/>
                        ex fuga harum ipsa iste laboriosam, magnam quas ratione reiciendis repellendus saepe sunt.
                    </p>
                    <hr/>
                    <div class="footer-p-body-mobile">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>+7 555 555 55 55</span>
                        <p><i class="fa fa-phone" aria-hidden="true" style="color: transparent"></i>
                            +7 555 555 55 55</p>
                        <p><a href="mailto:darealblog@info.com">darealblog@info.com</a></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-md-offset-1 col-xs-5 col-sm-5">
                    <p class="footer-p-head">
                        Ingormation
                    </p>
                    <ul class="p-body">
                        <li><a href="#">Quality service</a></li>
                        <li><a href="#">Callback</a></li>
                        <li><a href="#">About company</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Donation</a></li>
                    </ul>
                </div>
                <div class="imp col-lg-4 col-md-4 text-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2565.5459505502304!2d36.2441617151709!3d49.98237302886261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a08bfc69a545%3A0x98bd523440b44446!2z0L_RgNC-0YHQv9C10LrRgiDQk9Cw0LPQsNGA0ZbQvdCwLCA3LCDQpdCw0YDQutGW0LIsINCl0LDRgNC60ZbQstGB0YzQutCwINC-0LHQu9Cw0YHRgtGM!5e0!3m2!1sru!2sua!4v1475595176192" width="260" height="260" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>

        </div>
        <div class="footer-2 row">
            <div class="container">
                <div class="col-lg-4 col-md-6 col-xs-12 col-sm-9 ">
                    <p> Copyright &copy; 2016 All Rights Reserved.</p>
                </div>
                <div class=" imp col-lg-3 col-lg-offset-5 col-md-6 col-xs-12 col-sm-3 text-center">
            <span class="footer-icons">
                <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </span>
                </div>
            </div>
        </div>
    </footer>

</div>

</body>
</html>