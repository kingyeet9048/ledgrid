<!DOCTYPE html>
<!-- Information page. -->
<html lang="en-US">
    <?php include('../HTML/header.php'); ?>
    <script type="text/javascript">
        function goBack() {
            window.location.href = "../";
        }
    </script>
    <body>
        <div id="main"> 
            <header class="center mb-4" style="font-size: 50px; padding-top: 60px;">Sign Up</header>
            <div style="text-align: center; width: 100%; display: flex; justify-content: space-evenly;">    
                <div id="content">
                    <form>
                        <div id="inputs">
                            <input type="text" id="FirstName" class="form-control mb-4" placeholder="First Name" required>

                            <input type="text" id="LastName" class="form-control mb-4" placeholder="Last Name" required>

                            <input type="email" id="Email" class="form-control mb-4" placeholder="Email" required>

                            <input type="text" id="Username" class="form-control mb-4" placeholder="Username" required>

                            <input type="password" id="Password" class="form-control mb-4" aria-describedby="materialRegisterFormPasswordHelpBlock" placeholder="Password" required>

                            <input type="password" id="ActCode" class="form-control mb-4" placeholder="Activation Code" required>
                        </div>
                        <div id="newInput"></div>
                        <select class="form-control mb-4" id="select" onchange="checkOptions();">
                            <option value="Admin" selected="">Admin</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Student">Student</option>
                        </select>

                        <button class="btn btn-info mt-4 btn-outline-light" type="button" onclick="goBack();">Go Back</button>
                        <button class="btn btn-info mt-4 btn-outline-light" type="button" onclick="pushSignUp();">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>