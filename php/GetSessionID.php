<!-- THis function will return the session id in a url format so it can be
added to the url of all links in the navbar. -->
<?php
    function getSession() {
        return strval("?sess=".trim(strval($_COOKIE['PHPSESSID'])));
    }
?>