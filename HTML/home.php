<!DOCTYPE html>
<!-- Information page. -->
<html lang="en-US">
    <!-- this links to the header page. All heading info will be loaded into this page. -->
    <?php include('header.php'); ?>
    <body>
        <!-- The navigation bar will be loaded the same way. -->
        <?php include('navbar.php'); ?>
        <!-- TITLE -->
        <div id="main" class="slider"> 
        <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - LedGrid</header>
            <!-- meat or content -->
            <div id="content">
              <img src="../img/LED.gif" width="600" height="600" style="margin-top: 2em;" alt="NAME GIF">
            </div>
        </div>
    </body>
</html>
<!-- Will check the url for a valid session id. This will prevent imposters.  -->
<?php include('../php/sessionchecker.php'); ?>