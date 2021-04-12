<?php
   //displaying errors
   ini_set ('display_errors',1);
   error_reporting (E_ALL & ~ E_NOTICE);
   include("SessionHandler.php");
   $data = Session::getInstance();
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
       die("Connection failed: ".mysqli_error());
   }

   //Preparing the the statements
   $stmt = $conn->prepare("select starID FROM billboard.login WHERE userName = ? AND password = ?");
   //binds the statement to the variable.
   $stmt->bind_param("ss", $user, $pass);
   $stmt->execute();
   $result = $stmt->get_result();
   $correctSession = session_id();
   //comparing the encrypted credentials   
   if($result->num_rows > 0) {
      mysqli_data_seek($result, 0);
      $row = mysqli_fetch_array($result);
      $starID = $row[0];
      setcookie("star_id", $starID, time() + (86400 * 30), "/");
      $stmt = $conn->prepare("UPDATE billboard.login SET datetime = NOW() WHERE starID = ?;");
      $stmt->bind_param('s', $starID);
      $stmt->execute();
      echo 'HTML/home.php?sess='.$correctSession;
   }
   else {
      if (isset($_SERVER['HTTP_COOKIE'])) {
         $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
         foreach($cookies as $cookie) {
             $parts = explode('=', $cookie);
             $name = trim($parts[0]);
             setcookie($name, '', time()-1000);
             setcookie($name, '', time()-1000, '/');
         }
      }
      echo 'index.php?failed=1';
   }
?>