<?php

    function getSession() {
        $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");

        fgets($myfile);
        fgets($myfile);
        fclose($myfile);
        return strval("?session=" + trim(strval(  fgets($myfile)  )));
    }
?>