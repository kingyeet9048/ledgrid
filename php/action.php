<?php

   
   ini_set ('display_errors',1);
   error_reporting (E_ALL & ~ E_NOTICE);

   $rawdata = file_get_contents("php://input");
   $decodedData = json_decode($rawdata);
   $user = $decodedData->username;
   $pass = $decodedData->password;
   $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");

   $correctUser = (fgets($myfile));
   $correctPass = (fgets($myfile));
   $correctSession = fgets($myfile);

   $correctUser = trim(strval(  $correctUser ));
   $correctPass = trim(strval(  $correctPass ));
   //echo 'usr: '.$user;
   //echo 'correctuser: '.$correctUser;
   //  echo $correctUser.$correctPass;

   fclose($myfile);
   if($user == $correctUser && $pass == $correctPass) {
      echo 'HTML/home.php?session='.$correctSession;
   }
   else {
      echo 'index.php?failed=1&username='.$user;
   }


?>