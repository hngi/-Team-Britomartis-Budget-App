<?php
 
/**
 * Include our MySQL connection.
 */
require 'connect.php';


 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['signupbutton'])){
    $signup_report = 'Well received'

    // //Retrieve the field values from our registration form.
    // $firstname = !empty($_POST['firstname']) ? test_input($_POST['firstname']) : null;
    // // Check if the value of this field is an alphabet and of 3 characters and more
    // if (!preg_match("/^[a-z]{3,}/i", $firstname)) {
    //     array_push($errors, "Sorry!! Firstname is too short");
    // }

    // $lastname = !empty($_POST['lastname']) ? test_input($_POST['lastname']) : null;
    // // Check if the value of this field is an alphabet and of 3 characters and more
    // if (!preg_match("/^[a-z]{3,}/i", $firstname)) {
    //     array_push($errors, "Sorry!! Lastname is too short");
    // }

    // $email = !empty($_POST['email']) ? test_input($_POST['email']) : null;
    // // Check if the value of this field is an email
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     array_push($errors, "Invalid email format");
    // }

    // $currency = !empty($_POST['currency']) ? test_input($_POST['currency']) : null;

    // $password1 = !empty($_POST['password']) ? test_input($_POST['password']) : null;
    // $password2 = !empty($_POST['repeat-password']) ? test_input($_POST['repeat-password']) : null;
    // //check if the two passwords match
    // if ($password1 !== $password2){
    //     array_push($errors, "Password mismatch, please try again.");
    // }
    
    // //Now, we need to check if the supplied email already exists.
    
    // //Construct the SQL statement and prepare it.
    // $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    // $stmt = $pdo->prepare($sql);
    
    // //Bind the provided email to our prepared statement.
    // $stmt->bindValue(':email', $email);
    
    // //Execute.
    // $stmt->execute();
    
    // //Fetch the row.
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // //If the provided email already exists - push error.
    // if($row['num'] > 0){
    //     array_push($errors, "This email is associated with an existing user!!<br> <a href='#'>Forgot Your Password?</a>");
    // }

    // // If any error is found in the error array, set signup_report to display_errors function.
    // if (count($errors) > 0){
    //     $signup_report = display_errors($errors);
    //     $last_name = $fullname;
    //     $last_email = $email;
    // }
    // else{
    //     //Hash the password as we do NOT want to store our passwords in plain text.
    //     $passwordHash = password_hash($password1, PASSWORD_BCRYPT, array("cost" => 12));
        
    //     //Prepare our INSERT statement.
    //     //Remember: We are inserting a new row into our users table.
    //     $sql = "INSERT INTO users (firstname, lastname, email, currency, userpass, reg_date) VALUES (:firstname, :lastname, :email, :currency, :password, NOW())";
    //     $stmt = $pdo->prepare($sql);
        
    //     //Bind our variables.
    //     $stmt->bindValue(':firstname', $firstname);
    //     $stmt->bindValue(':lastname', $lastname);
    //     $stmt->bindValue(':email', $email);
    //     $stmt->bindValue(':currency', $currency);
    //     $stmt->bindValue(':password', $passwordHash);
    
    //     //Execute the statement and insert the new account.
    //     $result = $stmt->execute();
        
    //     //If the signup process is successful.
    //     if($result){
    //         //set signup report to success
    //         $signup_report = 'Your Sign up was Successful. Please <a href="index.php">login</a>';
    //     }

    // }
    
}
 
?>