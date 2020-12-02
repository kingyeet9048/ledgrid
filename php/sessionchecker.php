<!-- Checks the session id. If the Session ID is incorrect, it will
redirect the user back to the login screen to relogin. -->
<?php 
    $session = $_GET['sess'];
    $data = Session::getInstance();
    $data->startSession();
    $correctSession = session_id();
    if (!($session == $correctSession)) {
        header('Location: ../index.php?failed=2');
    }
?>