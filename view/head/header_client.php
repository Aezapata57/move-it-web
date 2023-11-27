<?php
    require_once("head.php");
    require_once("../../controller/homeController.php");

    $obj = new homeController();
    $tabla = $obj->tablaExiste($_SESSION['datas']);
?>
<div class="container-fluid primer-div">
    <div class="row">
        <div class="col-4">
            <a class="row logo-col" href="panel_control_client.php" id="loader_page">
                <div class="logo-text col">MOVE-IT</div>
                <div class="logo col-3"></div>
            </a>
        </div>
        <div class="col-4 service-col">
        </div>
        <div class="col-2 settings-col">
            <a href="" class="settings" id="loader_page">Ajustes</a>
        </div>
        <div class="col-2 session-col">
            <div>
                <?php if(empty($_SESSION['datas'])): ?>
                    <div class="row session">
                        <div class="col login">
                            <a href="view/user/login.php" class="login-a" id="loader_page">Iniciar sesión</a>
                        </div>
                        <div class="col-2 separate"></div>
                        <div class="col register">
                            <a href="view/user/signup.php" class="register-a" id="loader_page">Registrarse</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row session">
                        <div class="col register">
                            <a href="../user/logout.php" class="logout-a" id="loader_page">Cerrar Sesion</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
    require_once("footer.php");
?>