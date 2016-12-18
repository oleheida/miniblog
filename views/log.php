<?php
require "../db.php";

$data =  $_POST;
if(isset($data['do-log']))
{
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if($user){
        if(password_verify($data['password'], $user->password)){
            $_SESSION['logged-user'] = $user;
            echo '<div style="color: green;">You have successfully authorised</div>';
        }
        else {
            $errors[]="Incorrect password";
        }
    }
    else{
        $errors[]="User with such login doesn't exist";
    }
    if(!empty($errors)){
        echo '<div style="color: red;">'.array_shift($errors).'</div>';}
}
?>

<form action="log.php" method="POST">
    <p>
        <label for="login">Login</label>
        <input type="text" name="login" id="login" value="<?php echo @$data['login'];?>">
    </p>
    <p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </p>
    <p>
        <button type="submit" name="do-log">Sign in</button>
    </p>

</form>
