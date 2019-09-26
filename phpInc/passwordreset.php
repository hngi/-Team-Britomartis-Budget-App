<?php

 
/**
 * Start the session.
 */
session_start();
 

 
/**
 * Include our MySQL connection.
 */
require 'connect.php';


 
//If the POST var "resetpassword" exists (our submit button), then we can
if(isset($_POST['resetpassword'])){
    
    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? test_input($_POST['email']) : null;
    // Check if the value of this field is an email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format");
    }
    
    //Now, we need to check if the supplied email exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided email to our prepared statement.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided email already exists - push error.
    if($row['num'] > 0){
        $pass_reset_report = 'Success!!! A reset code has been sent to your email';
    }
    else {
        $pass_reset_report = 'Sorry! No such email found, please check and try again';
    }
}
 
?>
<!-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <div class="report"><?= $pass_reset_report ?></div>
        <form action="passwordreset.php" method="post">
            <label for="email">email</label>
            <input type="email" id="email" name="email"><br>
            <input type="submit" name="resetpassword" value="Reset My Password"></button>
        </form>
    </body>
</html> -->