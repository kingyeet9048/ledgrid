<!-- Checks the session id. If the Session ID is incorrect, it will
redirect the user back to the login screen to relogin. -->
<?php 
    //displaying errors
    ini_set ('display_errors',1);
    error_reporting (E_ALL & ~ E_NOTICE);
    if(isset($_GET['sess'])) {
        $session = $_GET['sess'];
        $correctSession = $_COOKIE['PHPSESSID'];
        if (!($session == $correctSession)) {
            header('Location: ../index.php?failed=2');
        }
    }
    else {
        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }   
        header('Location: ../index.php?failed=2');
    }
?>