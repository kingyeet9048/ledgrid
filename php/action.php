<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $myfile = fopen("/var/www/html/secure_pass.txt", "r") or die("unable to open file!");

    $correctUser = fgets($myfile);
    $correctPass = fgets($myfile);
    $correctSession = fgets($myfile);

    $correctUser = md5(trim(strval(  $correctUser )));
    $correctPass = md5(trim(strval(  $correctPass )));
   //  echo $user.$pass;
     //echo $correctUser.$correctPass;
   print_r($_POST);
    fclose($myfile);
    if($user == $correctUser && $pass == $correctPass) {
       echo 'HTML/home.php?session='.$correctSession;
    }
    else {
       echo 'index.php?failed=1&username='.$user;
    }

}

?>