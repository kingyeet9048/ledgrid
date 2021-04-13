<?php
    // This function will return the session id in a url format so it can be
    // added to the url of all links in the navbar.
    function getSession() {
        return strval("?sess=".trim(strval($_COOKIE['PHPSESSID'])));
    }
?>