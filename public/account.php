<?php
    include "login-check.php";
    include "templates/header.php";
?>


        <h1 class="ui dividing header">My Account</h1>

        <!-- <h2 class="ui header">
            <div class="content">
                < echo htmlspecialchars($_SESSION["username"]); ?>
                <div class="sub header"><a href="reset-user.php">Change your Username</a></div>
            </div>
        </h2>

        <h2 class="ui header">
            <div class="content">
                ******
                <div class="sub header"><a href="reset-pwd.php">Change your Password</a></div>
            </div>
        </h2> -->


        <div class="ui basic label" tabindex="0">
            <h3>
                <i class="user icon"></i>
                <?php echo htmlspecialchars($_SESSION["username"]); ?>
            </h3>
            <a class="ui disabled button" href="">
                Your Username
            </a>
        </div>

        <div class="ui basic label" tabindex="0">
            <h3>
                <i class="lock icon"></i>
                ******
            </h3>
            <a class="ui button" href="reset-pwd.php">
                Change Password
            </a>
        </div>
        <h1><a class="ui olive button" href="logout.php">Log Out</a></h1>


<?php
    include "templates/footer.php";
?>
