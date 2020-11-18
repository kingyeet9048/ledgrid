<!-- Checks the session id. If the Session ID is incorrect, it will
redirect the user back to the login screen to relogin. -->
<?php 
    $session = $_GET['session'];
    $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");
    fgets($myfile);
    fgets($myfile);
    $correctSession = trim(fgets($myfile));
    fclose($myfile);
    if ($session == $correctSession) {
        echo "sucesss";
    }
    else {
        header('Location: ../index.php?failed=2');
    }
?>