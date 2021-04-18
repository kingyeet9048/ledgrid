<?php
    /**
     * Current User Types
     * Admin
     * Faculty
     * Student
     */

    //displaying errors
    ini_set ('display_errors',1);
    error_reporting (E_ALL & ~ E_NOTICE);

    //gettting the raw data from xmlhttpsrequest
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output for userType
    $userType = $decodedData->userType;

    // starting connection
    include('mysqlembeddedconn.php');

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $starID = generateRandomString(8);
    $stmt = $conn->prepare("select * FROM billboard.all_users AS AU JOIN billboard.login AS L ON AU.starID = L.starID WHERE AU.email = ? OR L.userName = ?;");
    $stmt->bind_param("ss", $decodedData->email, $decodedData->username);
    $stmt->execute();
    $result = $stmt->get_result();
    //access code
    $myfile = fopen("../act_code", "r") or die("unable to open file!");
    $code = trim(strval(fgets($myfile)));
    if($code == $decodedData->code) {
        if (!($result->num_rows > 0)) {
            //Preparing the the statements
            $stmt = $conn->prepare("CALL billboard.insertAUser(?,?,?,?,?,?,?)");
            //binds the statement to the variable.
            $stmt->bind_param("sssssss", $starID, $decodedData->last, $decodedData->first, $userType, $decodedData->email, $decodedData->username, $decodedData->password);
            $stmt->execute();
            // Proccessing Data
            if($userType == 'Student') {
                $stmt = $conn->prepare("CALL billboard.insertStudent(?, ?)");
                $stmt->bind_param("ss", $decodedData->major, $starID);
                $stmt->execute();
            }
            elseif($userType == 'Faculty') {
                $stmt = $conn->prepare("CALL billboard.insertFaculty(?, ?)");
                $stmt->bind_param("ss", $decodedData->department, $starID);
                $stmt->execute();
            }
            include("SessionHandler.php");
            $data = Session::getInstance(); 
            $correctSession = session_id();

            setcookie("star_id", $starID, time() + (86400 * 30), "/");
            echo '../HTML/home.php?sess='.$correctSession;
        }
        else {
            echo '../index.php?failed=4';
        }
    }
    else {
        echo '../index.php?failed=5';
    }
    //close the connections since we are done. 
    $stmt->close();
    $conn->close();

?>