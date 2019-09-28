<?php
  //state the session
  session_start();

  //Get connection to the database
  DEFINE("USERNAME", "rootuser");
  DEFINE("PASSWORD", "student55");
  DEFINE("HOST", "localhost");
  DEFINE("DBNAME", "gobudget");
  $dbConnection = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME)
  or die("Could not connect to database \nError: " . mysqli_connect_error());
  
  mysqli_set_charset($dbConnection, "utf8");
  
  //query db for email address
  $queryMessage = "SELECT email";
  $queryMessage .= " FROM users"; 
  $queryMessage .= " WHERE";  
  $queryMessage .= " id = '{$id}'";

  //query db
  $queryResult = mysqli_query($dbConnection, $queryMessage);
  
  //if there is an error
  if(!$queryResult){
    displayErrorMessage("Could not get user email!", $dbConnection);
  }
  else{
    $row = mysqli_fetch_assoc($queryResult);
    $email = $row["email"];
  }

  //Get data from database
  //get the category to select
  $table = $_GET["category"];

  $queryMessage = "SELECT * "; 
  $queryMessage .= " FROM {$table}"; 
  $queryMessage .= " WHERE";
  $queryMessage .= " email = '{$email}'";

  $queryResult = mysqli_query($dbConnection, $queryMessage);
  if($queryResult){
    if(mysqli_num_rows($queryResult) > 0){
      //get the number of rows returned by the query
      $numRows = mysqli_num_rows($queryResult);
      
      //create a json variable to hold and then send the variable
      $json = array();
      $json["items"] = array();

      //item seperator used
      $item_separator = "=>";

      //get the row received from the database
      while($row = mysqli_fetch_assoc($queryResult)){
        //get and explode each column value as necessary
        $names = explode($item_separator, $row["names"]);
        $amount = explode($item_separator, $row["prices"]);
        $total = $row["total"];
        $priority = explode($item_separator, $row["priority"]);
        
        $json_row = array();  
        for($count = 0; $count < count($names) - 1; $count++){
          $obj = array(
            "name"=> $names[$count],
            "amount"=> $amount[$count],
            "priority"=> $priority[$count],
            "total"=> $total,
          );
          array_push($json_row, $obj);
        }
        

        //push the above object to the json variable
        array_push($json["items"], $json_row);
      }


      

      //encode the json variable
      echo json_encode($json);

      // var_dump($names);
      // die();
      //explode each arra
      http_response_code(200);
      die();
    }else{
      echo "No data Found";
      http_response_code(200);
      die();
    }
  }else{
    http_response_code(503);
    die();
  }
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