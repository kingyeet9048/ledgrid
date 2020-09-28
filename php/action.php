<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $myfile = fopen("/home/sbada9048/secure_pass", "r") or die("unable to open file!");

    $correctUser = fgets($myfile);
    $correctPass = fgets($myfile);

    $correctUser = trim(strval(  $correctUser ));
    $correctPass = trim(strval(  $correctPass ));
    echo $user.$pass;
    echo $correctUser.$correctPass;

    fclose($myfile);
    if($user == $correctUser && $pass == $correctPass) {
       header('Location: ../HTML/home.php');
    }
    else {
       header('Location: ../index.php?failed=1&username='.$user);
    }

}


?>