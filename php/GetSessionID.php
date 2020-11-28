<?php

    include("../php/SessionHandler.php");
    $data = Session::getInstance();
    $data->startSession();
    function getSession() {
        // $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");

        // $second = fgets($myfile);
        // $first = fgets($myfile);
        // $id = fgets($myfile);
        // fclose($myfile);
        return strval("?sess=".trim(strval(session_id())));
    }
?>