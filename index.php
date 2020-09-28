<!DOCTYPE html>
<html lang="en-US">
    <?php include('HTML/header.php'); ?>
    <body>
        <div class='main'>
            <header class="center">WSU CS Project - LedGrid</header>
            <div id="loginContainer">
                <form action="php/action.php" method="POST">
                    <p id="p1"></p>
                    <input type="text" placeholder="Username" name="username" id="username" value="" required>
                    <br>
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <br>
                    <button type="submit" class="btn btn-outline-light">Login</button>
                </form>
            </div>
        </div>
        <?php 
            if($_GET['failed'] == 1) {
                echo '<script>document.getElementById("p1").innerHTML = "Username or password is incorrect. Please try again.";</script>';
            }
            echo "<script>document.getElementById('username').value = '".$_GET['username']."';</script>";
        ?>
    </body>
</html>
