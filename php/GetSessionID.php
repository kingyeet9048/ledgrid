<?php
    //Returns the current session id in a url format. 
    include("../php/SessionHandler.php");
    $data = Session::getInstance();
    $data->startSession();
    function getSession() {
        return strval("?sess=".trim(strval(session_id())));
    }
?>