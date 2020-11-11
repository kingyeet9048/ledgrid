<div id="nav">
    <ul id="nav-content">
        <?php include('../php/GetSessionID.php'); ?>
        <li><a href="<?php echo "home.php".getSession();?>">Home</a></li>
        <li><a href="<?php echo "SendMessage.php".getSession();?>">Send Message</a></li>
        <!-- Start of the session. Meant to keep people from staying on the page
        for too long.  -->
        <script src="../javascript/session.js"></script> 
    </ul>
</div>