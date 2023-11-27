<?php
    require_once("head.php");
    
?>

<div class="fondo_menu">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel_control.php"><img src="../../asset/image/Name.png" width="160px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <?php if(empty($_SESSION['datas'])): ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            
                        </li>
                        <li class="nav-item">
                            
                        </li>
                        <li class="nav-item">
                           
                        </li>
                    </ul>
                    <a href="login.php" class="boton" id="loader_page">Inicia Session</a>
                    <a href="signup.php" class="boton" id="loader_page">Registrate</a>
                </div>
                <?php else: ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            
                        </li>
                        <li class="nav-item">
                            
                        </li>
                        <li class="nav-item">
                            
                        </li>
                    </ul>
                    <a href="logout.php" class="boton" id="loader_page">Cerrar Sesion</a>
                </div>
                <?php endif ?>

            </div>
        </nav>
    </div>
</div>
<div class="fondo">

