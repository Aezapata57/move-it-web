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
    $datosTabla = $obj->obtenerDatosTabla($email);

    if ($emailverificado) {
        $fecha_antigua = $obj->recogerFecha($email);
        $hora_antigua = $obj->recogerHora($email);
    }else{
        $fecha_antigua = "";
        $hora_antigua = "";
    }

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-MrcW6ZMFYlzcLA8NlNl+NtUVUyJoyZ8j9WamEScpJ8H4/FFWzw33PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="../../asset/css/inventary.css" rel="stylesheet">
        <script src="../../asset/js/main.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYl1UOXedon5rpWbXbSbQI1YDO81eJtLU&libraries=places,geometry&callback=initMap" async defer></script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="title_inventory row">
                <p class="text_title_inventory">Confirmation</p>
            </div>
            <p class="separate_inventory"></p>
            <div class="text text-center pt-1 pb-1">
                <p class="text-muted conditions mx-2">Select a date and time.</p>
            </div>
            <p class="separate_inventory mb-3"></p>
                <div class="title_table row">
                    <p class="text_title_table">INVENTORY</p>
                </div>
                <div class="tabla_container">
                <table class="table table-striped table-hover table-border">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Type</th>
                            <th scope="col">Article</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($datosTabla as $fila) : ?>
                            <tr>
                                <td><?php echo $fila['ID']; ?></td>
                                <td><?php echo $fila['TIPO']; ?></td>
                                <td><?php echo $fila['ARTICULO']; ?></td>
                                <td><?php echo $fila['CANTIDAD']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
                <div class="caption text-center">
                    <div class="text-muted mx-2">List of your inventory</div>
                </div>
                <div class="agregar text-center pt-1 pb-1">
                    <a class="btn next" href="inventary.php" id="loader_page">Edit inventory</a>
                </div>
            <p class="separate_inventory mb-3 mt-3"></p>
                <div class="title_date row">
                    <p class="text_title_date">Origin:</p>
                </div>
                <div class="article form-outline mb-4">
                    <input type="text" name="origen" id="origen" class="form-control input" placeholder="Selecciona un origen" value="<?php echo $origen_antiguo ?>" disabled="disabled">
                </div>
                <div class="title_date row">
                    <p class="text_title_date">Destination:</p>
                </div>
                <div class="article form-outline mb-2">
                    <input type="text" name="destino" id="destino" class="form-control input" placeholder="Selecciona un destino" value="<?php echo $destino_antiguo ?>" disabled="disabled">
                </div>
                <div class="agregar text-center pt-1 pb-1">
                    <a class="btn next" href="location.php" id="loader_page">Edit addresses</a>
                </div>
            <p class="separate_inventory mb-3 mt-3"></p>
            <div class="title_date row">
                <p class="text_title_date">Date:</p>
            </div>
            <div class="article form-outline mb-2">
                <input type="date" name="destino" id="destino" class="form-control input" placeholder="Selecciona una fecha" value="<?php echo $fecha_antigua ?>" disabled="disabled">
            </div>
            <div class="title_date row">
                <p class="text_title_date">Hour:</p>
            </div>
            <div class="article form-outline mb-2">
                <input type="time" name="destino" id="destino" class="form-control input" placeholder="Selecciona una hora" value="<?php echo $hora_antigua ?>" disabled="disabled">
            </div>
            <div class="agregar text-center pt-1 pb-1">
                <a class="btn next" href="inventary.php" id="loader_page">Edit schedule</a>
            </div>
            <p class="separate_inventory mb-3 mt-3"></p>
            <div class="row step-container">
                <div class="step text-center pt-1 pb-1 col">
                    <a class="btn next" href="date.php" id="loader_page">Last step</a>
                </div>
                <div class="step text-center pt-1 pb-1 col">
                    <a class="btn next" href="save_confirm.php" id="loader_page">Calculate prices</a>
                </div>
            </div>
        </div>
    <?php
    require_once("../head/footer.php");
    ?>