<!DOCTYPE html>
<html lang="en-US">
    <!-- this links to the header page. All heading info will be loaded into this page. -->
    <?php include('header.php'); ?>
    <body>
        <!-- The navigation bar will be loaded the same way. -->
        <?php include('navbar.php'); ?>
        <!-- Will check the url for a valid session id. This will prevent imposters.  -->
        <?php include('../php/sessionchecker.php'); ?>
        <!-- Main/Container -->
        <div id="main" class="slider">
            <!-- TITLE -->
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - Settings</header>
            <div id="content">
                <a href="../index.php" onclick="remove()">LOGOUT</a>
                <br>
                <a href="<?php echo "Profile.php".getSession();?>">Profile Information</a>
                <br>
                <a id="admin">ALL Messages (Admin only)</a>
            </div>
        </div>
    </body>
</html>
<script src="../javascript/isAdmin.js"></script>