<!-- Checks the session id. If the Session ID is incorrect, it will
redirect the user back to the login screen to relogin. -->
<?php 
    // $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");
    // fgets($myfile);
    // fgets($myfile);
    // $correctSession = trim(fgets($myfile));
    // fclose($myfile);
    // include("../php/SessionHandler.php");
    $session = $_GET['sess'];
    $data = Session::getInstance();
    $data->startSession();
    $correctSession = session_id();
    if ($session == $correctSession) {
        //echo "<script>alert('works');</script>";
    }
    else {
        //echo "<script>alert('noworks');</script>";
        header('Location: ../index.php?failed=2');
    }
?>