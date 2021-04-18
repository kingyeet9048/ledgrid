<!DOCTYPE html>
<html lang="en-US">
    <!-- Include the head -->
    <?php include('HTML/header.php'); ?>
    <body>
        <script>
            $(document).ready(function(){
                $('#username').keypress(function(e){
                    if(e.keyCode==13)
                        $('#submit').click();
                });
            });
            $(document).ready(function(){
                $('#password').keypress(function(e){
                    if(e.keyCode==13)
                        $('#submit').click();
                });
            });
        </script>
        <!-- Entire page -->
        <div class='main'>
            <!-- Anything that has to do with the login. -->
            <div id="loginContainer">
            <header class="center" style="margin-bottom: -65px">WSU CS Project - LedGrid</header>
            <br>
            <img id="userImg" src="img/thumbnail_Icon.png" alt="Profile Img" style="width:480px;height:250px; padding-right: 2.5em">
                <!-- Everything will process so fast in the form, you wont
                even notice the switch. Basically redirects. -->
                <form action="php/action.php" method="POST">
                    <p id="p1" style="margin-top: -80px "></p>
                    <input type="text" placeholder="Username" name="username" id="username" value="" required>
                    <br>
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <br>
                    <!-- Bootstrapped the css of the button. All I have to do is 
                    Call the class of the style I want to use. Makes for simplier
                    and faster programming. -->
                    <button id="submit" type="button" class="btn btn-info mt-4 btn-outline-light" onclick="en();">Login</button>  
                </form>
                <br>
                <p style="color: white;" id="signup">Don't have an account? <a href="php/signup.php">Sign up Now!</a></p>
                <a href="php/ResetPassword.php">Reset Password</a>
            </div>
        </div>
        <?php
            include('php/makeentries.php');
            // Variables will be by the url for failed login or timeout.
            if(isset($_GET['failed'])) {
                if($_GET['failed'] == 1) {
                    echo '<script>document.getElementById("p1").innerHTML = "Username or password is incorrect. Please try again.";</script>';
                }
                else if ($_GET['failed'] == 2) {
                    echo '<script>document.getElementById("p1").innerHTML = "Please verify your credentials and login.";</script>';
                }
                else if ($_GET['failed'] == 3){
                    echo '<script>document.getElementById("p1").innerHTML = "Password change failed. ";</script>';
                }
                else if ($_GET['failed'] == 4){
                    echo '<script>document.getElementById("p1").innerHTML = "Please use a different email or username.";</script>';
                }
                else if ($_GET['failed'] == 5){
                    echo '<script>document.getElementById("p1").innerHTML = "The code you entered is not correct. Please try again.";</script>';
                }
            }
            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time()-1000);
                    setcookie($name, '', time()-1000, '/');
                }
            }
        ?>
    </body>
</html>
