    <?php
    require_once("../head/header_client.php");
    require_once("../../controller/homeController.php");

    $obj = new homeController();

    if (empty($_SESSION['datas'])) {
        header("Location:../user/login.php");
    }

    $email = $_SESSION['datas'];
    $type = $obj->RecogerTipo($email);

    if ($type != "Cliente") {
        header("Location:../driver/panel_control_driver.php");
    }

    $emailverificado = $obj->verificarDireccionEmail($email);

    if ($emailverificado) {
        $origen_antiguo = $obj->recogerOrigen($email);
        $destino_antiguo = $obj->recogerDestino($email);
    }else{
        $origen_antiguo = "";
        $destino_antiguo = "";
    }
    ?>

    <head>
        <title>MOVE-IT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../asset/css/inventary.css" rel="stylesheet">
        <script src="../../asset/js/main.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYl1UOXedon5rpWbXbSbQI1YDO81eJtLU&libraries=places,geometry&callback=initMap" async defer></script>
    </head>

    <body>
        <div class="overlay" id="overlay">
            <div class="loader"></div>
        </div>
        <div class="container-fluid">
            <form action="save_location.php" method="POST">
                <div class="title_inventory row">
                    <p class="text_title_inventory">Localización de tu mudanza</p>
                </div>
                <p class="separate_inventory"></p>
                <div class="text text-center pt-1 pb-1">
                    <p class="text-muted conditions mx-2">En esta seccion, elige las direcciones de origen y destino para tu mudanza, recuerda solo ingresar direcciones asociadas en Bogota para que tu servicio sea correcto.</p>
                </div>
                <p class="separate_inventory mb-3"></p>
                <div class="title_date row">
                    <p class="text_title_date">Origen:</p>
                </div>
                <div class="article form-outline mb-4">
                    <input type="text" name="origen" id="origen" class="form-control input" placeholder="Selecciona un origen" value="<?php echo $origen_antiguo ?>" required>
                </div>
                <div class="title_date row">
                    <p class="text_title_date">Destino:</p>
                </div>
                <div class="article form-outline mb-2">
                    <input type="text" name="destino" id="destino" class="form-control input" placeholder="Selecciona un destino" value="<?php echo $destino_antiguo ?>" required>
                </div>

                <div class="agregar text-center pt-1 pb-1">
                    <button id="calcularBtn" class="mb-3 registrarse" type="button">Verificar y Calcular Tiempo</button>
                </div>

                <div class="text text-center">
                    <p class="text-muted conditions mx-2 text-center pt-1 pb-1" id="distancia">Distancia:</p>
                </div>
                <div class="text text-center">
                    <p class="text-muted conditions mx-2 text-center pt-1 pb-1" id="tiempo">Tiempo estimado:</p>
                </div>

                <div id="map" class="map"></div>

                <div class="row step-container">
                    <div class="step text-center pt-1 pb-1 col">
                        <a id="loader_page" class="btn next" href="inventary.php">Paso anterior</a>
                    </div>
                    <div class="step text-center pt-1 pb-1 col">
                        <button id="loader_page" class="btn next" type="submit">Siguente paso</button>
                    </div>
                </div>
            </form>
        </div>
    <?php
    require_once("../head/footer.php");
    ?>