<?php
    require_once("head_eng.php");
    
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
                            <a class="nav-link active" aria-current="page" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Prices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact us</a>
                        </li>
                    </ul>
                    <a href="../user/login.php" class="boton">Log in</a>
                    <a href="../user/signup.php" class="boton">Register</a>
                </div>
                <?php else: ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../user/show.php">See registered users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../support/show_p.php">View user issues</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="show.php">View service requests</a>
                        </li>
                    </ul>
                    <a href="../user/logout.php" class="boton">Log out</a>
                </div>
                <?php endif ?>

            </div>
        </nav>
    </div>
</div>
<div class="fondo">