<?php

    //displaying errors
    ini_set ('display_errors',1);
    error_reporting (E_ALL & ~ E_NOTICE);
    //gettting the raw data from xmlhttpsrequest
    $rawdata = file_get_contents("php://input");
    // $decodedData = json_decode($rawdata);
    // $section = $decodedData->user_messages;

    //starting connection
    include('mysqlembeddedconn.php');
    
    //checking connection
    if($conn->connect_error) {
        echo "Error: Unable to connect to MYSQL."."<br>\n";
        echo "Debugging errno: ".mysqli_connect_errno()."<br>\n";
        echo "Debugging error: ".mysqli_connect_error()."<br>\n";
        die("Connection failed: ".mysqli_error($conn));
    }


    //Preparing the the statements
    $result = $conn->query("select messageTop, messageMiddle, messageBottom, UM.starID, date_Time, concat(firstName, ' ', lastName) as 'Name', AU.role FROM billboard.user_messages AS UM JOIN billboard.all_users AS AU ON AU.starID = UM.starID");
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
    $conn->close(); 
?>