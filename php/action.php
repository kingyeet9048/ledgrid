<?php
   //displaying errors
   ini_set ('display_errors',1);
   error_reporting (E_ALL & ~ E_NOTICE);
   //gettting the raw data from xmlhttpsrequest
   $rawdata = file_get_contents("php://input");
   $decodedData = json_decode($rawdata);
   //getting the raw sha256 output
   $user = $decodedData->username;
   $pass = $decodedData->password;
   //getting values from mysql

   // Starting connection
   $myfile = fopen("../mysql_pass", "r") or die("unable to open file!");
   $mysqlusername = trim(strval(fgets($myfile)));
   $mysqlpassword = trim(strval(fgets($myfile)));
   $servername = "localhost:3306";

   $conn = new mysqli($servername, $mysqlusername, $mysqlpassword);
   
   //checking connection
   if($conn->connect_error) {
       echo "Error: Unable to connect to MYSQL."."<br>\n";
       echo "Debugging errno: ".mysqli_connect_errno()."<br>\n";
       echo "Debugging error: ".mysqli_connect_error()."<br>\n";
       die("Connection failed: ");
   }

   //Preparing the the statements
   $stmt = $conn->prepare("select starID FROM billboard.login WHERE userName = ? AND password = ?");
   //binds the statement to the variable.
   $stmt->bind_param("ss", $user, $pass);
   $stmt->execute();
   //getting the result set. 
   $result = $stmt->get_result();
   //comparing the encrypted credentials   
   // if there are rows returned...
   if($result->num_rows > 0) {
      //get the data of the first row and column. 
      mysqli_data_seek($result, 0);
      $row = mysqli_fetch_array($result);
      $starID = $row[0];
      //setting the cookie of starID since we now have it. 
      setcookie("star_id", $starID, time() + (86400 * 30), "/");
      // UPDATE the login table of the new login by this user. 
      $stmt = $conn->prepare("UPDATE billboard.login SET datetime = NOW() WHERE starID = ?;");
      $stmt->bind_param('s', $starID);
      $stmt->execute();
      // Will start the session. 
      include("SessionHandler.php");
      $data = Session::getInstance();
      //echo a url with the session id.
      $correctSession = session_id();
      echo 'HTML/home.php?sess='.$correctSession;
   }
   //no result set was found.
   else {
      // delete all cookies
      if (isset($_SERVER['HTTP_COOKIE'])) {
         $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
         foreach($cookies as $cookie) {
             $parts = explode('=', $cookie);
             $name = trim($parts[0]);
             setcookie($name, '', time()-1000);
             setcookie($name, '', time()-1000, '/');
         }
      }
      //echo a failed url.
      echo 'index.php?failed=1';
   }
   //close the connections since we are done. 
   $stmt->close();
   $conn->close(); 
?>