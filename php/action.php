<?php
   //displaying errors
   ini_set ('display_errors',1);
   error_reporting (E_ALL & ~ E_NOTICE);

   include("SessionHandler.php");
   $data = Session::getInstance();

   //gettting the raw data from xmlhttpsrequest
   $rawdata = file_get_contents("php://input");
   $decodedData = json_decode($rawdata);
   $user = str_replace('"', '', $decodedData->username);
   $pass = str_replace('"', '', $decodedData->password);

   $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");
   $correctUser = (fgets($myfile));
   $correctPass = (fgets($myfile));
   // $correctSession = fgets($myfile);

   $correctSession = session_id();

   $correctUser = trim(strval(  $correctUser ));
   $correctPass = trim(strval(  $correctPass ));

   fclose($myfile);
   if($user == $correctUser && $pass == $correctPass) {
      echo 'HTML/home.php?sess='.$correctSession;
   }
   else {
      echo 'index.php?failed=1';
   }


?>