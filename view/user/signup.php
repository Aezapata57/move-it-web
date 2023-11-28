<?php
    require_once("../head/head.php");
    require_once("../../config/config.php");
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="../../asset/css/signup.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://cdn.jsdelivr.net/gh/zebzhao/jQuery.disableAutoFill/dist/jquery.disableAutoFill.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../../asset/js/main.js"></script>
        <script src="../../asset/js/signup.js"></script>
    </head>
    <body>
        <div class="row g-0">
            <div class="col-lg-6 gradient">

            </div>
            <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                    <div class="container-1">
                        <a class="row home" href="../../index.php">
                            <div class="logo-text col-6">MOVE-IT</div>
                            <div class="logo col"></div>
                        </a>
                        <div class="container-2">
                            <form action="store.php" method="POST" autocomplete="off">
                                <?php if(!empty($_GET['error'])):?>
                                    <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                                        <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                                    </div>
                                <?php endif;?>
                                <div class="row text-center mx-1">
                                    <hr>
                                    <div class="col">
                                        <div class="form-outline mb-2">
                                            <input type="name" name="NAMES" class="form-control input" id="NAMES" placeholder="Nombre(s)" aria-describedby="inputGroupPrepend" value="<?= isset($_GET['NAMES']) ? $_GET['NAMES'] : (isset($nombre) ? $nombre : '') ?>" autocomplete="off" required>
                                            <label for="NAMES"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-2">
                                            <input type="surname" name="SURNAMES" class="form-control input" id="SURNAMES" placeholder="Apellidos" aria-describedby="inputGroupPrepend" value="<?= isset($_GET['SURNAMES']) ? $_GET['SURNAMES'] : (isset($apellidos) ? $apellidos : '') ?>" autocomplete="off" required>
                                            <label for="SURNAMES"></label>
                                        </div>
                                    </div>
                                </div>    
                                    
                                <div class="form-outline mb-2 mx-3">
                                    <input type="email" name="EMAIL" class="form-control input" id="EMAIL" placeholder="Correo electronico" value="<?= isset($_GET['EMAIL']) ? $_GET['EMAIL'] : (isset($email) ? $email : '') ?>" aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                    <label for="EMAIL"></label>
                                </div>
                                
                                <div class="row text-center mx-1">
                                    <div class="col">
                                        <div class="form-outline mb-2">
                                            <input type="tel" name="PHONE" class="form-control input" id="PHONE" placeholder="Telefono(+57)" aria-describedby="inputGroupPrepend" value="<?= isset($_GET['PHONE']) ? $_GET['PHONE'] : (isset($telefono) ? $telefono : '') ?>" autocomplete="off" required>
                                            <label for="PHONE"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                            <select type="city" name="CITY" aria-placeholder="Ciudad" class="form-select form-outline input" aria-label="Default select example" autocomplete="off" required>
                                                <option value="" selected disabled>Ciudad</option>
                                                <option value="Arauca">Arauca</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Barranquilla">Barranquilla</option>
                                                <option value="Bogotá">Bogotá</option>
                                                <option value="Bucaramanga">Bucaramanga</option>
                                                <option value="Cali">Cali</option>
                                                <option value="Cartagena">Cartagena</option>
                                                <option value="Cúcuta">Cúcuta</option>
                                                <option value="Florencia">Florencia</option>
                                                <option value="Ibagué">Ibagué</option>
                                                <option value="Leticia">Leticia</option>
                                                <option value="Manizales">Manizales</option>
                                                <option value="Medellín">Medellín</option>
                                                <option value="Mitú">Mitú</option>
                                                <option value="Mocoa">Mocoa</option>
                                                <option value="Montería">Montería</option>
                                                <option value="Neiva">Neiva</option>
                                                <option value="Pasto">Pasto</option>
                                                <option value="Pereira">Pereira</option>
                                                <option value="Popayán">Popayán</option>
                                                <option value="Puerto Carreño">Puerto Carreño</option>
                                                <option value="Puerto Inírida">Puerto Inírida</option>
                                                <option value="Quibdó">Quibdó</option>
                                                <option value="Riohacha">Riohacha</option>
                                                <option value="San Andrés">San Andrés</option>
                                                <option value="San José del Guaviare">San José del Guaviare</option>
                                                <option value="Santa Marta">Santa Marta</option>
                                                <option value="Sincelejo">Sincelejo</option>
                                                <option value="Tunja">Tunja</option>
                                                <option value="Valledupar">Valledupar</option>
                                                <option value="Villavicencio">Villavicencio</option>
                                                <option value="Yopal">Yopal</option>
                                            </select>
                                        </div>  
                                </div>
                                
                                <div class="form-outline mb-2 mx-3">
                                    <input type="password" name="PASSWORD" class="form-control input" id="PASSWORD" placeholder="Contraseña" value="" aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                    <label for="PASSWORD"></label>
                                </div>
                                <div class="form-outline mb-2 mx-3">
                                        <input type="password" name="CONFIRM" class="form-control input" id="CONFIRM" placeholder="Confirma tu contraseña" value="" aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                        <label for="CONFIRM"></label>
                                </div>            
                                <div class="row text-center mx-1">
                                    <div class="col-6">
                                        <div class="form-outline mb-2">
                                                <input type="text" name="DATE" class="form-control input" id="DATE" placeholder="Nacimiento" aria-describedby="inputGroupPrepend" value="<?= isset($_GET['DATE']) ? $_GET['DATE'] : (isset($fecha) ? $fecha : '') ?>" autocomplete="off" required>
                                                <label for="DATE"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-2">
                                                <input type="number" name="CC" class="form-control input" id="CC" placeholder="N° identidad" aria-describedby="inputGroupPrepend" value="<?= isset($_GET['CC']) ? $_GET['CC'] : (isset($cc) ? $cc : '') ?>" autocomplete="off" required>
                                                <label for="CC"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-2 mx-3">
                                    <select type="type" name="TYPE" aria-placeholder="tipo" class="form-select form-outline input" aria-label="Default select example" autocomplete="off" required>
                                        <option value="" selected disabled>Tipo de usuario</option>
                                        <option value="Cliente">Cliente</option>
                                        <option value="Conductor">Conductor</option>
                                    </select>
                                </div>
                                <p class="text-muted conditions mx-2">Al hacer clic en "Registrarse", aceptas nuestras Condiciones, la Política de privacidad y la Política de cookies.</p>
                                <div class="text-center pt-1 pb-1">
                                    <button class="mb-3 registrarse" type="submit">Registrarse</button>
                                </div>

                                <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2 new-login-1">¿Ya tienes cuenta?</p>
                                    <a href="login.php" class="new-login-2">Inicia sesión</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>

<?php
    require_once("../head/footer.php");
?>