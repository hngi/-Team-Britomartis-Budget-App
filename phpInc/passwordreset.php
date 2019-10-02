<?php
 
/**
 * Include our MySQL connection.
 */
require 'connect.php';

 
//If the POST var "resetpassword" exists (our submit button), then we can
if(isset($_POST['reset-email'])){
    
    //Retrieve the field values from our registration form.
    $email = !empty($_POST['reset-email']) ? test_input($_POST['reset-email']) : null;
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

         //Creating a new password for the user.
    $password = substr(md5(uniqid(rand(),1)),3,10);

    //Creating message that will be sent to the user on their email
    $output='<p>Dear user,</p>';
    $output.='<p>Please copy your password and login to your account.</p>';
    $output.='<p>-------------------------------------------------------------</p>';		
    $output.='<p> This is the Password : '.$password.'</p>';		
    $output.='<p>-------------------------------------------------------------</p>';  	
    $output.='<p>Thanks,</p>';
    $output.='<p>Gobudget</p>';
    $message = $output;

     //This is the senders email And the subject of the mail being sent
    $from = "info@go-budget.herokuapp.com"; 
    $subject = "Password Recovery - Gobudget";

    //This is the header of the mail
    $headers = 'MIME-Version: 1.0'. "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From: '.$from. "\r\n".
    'Reply-To: '.$from. "\r\n".
    'X-Mailer: PHP/' .phpversion();

    //Users mail 
    $to = $email;

//if the mail is sent succefully then save it in the database
        if(mail($to,$subject,$message,$headers)){

        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
        //Construct the SQL statement and prepare it.
        $sql = "UPDATE users SET userpass = :password WHERE email = :email";
        $stmt = $pdo->prepare($sql);

        //Bind the provided email to our prepared statement.
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password',  $passwordHash);

        //Execute.
        $stmt->execute();

        $pass_reset_report = 'Success!!! A reset code has been sent to your email';
                
        }else{
            
            $pass_reset_report = 'Please try again';
        }
    }
    else {
        $pass_reset_report = 'Sorry! No such email found, please check and try again';
    }

    echo $pass_reset_report;
}
 
?>