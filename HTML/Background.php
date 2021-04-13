<!DOCTYPE html>
<!-- Information page. -->
<html lang="en-US">
    <!-- this links to the header page. All heading info will be loaded into this page. -->
    <?php include('header.php'); ?>
    <body>
        <!-- The navigation bar will be loaded the same way. -->
        <?php include('navbar.php'); ?>
        <!-- main div holder -->
        <div id="main" class="slider">
            <!-- TITLE -->
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - Background</header>
            <!-- The meat or content -->
            <div id="content">
                <p class="blue">  FadeCandy is tool that creates interactive light art using LED lighting. It runs many programming
                 languages such as python, processing java, and javascript. The fadecandy controller hardware has 
                 about 8 strips of up to 64 LEDs each and connects over USB. This is used to make LED easier and
                  creative tools. You can control your lights through your computer and send out message using LED lights.
                </p>
            </div>
        </div>
    </body>
</html>
<!-- Will check the url for a valid session id. This will prevent imposters.  -->
<?php include('../php/sessionchecker.php'); ?>