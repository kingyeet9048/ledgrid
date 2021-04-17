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
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - All messages</header>
            <div id="content">
                <p>Messages will populate here. Only admins will be able to view them. If you are not an admin, you wont see them.</p>
                <div id="AdminMessages">
                <table id="table" style="text-align: center; width: 100%; display: flex; justify-content: space-evenly;">
                    <tr>
                        <th id="t">T</th>
                        <th id="m">M</th>
                        <th id="b">B</th>
                        <th id="s">StarID</th>
                        <th id="d">Date</th>
                        <th id="n">Name</th>
                        <th id="r">Role</th>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="../javascript/getAllMessages.js"></script>