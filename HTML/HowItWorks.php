<!DOCTYPE html>
<!-- Information page. -->
<html lang="en-US">
    <!-- this links to the header page. All heading info will be loaded into this page. -->
    <?php include('header.php'); ?>
    <body>
        <!-- The navigation bar will be loaded the same way. -->
        <?php include('navbar.php'); ?>
        <!-- Main/container -->
        <div id="main" class="slider">
            <!-- TITLE -->
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - How it Works</header>
            <!-- meat or content -->
            <div id="content">
                <p class="blue">
                    Fadecandy controller hardware drives up to 512 LEDs, which arranged as 8 strips of up to 60 LEDs each 
                    It connects to a laptop that embedded computer over USB. You can control your lights through your computer.
                    The controller hardware updates every LED about 400 times per second rapidly between nearby brightness levels
                    for each color primary. You send a message through your computer and send through the hardware and gives out
                    the message using the LED lights.Which shows in the picture below.  
                    <img src="../img/FadeCandyPic.png" alt="FADECANDY DEVICE">  
                    <br>We used processing java for our coding along with kubuntu (os) that is 
                    the operting system, and fc server that runs 
                    the fadecandy in the os.
                </p>
            </div>
        </div>
        <p>
        </p>
    </body>
</html>
<!-- Will check the url for a valid session id. This will prevent imposters.  -->
<?php include('../php/sessionchecker.php'); ?>
