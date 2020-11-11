<?php

    function getSession() {
        $myfile = fopen("../../secure_pass", "r") or die("unable to open file!");

        $second = fgets($myfile);
        $first = fgets($myfile);
        $id = fgets($myfile);
        fclose($myfile);
        return strval("?session=".trim(strval($id)));
    }
?>