<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //If input is null return empty space.
    $panel01 = $_POST['panel01'] != '' ? $_POST['panel01'] : ' ';
    $panel02 = $_POST['panel02'] != '' ? $_POST['panel02'] : ' ';
    $panel03 = $_POST['panel03'] != '' ? $_POST['panel03'] : ' ';


    $host = "199.17.162.75"; 
    $port = 4444;
    $data = strval( $panel01."&".$panel02."&".$panel03 );
    $result = "";

    //Try to make a socket.
    if ( ($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === FALSE ) {
        //if false, get the error that is returned. 
        $result = socket_strerror(socket_last_error());
    }
    else 
    {
        //Connect to the socket
        if ( ($result = socket_connect($socket, $host, $port)) === FALSE ) {
            //if you cannot connect, get the error from it. 
            $result = "Attempted to connect to '$host' on port '$port' and get an error of: ".socket_strerror(socket_last_error($socket));
        }
        else {
            //else write to the socket.
            socket_write($socket, $data."\r\n", strlen($data."\r\n"));
            $result = "Attempted to connect to '$host' on port '$port'. It was sucessfull. Message sent!";
        }
        socket_close($socket);      
    }
}
?>

<!-- Web page returned after a tried send. -->
<html lang="en-US">
    <div>
    <?php include('../HTML/header.php'); include('GetSessionID.php'); ?>
    <script>
        function pageRedirect() {
            window.location.href ="<?php echo "../HTML/SendMessage.php".getSession();?>";
        }      
    </script>
   
    <body id="main">
        <div id="content" style="margin: 3rem">
            <div class='alert alert-warning alert-dismissible fade show' role="alert">
                <p><?php echo $result; ?></p>
            </div>
            <button type="button" class="btn btn-outline-light"  onclick="pageRedirect();">Send Another Message?</button>
        </div>
    </div>
    </body>
</html>