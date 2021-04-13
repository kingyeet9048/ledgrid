<!-- More efficent code when you can add the navbar anywhere on the go.
That is why its in its own file.  -->
<div id="nav">
    <ul id="nav-content">
        <!-- Recieve the SESSIONID for the current session from a cookie 
        that was added when the user logged in.  -->
        <?php include('../php/GetSessionID.php'); ?>
        <!-- Follow this link convention when adding a new link -->
        <li><a href="<?php echo "home.php".getSession();?>">Home</a></li>
        <li><a href="<?php echo "Background.php".getSession();?>">Background</a></li>
        <li><a href="<?php echo "HowItWorks.php".getSession();?>">How It Works</a></li>
        <li><a href="<?php echo "SendMessage.php".getSession();?>">Send Message</a></li>
        <li><a href="../index.php" onclick="remove()">LOGOUT</a></li>
        <!-- Start of the session. Meant to keep people from staying on the page
        for too long.  -->
        <script src="../javascript/session.js"></script>

        <!-- this function will remove all cookies currently added.  -->
        <script type='text/javascript'>
            function remove() {
                var cookies = document.cookie.split(";");
                for (var i = 0; i < cookies.length; i++)
                    eraseCookie(cookies[i].split("=")[0]);
            }
        </script>
        
    </ul>
</div>