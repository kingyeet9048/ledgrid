<?php

    //displaying errors
    ini_set ('display_errors',1);
    error_reporting (E_ALL & ~ E_NOTICE);
    //gettting the raw data from xmlhttpsrequest
    $rawdata = file_get_contents("php://input");
    // $decodedData = json_decode($rawdata);
    // $section = $decodedData->user_messages;

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

    $starID = $_COOKIE['star_id'];

    //Preparing the the statements
    $stmt = $conn->prepare("select messageTop, messageMiddle, messageBottom FROM billboard.user_messages WHERE starID = ?");
    //binds the statement to the variable.
    $stmt->bind_param("s", $starID);
    $stmt->execute();
    $result = $stmt->get_result();
    $numOfRows = $result->num_rows;
    if($numOfRows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo implode("%^%", $row)."%%";
        }
    }
    else {
        echo '404';
    }
?>