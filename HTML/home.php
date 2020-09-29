<!DOCTYPE html>
<html lang="en-US">
    <?php include('header.php'); ?>
    <body>
        <div id="nav">
            <ul id="nav-content">
                <li><a href="#Home">Home</a></li>
                <li><a href="#Send_Message">Send Message</a></li>
            </ul>
        </div>
        <div id="main">
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - LedGrid</header>
        </div>
    </body>
</html>
<?php 
        $session = $_GET['session'];
        $myfile = fopen("/home/sbada9048/secure_pass", "r") or die("unable to open file!");
        fgets($myfile);
        fgets($myfile);
        $correctSession = trim(fgets($myfile));
        fclose($myfile);
        if ($session == $correctSession) {
        }
        else {
            header('Location: ../index.php?failed=2');
        }
?>