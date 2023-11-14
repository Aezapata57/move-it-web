<?php
    require_once("../head/head.php");
    if(!empty($_SESSION['datas'])){
        header("Location:panel_control.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MOVE-IT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../asset/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="row g-0">
        <div class="col-lg-6">
            <div class="card-body p-md-5 mx-md-4">
                <div class="container-1">
                    <a class="row home" href="../../index.php">
                            <div class="logo-text col-6">MOVE-IT</div>
                            <div class="logo col"></div>
                    </a>
                    <div class="container-2">
                        <h4 class="pb-1 mb-3 slogan">NOS MOVEMOS POR TI</h4>
                            <form action="session.php" method="POST" autocomplete="off">
                                
                                <div class="form-outline mb-2 mx-3">
                                    <input type="email" name="EMAIL" class="form-control input" id="EMAIL" placeholder="name@example.com" aria-describedby="inputGroupPrepend" required>
                                    <label for="EMAIL" class="form-label"></label>
                                </div>
                                <div class="form-outline mb-2 mx-3">
                                    <input type="password" name="PASSWORD" class="form-control input" id="PASSWORD" placeholder="password" aria-describedby="inputGroupPrepend" required minlength="8" autocomplete="current-password" dir="ltr">
                                    <div class="box-eye">
                                        <button type="button" onclick="mostrarContraseña('PASSWORD','eyepassword')">
                                            <i id="eyepassword" class="fa-sharp fa-solid fa-eye changePassword"></i>
                                        </button>
                                    </div>
                                    <label for="PASSWORD" class="form-label"></label>
                                </div>
                                <?php if(!empty($_GET['error'])):?>
                                    <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                                        <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                                    </div>
                                <?php endif;?>               
                                <div class="text-center pt-1 mb-2 pb-1">
                                    <button class="iniciar-sesion mb-3" type="submit">Iniciar sesión</button>
                                    <a class="text-muted password" href="recover.php">¿Olvidaste tu contraseña?</a>
                                </div>
                
                                <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2 new-register-1">¿No tienes cuenta?</p>
                                    <a href="signup.php" class="new-register-2">Registrate</a>
                                </div>
                            </form>
                        <div class="text-center">
                            <span class="text">Ó inicia sesión con:</span>
                        </div>
                        <!-- LOGIN CON REDES SOCIALES -->
                        <div class="container w-100 mt-2 mb-3">
                            <div class="row text-center">
                                <div class="row">
                                    <div class="col">
                                        <button onclick="onLogin();" class='btn btn-outline-primary w-100 my-1 mx-2'>
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <img src="../../asset/image/Facebook.png" width="30px" alt="">
                                                </div>
                                                <div class="col-10 text-center">
                                                    Facebook
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class='btn btn-outline-danger w-100 my-1 mx-2'>
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <img src="../../asset/image/Google.png" width="30px" alt="">
                                                </div>
                                                <div class="col-10 text-center">
                                                    Google
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 gradient">
            <div class="background1"><img src="../../asset/image/one.png" alt="uno"></div>
            <div class="separate"></div>
            <div class="background2"><img src="../../asset/image/two.png" alt="dos"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../asset/js/main.js"></script>
</body>
</html>