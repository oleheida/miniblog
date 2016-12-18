<?php
    require ("../db.php");
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
            echo '<div style="color: green;">Thank you for your sign up!</div>';
        }
        else
        {
            echo '<div style="color: red;">'.array_shift($errors).'</div>';
        }
    }
?>


<form action="reg.php" method="POST">
    <p>
        <label for="login">Login</label>
        <input type="text" name="login" id="login" value="<?php echo @$data['login'];?>">
    </p>
    <p>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo @$data['email'];?>">
    </p>
    <p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </p>
    <p>
        <label for="passwordrep">Repeat the password</label>
        <input type="password" name="passwordrep" id="passwordrep">
    </p>
    <p>
        <button type="submit" name="do-reg">Sign up</button>
    </p>

</form>