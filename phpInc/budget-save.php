<?php
  //state the session
  // session_start();

  //Get the email of the person who sent the data
  // $email = $_SESSION["email"];
  $email = "tombra4ril@gmail.com";

  //Get connection to the database
  DEFINE("USERNAME", "rootuser");
  DEFINE("PASSWORD", "student55");
  DEFINE("HOST", "localhost");
  DEFINE("DBNAME", "gobudget");
  $dbConnection = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME)
  or die("Could not connect to database \nError: " . mysqli_connect_error());
  
  mysqli_set_charset($dbConnection, "utf8");
  
  //Get the json data sent
  parse_str(file_get_contents("php://input"), $json);
  
  //Decode the json data to php array
  $json = json_decode(json_encode($json), true);
  
  //variable to hold the index of the json data
  $count = 0;
  
  //variable to hold separator for each item property
  $item_separator = "=>";

  //array to hold names of item
  $names = array();
  
  //array to hold amount of item
  $amount = array();

  //array to hold priority of item
  $priority = array();

  //variable to hold the category of item
  $category = "";

  //Store the data in a variable
  foreach($json["items"] as $value){
    $names[] =  $value["name"] . $item_separator;
    $amount[] =  $value["amount"] . $item_separator;
    $total = $value["total"];
    $priority[] =  $value["priority"] . $item_separator;
    $category = $value["category"];
    
    $count++;
  }

  //convert the array to string
  $names = implode($names);
  $amount = implode($amount);
  $priority = implode($priority);
  
  //insert the data into the database
  //query message
  $queryMessage = "INSERT INTO $category SET";

  $queryMessage .= " email = '{$email}',";
  $queryMessage .= " names = '{$names}',";
  $queryMessage .= " prices = '{$amount}',";
  $queryMessage .= " total = {$total},";
  $queryMessage .= " priority = '{$priority}';";

  //send the query
  $queryResult = mysqli_query($dbConnection, $queryMessage);
  if(!$queryResult){
    displayErrorMessage("Did not insert into the $category table.");
  }else{
    http_response_code(200);
    die();
  }

  function displayErrorMessage($message){
    echo "{$message} <br />Error: " . mysqli_error($dbConnection);
    http_response_code(503);
    die();
  }
?>