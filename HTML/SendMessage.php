<!DOCTYPE html>
<script type="text/javascript" src="../javascript/session.js"></script>
<html lang="en-US">
    <?php include('header.php'); ?>
    <body>
        <?php include('navbar.php'); ?>
        <div id="main" class="slider">
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - Send Message</header>
            <div style="text-align: center; width: 100%; display: flex; justify-content: space-evenly;">
                <div id="content">
                    <form action="../php/clientSend.php" method="POST">
                        <table>
                            <tr>
                                <th id="messages">Messages</th>
                                <th id="panels">Panels</th>
                            </tr>
                            <tr>
                                <td>
                                    <label for="panel01">Message for First Panel (Top)</label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Panel01" name="panel01" id="panel01" value="">
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="panel02">Message for Second Panel (Middle)</label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Panel02" name="panel02" id="panel02">
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="panel03">Message for Third Panel (Bottom)</label>
                                </td>
                                <td>
                                    <input type="text" placeholder="Panel03" name="panel03" id="panel03">
                                    <br>
                                </td>
                            </tr>
                        </table>
                        <!-- Bootstrapped the css of the button. All I have to do is 
                        Call the class of the style I want to use. Makes for simplier
                        and faster programming. -->
                        <button type="submit" class="btn btn-outline-light" >Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php include('../php/sessionchecker.php'); ?>