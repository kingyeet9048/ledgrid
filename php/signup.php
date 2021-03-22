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
   $current = $decodedData->currentPassword;
   $new = $decodedData->newPassword;
   $code = $decodedData->code;
   $cred = fopen("../../secure_pass", "r") or die("unable to open file!");
   $activationCode = fopen("../../act_code", "r") or die("unable to open file!");
   $correctUser = (fgets($cred));
   $correctCurrent = fgets($cred);
   $correctCode = fgets($activationCode);
   $correctCurrent = trim(strval(  $correctCurrent ));
   $correctCode  = trim(strval( $correctCode ));
   $correctSession = session_id();
   fclose($cred);
   fclose($activationCode);
   //comparing the provided pass and code with the one on the system.
   if(!($current == $correctCurrent && $code == $correctCode)) {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }  
        echo '../index.php?failed=3';
    }
    else {
        $cred = fopen("../../secure_pass", "w");
        fwrite($cred, $correctUser);
        fwrite($cred, $new);
        fclose($cred);
        echo '../HTML/home.php?sess='.$correctSession;
    }
?>