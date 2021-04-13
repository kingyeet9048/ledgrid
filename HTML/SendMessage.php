<!DOCTYPE html>
<html lang="en-US">
    <!-- this links to the header page. All heading info will be loaded into this page. -->
    <?php include('header.php'); ?>
    <body>
        <!-- The navigation bar will be loaded the same way. -->
        <?php include('navbar.php'); ?>
        <!-- Will check the url for a valid session id. This will prevent imposters.  -->
        <?php include('../php/sessionchecker.php'); ?>
        <!-- Main/Container -->
        <div id="main" class="slider">
            <!-- TITLE -->
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - Send Message</header>
            <div style="text-align: center; width: 100%; display: flex; justify-content: space-evenly;">
                <div id="content">
                    <!-- Form for sending messages to the clientSend.php file using a secure POST connection.  -->
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
                        <div id="Suggestions"></div>
                        <!-- Bootstrapped the css of the button. All I have to do is 
                        Call the class of the style I want to use. Makes for simplier
                        and faster programming. -->
                        <button type="submit" class="btn btn-outline-light" >Submit</button>
                    </form>
                    <!-- Empty div here so all new suggestions can be added via javascript (createElement) -->
                    <div style="margin-top: 1rem;" id="newCards"></div>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- This javascript file is loaded every render of the page. Will add suggestions if there are any to add.  -->
<script src="../javascript/getMessages.js"></script>