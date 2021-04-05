<?php

    $myfile = fopen("../secure_pass", "r") or die("unable to open file!");
    $mysqlusername = (fgets($myfile));
    $mysqlpassword = (fgets($myfile));
    $servername = "192.168.1.242:3306";

    $conn = new mysqli($servername, $mysqlusername, $mysqlpassword);

    //checking connection
    if($conn->connect_error) {
        echo "Error: Unable to connect to MYSQL."."<br>\n";
        echo "Debugging errno: ".mysqli_connect_errno()."<br>\n";
        echo "Debugging error: ".mysqli_connect_error()."<br>\n";
        die("Connection failed: " .mysqli_error());
    }

?>