<?php
    require_once("head_eng.php");
    require_once("../../controller/homeController.php");

    $obj = new homeController();
    $tabla = $obj->tablaExiste($_SESSION['datas']);
?>
<div class="container-fluid primer-div">
    <div class="row">
        <div class="col-4">
            <div class="row logo-col">
                <div class="logo-text col">MOVE-IT</div>
                <div class="logo col-3"></div>
            </div>
        </div>
        <?php if($tabla === true): ?>
            <div class="col-4 service-col">
                <a class="service" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Request service</a>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-modal">
                            <h1 class="modal-title fs-5" id="staticBackdrop">Alert</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-modal">
                        You already have a service in process
                            <br>
                            Do you want to continue?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-modal" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary text-modal" href="new_service.php" id="loader_page">Create new</a>
                            <a type="button" class="btn btn-success text-modal" href="inventary.php" id="loader_page">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
        <div class="col-4 service-col">
            <a href="create_service_eng.php" class="service" id="loader_page">Request service</a>
        </div>
        <?php endif; ?>
        <div class="col-2 settings-col">
            <a href="" class="settings">Settings</a>
        </div>
        <div class="col-2 session-col">
            <div>
                <?php if(empty($_SESSION['datas'])): ?>
                    <div class="row session">
                        <div class="col login">
                            <a href="view/user/login_eng.php" class="login-a" id="loader_page">Login</a>
                        </div>
                        <div class="col-2 separate"></div>
                        <div class="col register">
                            <a href="view/user/signup_eng.php" class="register-a" id="loader_page">Register</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row session">
                        <div class="col register">
                            <a href="../user/logout_eng.php" class="logout-a" id="loader_page">Logout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
    require_once("footer_eng.php");
?>