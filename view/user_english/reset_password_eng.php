<?php
require_once("../../controller/homeController.php");
require_once("../../config/config.php");

$obj = new homeController();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
    $token = $_GET["token"];

    $validToken = $obj->verificarTokenRecuperacion($token);

    if ($validToken) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>MOVE-IT - Password Recovery</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link href="../../asset/css/reset_password.css" rel="stylesheet">
        </head>
        <body>
            <div class="row g-0">
                <div class="col-lg-3 gradient"></div>
                <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
                        <div class="container-1">
                            <a class="row home" href="../../index.php">
                                <div class="logo-text col-6">MOVE-IT</div>
                                <div class="logo col"></div>
                            </a>
                            <div class="container-2">
                                <h4 class="pb-1 mb-3 slogan">NOS MOVEMOS POR TI</h4>
                                <div class="pt-1 mb-2 pb-1 mx-4">
                                    <div class="text-muted password">Enter the new password. Remember to set a strong password for your account.</div>
                                </div>
                                <?php if(!empty($_GET['error'])):?>
                                    <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                                        <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                                    </div>
                                <?php endif;?>
                                <form action="update_password.php" method="POST">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    <div class="form-outline mb-2 mx-3">
                                        <input type="password" name="PASSWORD" class="form-control input" id="PASSWORD" placeholder="Contraseña" value="<?= (!empty($_GET['PASSWORD'])) ? $_GET['PASSWORD'] : "" ?>" aria-describedby="inputGroupPrepend" required>
                                        <label for="PASSWORD"></label>
                                    </div>
                                    <div class="form-outline mb-2 mx-3">
                                            <input type="password" name="CONFIRM" class="form-control input" id="CONFIRM" placeholder="Confirma tu contraseña" value="<?= (!empty($_GET['CONFIRM'])) ? $_GET['CONFIRM'] : "" ?>" aria-describedby="inputGroupPrepend" required>
                                            <label for="CONFIRM"></label>
                                    </div>
                                    <button type="submit" class="iniciar-sesion mb-3">Restore password</button>
                                </form>
                            </div>      
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 gradient-2"></div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <script src="../../asset/js/main.js"></script>
        </body>
        </html>
        <?php
    } else {
        $error = "<li>The link you entered is no longer valid, try again.</li>";
        header("Location: recover.php?error=". $error);
    }
} else {
    header("Location: login.php");
    exit();
}
?>
