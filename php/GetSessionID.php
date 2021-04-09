<?php
    function getSession() {
        return strval("?sess=".trim(strval($_COOKIE['PHPSESSID'])));
    }
?>