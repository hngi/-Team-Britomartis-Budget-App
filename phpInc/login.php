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
        echo $login_report =  'Incorrect username / password combination!';
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['userpass']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            // $login_report = 'Success';
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['firstname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called home.php
            // header('Location: ../dashboard.html');
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo $login_report =  'Incorrect username / password combination!';
        }
    }
    
}
 
function userAuth(){
    if (!isset($_SESSION['user_id'])){
        header("location: index.html");
    }
    
}

function logOut() {
    if (isset($_POST['logout'])) {
        session_destroy();
        header("location: index.html");
    }
    // session_destroy();
    // header("location: index.html");
}
?>