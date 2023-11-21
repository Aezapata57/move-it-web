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
    ?>

    <head>
        <title>MOVE-IT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-MrcW6ZMFYlzcLA8NlNl+NtUVUyJoyZ8j9WamEScpJ8H4/FFWzw33PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="../../asset/css/inventary.css" rel="stylesheet">
        <script src="../../asset/js/main.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYl1UOXedon5rpWbXbSbQI1YDO81eJtLU&libraries=places,geometry&callback=initMap" async defer></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="title_inventory row">
                <p class="text_title_inventory">Destino</p>
            </div>
            <p class="separate_inventory"></p>
            <div class="text text-center pt-1 pb-1">
                <p class="text-muted conditions mx-2">Selecciona el destino.</p>
            </div>
            <p class="separate_inventory"></p>

            <p id="distancia"></p>
            <p id="tiempo"></p>
            <div class="article form-outline mb-2">
                <input type="text" name="ORIGEN" id="origen" class="form-control input" placeholder="Selecciona un origen">
            </div>
            <div class="article form-outline mb-2">
                <input type="text" name="DESTINO" id="destino" class="form-control input" placeholder="Selecciona un destino">
            </div>

            <div class="agregar text-center pt-1 pb-1">
                <button id="calcularBtn" class="mb-3 registrarse">Verificar y Calcular Tiempo</button>
            </div>

            <div id="map" class="map"></div>

            <div class="agregar text-center pt-1 pb-1">
                <a class="btn next" href="location.php">Siguente paso</a>
            </div>
        </div>
    <?php
    require_once("../head/footer.php");
    ?>