<?php
    //displaying errors
    ini_set ('display_errors',1);
    error_reporting (E_ALL & ~ E_NOTICE);
    //gettting the raw data from xmlhttpsrequest
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $email = $decodedData->resetemail;
    $current = $decodedData->currentPassword;
    $new = $decodedData->newPassword;
    $code = $decodedData->code;
    $activationCode = fopen("../act_code", "r") or die("unable to open file!");
    $correctCode = fgets($activationCode);
    $correctCode  = trim(strval( $correctCode ));
    // get the password of the user that matches the email address
    
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
    $stmt = $conn->prepare("select L.password, L.starID FROM billboard.login as L JOIN billboard.all_users AS U ON L.starID = U.starID WHERE email = ?");
    //binds the statement to the variable.
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    fclose($activationCode);
    //comparing the provided pass and code with the one on the system.
    if(!($code == $correctCode)) {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }  
        echo '../index.php?failed=5';
    }
    else {
        if($result->num_rows > 0) {
            mysqli_data_seek($result, 0);
            $row = mysqli_fetch_array($result);
            $correctPassword = $row[0];
            $starID = $row['starID'];
            if ($correctPassword == $current) {
                $stmt = $conn->prepare("UPDATE billboard.login SET password = ? WHERE starID = ?;");
                $stmt->bind_param('ss', $new, $starID);
                $stmt->execute();
                include("SessionHandler.php");
                $data = Session::getInstance();
                $correctSession = session_id();
                echo '../HTML/home.php?sess='.$correctSession;
            }
            else {
                echo '../index.php?failed=3';
            }
        }
        else {
            echo '../index.php?failed=4';
        }
    }
    //close the connections since we are done. 
    $stmt->close();
    $conn->close();
?>