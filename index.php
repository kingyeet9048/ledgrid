<!DOCTYPE html>
<html>
    <?php include('HTML/header.php'); ?>
    <body>
        <div class='main'>
            <header class="center" style="font-size: 30px; text-shadow: 0px 0px 5px rgb(255,255,255); color: white;">WSU CS Project - LedGrid</header>
            <div id="loginContainer">
                <form action="php/action.php" method="POST">
                    <input type="text" placeholder="Username" name="username" id="username" required>
                    <br>
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <br>
                    <button type="submit" onclick="validator();">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
