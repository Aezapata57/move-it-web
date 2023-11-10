<?php
    require_once("head.php");
    
?>

<div class="fondo_menu">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../user/panel_control.php"><img src="../../asset/image/Name.png" width="160px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <?php if(empty($_SESSION['datas'])): ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Precios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactanos</a>
                        </li>
                    </ul>
                    <a href="../user/login.php" class="boton">Inicia Session</a>
                    <a href="../user/signup.php" class="boton">Registrate</a>
                </div>
                <?php else: ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../user/show.php">Ver usuarios registrados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../support/show_p.php">Ver problemas de los usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="show.php">Ver solicitudes de servicios</a>
                        </li>
                    </ul>
                    <a href="../user/logout.php" class="boton">Cerrar Sesion</a>
                </div>
                <?php endif ?>

            </div>
        </nav>
    </div>
</div>
<div class="fondo">