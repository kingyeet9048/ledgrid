<?php

    function getSession($page) {
        $myfile = fopen("/home/sbada9048/secure_pass", "r") or die("unable to open file!");

        fgets($myfile);
        fgets($myfile);
        fclose($myfile);
        return strval($page + "?session=" + trim(strval(  fgets($myfile)  )));
    }
?>