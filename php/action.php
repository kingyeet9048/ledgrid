<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    if($user == $pass) {
        header('Location: ../HTML/home.php');
    }
    else {
        header('Location: ../index.php?failed=1');
    }

}


?>