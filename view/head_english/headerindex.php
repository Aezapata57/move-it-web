<?php
    require_once("head_eng.php");

?>
<div class="container-fluid primer-div">
    <div class="row">
        <div class="col-4">
            <div class="row logo-col">
                <div class="logo-text col">MOVE-IT</div>
                <div class="logo col-3"></div>
            </div>
        </div>
        <div class="col-2 about-col">
            <a href="" class="about">About us</a>
        </div>
        <div class="col-2 contact-col">
            <a href="" class="contact">Contact us</a>
        </div>
        <div class="col-4 session-col">
            <div>
                <?php if(empty($_SESSION['datas'])): ?>
                    <div class="row session">
                        <div class="col login">
                            <a href="view/user/login_eng.php" class="login-a" id="loader_page">Log in</a>
                        </div>
                        <div class="col-2 separate"></div>
                        <div class="col register">
                            <a href="view/user/signup_eng.php" class="register-a" id="loader_page">Register</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row session">
                        <div class="col login">
                            <a href="view/client/panel_control_client_eng.php" class="home-a" id="loader_page">Go to start</a>
                        </div>
                        <div class="col-2 separate"></div>
                        <div class="col register">
                            <a href="view/user/logout_eng.php" class="logout-a" id="loader_page">Log out</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>