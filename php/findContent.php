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
    $servername = trim(strval(fgets($myfile))).":3306";

    $conn = new mysqli($servername, $mysqlusername, $mysqlpassword);
    
    //checking connection
    if($conn->connect_error) {
        echo "Error: Unable to connect to MYSQL."."<br>\n";
        echo "Debugging errno: ".mysqli_connect_errno()."<br>\n";
        echo "Debugging error: ".mysqli_connect_error()."<br>\n";
        die("Connection failed: ".mysqli_error());
    }

    //getting the starID from a cookie. 
    $starID = $_COOKIE['star_id'];

    //Preparing the the statements
    $stmt = $conn->prepare("select messageTop, messageMiddle, messageBottom FROM billboard.user_Messages WHERE starID = ?");
    //binds the statement to the variable.
    $stmt->bind_param("s", $starID);
    $stmt->execute();
    $result = $stmt->get_result();
    //save the number of rows to a variable. 
    $numOfRows = $result->num_rows;
    if($numOfRows > 0) {
        //while there is something to pull
        while ($row = $result->fetch_assoc()) {
            //concat everything in this row to each other with %^%
            // and add %% to the end of this row. 
            // we will be able to split these values front-end. 
            echo implode("%^%", $row)."%%";
        }
    }
    // no data found. User must not have sent anything yet. 
    else {
        echo '404';
    }
    //close the connections since we are done. 
    $stmt->close();
    $conn->close(); 
?>