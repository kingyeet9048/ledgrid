<?php

    //creating connection to MySQL
    include('mysqlembeddedconn.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //If input is null return empty space.
        $panel01 = $_POST['panel01'] != '' ? $_POST['panel01'] : ' ';
        $panel02 = $_POST['panel02'] != '' ? $_POST['panel02'] : ' ';
        $panel03 = $_POST['panel03'] != '' ? $_POST['panel03'] : ' ';

        // Getting the star ID from a cookie. 
        $star_id = $_COOKIE['star_id'];
        // calling a stored procedure. 
        $stmt = $conn->prepare("CALL billboard.insertUserMessages(?,?,?,?)");
        // this bind is the same as setting the question marks to a variable. 
        // s means string. 
        $stmt->bind_param("ssss", $panel01, $panel02, $panel03, $star_id);
        $stmt->execute();

        //close the connections since we are done. 
        $stmt->close();
        $conn->close(); 
    }
?>

<!-- Web page returned after a tried send. -->
<!DOCTYPE html>
<html lang="en-US">
    <?php include('../HTML/header.php'); include('GetSessionID.php'); ?> 
    <body id="main">
        <script>
            function pageRedirect() {
                window.location.href ="<?php echo "../HTML/SendMessage.php".getSession();?>";
            }      
        </script>
        <div id="content" style="margin: 3rem">
            <div class='alert alert-warning alert-dismissible fade show' role="alert">
                <p>Message Sent!</p>
            </div>
            <button type="button" class="btn btn-outline-light"  onclick="pageRedirect();">Send Another Message?</button>
        </div>
    </body>
</html>