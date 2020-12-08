<!DOCTYPE html>
<!-- Information page. -->
<html lang="en-US">
    <?php include('../HTML/header.php'); ?>
    <body>
        <script>
            $(document).ready(function(){
                $('#CP').keypress(function(e){
                    if(e.keyCode==13)
                        $('#submit').click();
                });
            });
            $(document).ready(function(){
                $('#NP').keypress(function(e){
                    if(e.keyCode==13)
                        $('#submit').click();
                });
            });
            $(document).ready(function(){
                $('#AC').keypress(function(e){
                    if(e.keyCode==13)
                        $('#submit').click();
                });
            });
        </script>
        <div id="main"> 
        <header class="center" style="font-size: 30px; padding-top: 60px;">Password Reset</header>
        <div style="text-align: center; width: 100%; display: flex; justify-content: space-evenly;">    
            <div id="content">  
                <form>
                    <table >
                        <tr>
                            <td>
                                <label style=" text-shadow: 0px 0px 1px rgb(255,255,255);">Current Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Current password" name="CP" id="CP" value="">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label style=" text-shadow: 0px 0px 1px rgb(255,255,255);">New Password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="New Password" name="NP" id="NP">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label style=" text-shadow: 0px 0px 1px rgb(255,255,255);">Activation Code</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Activation Code" name="AC" id="AC">
                                <br>
                            </td>
                        </tr>
                    </table>
                </form>
                <button id="submit" type="button" class="btn btn-outline-light" style="padding: 3px " onclick="reset();">Reset</button>
            </div>
        </div>
        </div>
    </body>
</html>