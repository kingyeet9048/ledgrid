<!DOCTYPE html>
<script type="text/javascript" src="../javascript/session.js"></script>
<!-- Information page. -->
<html lang="en-US">
    <?php include('header.php'); ?>
    <body>
        <?php include('navbar.php'); ?>
        <div id="main" class="slider">
        <header slide class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - How it Works</header>
            <!-- <input type="text" placeholder="Message" name="Message" id="Message" value="" required> -->
            <div id="content">
                <p class="blue"> Fadecandy controller hardware drives up to 512 LEDs, which arranged as 8 strips of up to 60 LEDs each 
                    It connects to a laptop that embedded computer over USB. You can control your lights through your computer.
                    The controller hardware updates every LED about 400 times per second rapidly between nearby brightness levels
                    for each color primary. You send a message through your computer and send through the hardware and gives out
                    the message using the LED lights.Which shows in the picture below.  
                    <img src="../img/FadeCandyPic.png">  
                    <br>We used processing java for our coding along with kubuntu (os) that is 
                    the operting system, and fc server that runs 
                    the fadecandy in the os.</br>
                </p>
            </div>
        </div>
        <p>
        </p>
    </body>
</html>
<?php include('../php/sessionchecker.php'); ?>
