<?php

    include("../php/SessionHandler.php");
    $data = Session::getInstance();
    $data->startSession();
    function getSession() {
        return strval("?sess=".trim(strval(session_id())));
    }
?>