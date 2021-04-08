<?php

//creating connection to MySQL
$myfile = fopen("../mysql_pass", "r") or die("unable to open file!");
$mysqlusername = trim(strval(fgets($myfile)));
$mysqlpassword = trim(strval(fgets($myfile)));
$servername = "localhost:3306";

$conn = new mysqli($servername, $mysqlusername, $mysqlpassword);

//checking connection
if($conn->connect_error) {
    echo "Error: Unable to connect to MYSQL."."<br>\n";
    echo "Debugging errno: ".mysqli_connect_errno()."<br>\n";
    echo "Debugging error: ".mysqli_connect_error()."<br>\n";
    die("Connection failed: ".mysqli_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //If input is null return empty space.
    $panel01 = $_POST['panel01'] != '' ? $_POST['panel01'] : ' ';
    $panel02 = $_POST['panel02'] != '' ? $_POST['panel02'] : ' ';
    $panel03 = $_POST['panel03'] != '' ? $_POST['panel03'] : ' ';

    $star_id = $_COOKIE['star_id'];
    $stmt = $conn->prepare("CALL billboard.insertUserMessages(?,?,?,?)");
   
    $stmt->bind_param("ssss", $panel01, $panel02, $panel03, $star_id);
    $stmt->execute();
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
                <p><?php echo $result; ?></p>
            </div>
            <button type="button" class="btn btn-outline-light"  onclick="pageRedirect();">Send Another Message?</button>
        </div>
    </body>
</html>