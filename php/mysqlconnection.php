<?php
    //CREATES A NEW MYSQL CONNECTION.

    $myfile = fopen("mysql_pass", "r") or die("unable to open file!");
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

?>