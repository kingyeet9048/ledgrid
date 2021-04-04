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

    // Starting connection
    include 'mysqlconnection.php';

    // Proccessing Data
    if($userType == 'Admin') {

    }
    elseif($userType == 'Faculty') {

    }
    else {
        
    }    

?>