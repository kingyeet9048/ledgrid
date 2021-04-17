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
            <header class="center" style="font-size: 30px; padding-top: 60px;">WSU CS Project - Settings</header>
            <div id="content">
                <table style="text-align: center; width: 100%; display: flex; justify-content: space-evenly;">
                    <tr>
                        <th id="field">Field</th>
                        <th id="content">Content</th>
                    </tr>
                    <tr>
                        <td>
                            <label for="name">Name</label>
                        </td>
                        <td>
                            <p id="name"></p>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="role">Role</label>
                        </td>
                        <td>
                            <p id="role"></p>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email</label>
                        </td>
                        <td>
                            <p id="email"></p>
                            <br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>