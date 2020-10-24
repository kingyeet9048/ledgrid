<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $panel01 = $_POST['panel01'];
    $panel02 = $_POST['panel02'];
    $panel03 = $_POST['panel03'];


    $host = "localhost"; 
    $port = 4444;
    $data = strval( $panel01."&".$panel02."&".$panel03 );

    if ( ($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === FALSE )
        echo "socket_create() failed: reason: " .             socket_strerror(socket_last_error());
    else 
    {
        echo "Attempting to connect to '$host' on port '$port'...<br>";
        if ( ($result = socket_connect($socket, $host, $port)) === FALSE )
            echo "socket_connect() failed. Reason: ($result) " .     socket_strerror(socket_last_error($socket));
        else {
            echo "Sending data...<br>";
            socket_write($socket, $data."\r\n", strlen($data."\r\n"));
            echo "OK<br>";
        }
        socket_close($socket);      
    }
}

?>