<script src="../javascript/session.js"></script>
<!DOCTYPE html>
<html lang="en-US">
    <?php include('header.php'); ?>
    <body>
        <?php include('navbar.php'); ?>
        <div id="main">
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - LedGrid</header>
            <!-- <input type="text" placeholder="Message" name="Message" id="Message" value="" required> -->
            <div class="content">
            </div>
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