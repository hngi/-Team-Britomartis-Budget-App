<?php
 
/**
 * Include our MySQL connection.
 */
require 'connect.php';
 
 
//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST['login-email'])){
    
    //Receive the field values from our login form.
    $email = !empty($_POST['login-email']) ? test_input($_POST['login-email']) : null;
    
    $passwordAttempt = !empty($_POST['login-password']) ? test_input($_POST['login-password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        $login_report =  'Incorrect username / password combination!';
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['userpass']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called home.php
            header('Location: dashboard.php');
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            $login_report =  'Incorrect username / password combination!';
        }
    }
    
}
 
?>
<!-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <div class="report"><?= $login_report ?></div>
        <form action="login.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password"><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
</html> -->