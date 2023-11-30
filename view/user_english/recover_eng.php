<?php
require_once("../head/head_eng.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MOVE-IT - Recover password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../../asset/css/recover.css" rel="stylesheet">
</head>
<body>
    <div class="row g-0">
        <div class="col-lg-3 gradient"></div>
        <div class="col-lg-6">
            <div class="card-body p-md-5 mx-md-4">
                <div class="container-1">
                    <a class="row home" href="../../index_eng.php">
                        <div class="logo-text col-6">MOVE-IT</div>
                        <div class="logo col"></div>
                    </a>
                    <div class="container-2">
                        <h4 class="pb-1 mb-3 slogan">NOS MOVEMOS POR TI</h4>
                        <div class="pt-1 mb-2 pb-1 mx-4">
                            <div class="text-muted password">Enter your email, by clicking "Send Recovery Link", you will receive a link in your entered email to reset your password</div>
                        </div>
                        <form action="recover_password.php" method="POST" autocomplete="off">
                            <div class="form-outline mb-2 mx-3">
                                <input type="email" name="EMAIL" class="form-control input" id="EMAIL" placeholder="name@example.com" aria-describedby="inputGroupPrepend" required>
                                <label for="EMAIL" class="form-label"></label>
                            </div>
                            <?php if(!empty($_GET['message'])):?>
                                <div id="alertMessage" style="margin: auto;" class="alert alert-success mb-2" role="alert">
                                    <?= !empty($_GET['message']) ? $_GET['message'] : ""?>
                                </div>
                            <?php endif;?>
                            <?php if(!empty($_GET['error'])):?>
                                <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                                    <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                                </div>
                            <?php endif;?>
                            <div class="text-center pt-1 mb-2 pb-1">
                                <button class="iniciar-sesion mb-3" type="submit">Send Recovery Link</button>
                                <a class="text-muted password" href="login.php">Return to Login</a>
                            </div>
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
