<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if(empty($user)) {
        echo "Username is empty";
    }
    else {
        echo "Username is " + $user;
    }
}


?>