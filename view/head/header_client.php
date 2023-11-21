<?php
    require_once("head.php");

?>
<div class="container-fluid primer-div">
    <div class="row">
        <div class="col-4">
            <div class="row logo-col">
                <div class="logo-text col">MOVE-IT</div>
                <div class="logo col-3"></div>
            </div>
        </div>
        <div class="col-4 service-col">
            <a href="create_service.php" class="service">Solicitar servicio</a>
        </div>
        <div class="col-2 settings-col">
            <a href="" class="settings">Ajustes</a>
        </div>
        <div class="col-2 session-col">
            <div>
                <?php if(empty($_SESSION['datas'])): ?>
                    <div class="row session">
                        <div class="col login">
                            <a href="view/user/login.php" class="login-a">Iniciar sesión</a>
                        </div>
                        <div class="col-2 separate"></div>
                        <div class="col register">
                            <a href="view/user/signup.php" class="register-a">Registrarse</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row session">
                        <div class="col register">
                            <a href="view/user/logout.php" class="logout-a">Cerrar Sesion</a>
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