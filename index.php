<!DOCTYPE html>
<html lang="en-US">
    <!-- Include the head -->
    <?php include('HTML/header.php'); ?>
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
    <body>
        <!-- Entire page -->
        <div class='main'>
            <header class="center">WSU CS Project - LedGrid</header>
            <!-- Anything that has to do with the login. -->
            <div id="loginContainer">
                <!-- Everything will process so fast in the form, you wont
                even notice the switch. Basically redirects. -->
                <form action="php/action.php" method="POST">
                    <p id="p1"></p>
                    <input type="text" placeholder="Username" name="username" id="username" value="" required>
                    <br>
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <br>
                    <!-- Bootstrapped the css of the button. All I have to do is 
                    Call the class of the style I want to use. Makes for simplier
                    and faster programming. -->
                    <button id="submit" type="button" class="btn btn-outline-light" onclick="en();">Login</button>
                </form>
            </div>
        </div>
        <!-- Variables will be by the url for failed login or timeout.  -->
        <?php 
            if($_GET['failed'] == 1) {
                echo '<script>document.getElementById("p1").innerHTML = "Username or password is incorrect. Please try again.";</script>';
            }
            else if ($_GET['failed'] == 2) {
                echo '<script>document.getElementById("p1").innerHTML = "Please verify your credentials and login.";</script>';
            }
        ?>
    </body>
</html>
