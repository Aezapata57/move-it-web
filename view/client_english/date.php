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
        $fecha_antigua = $obj->recogerFecha($email);
        $hora_antigua = $obj->recogerHora($email);
    }else{
        $fecha_antigua = "";
        $hora_antigua = "";
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
            <form action="save_time.php" method="POST">
                <div class="title_inventory row">
                    <p class="text_title_inventory">Scheduling your move</p>
                </div>
                <p class="separate_inventory"></p>
                <div class="text text-center pt-1 pb-1">
                    <p class="text-muted conditions mx-2">In this section, choose the appropriate date and time for your move, remember to follow the instructions.</p>
                </div>
                <p class="separate_inventory mb-3"></p>
                <?php if(!empty($_GET['error'])):?>
                    <div id="alertError" class="alert alert-danger mb-2" role="alert">
                        <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                    </div>
                <?php endif;?>
                <div class="title_date row">
                    <p class="text_title_date">Fecha:</p>
                </div>
                <div class="article form-outline mb-2">
                    <input type="date" name="fecha" id="fecha" class="form-control input" placeholder="Selecciona una fecha" value="<?php echo $fecha_antigua ?>" required>
                </div>
                <div class="text text-center pt-1 pb-1 mb-2">
                    <p class="text-muted conditions mx-2">Select a valid date, between Monday and Saturday, due to the policies of the page, moving services will not be carried out on Sundays or holidays.</p>
                </div>
                <div class="title_date row">
                    <p class="text_title_date">Hour:</p>
                </div>
                <div class="article form-outline mb-2">
                    <input type="time" name="hora" id="hora" class="form-control input" placeholder="Selecciona una hora" value="" required>
                </div>
                <div class="text text-center pt-1 pb-1 mb-2">
                    <p class="text-muted conditions mx-2">Select a valid time between 8am and 5pm for the start of your move, due to the policies of the page and for the safety of users, services will not be provided outside of these hours. Remember that the end time may vary due to various reasons. aspects.</p>
                </div>
                <div class="row step-container">
                    <div class="step text-center pt-1 pb-1 col">
                        <a class="btn next" href="location.php" id="loader_page">Last step</a>
                    </div>
                    <div class="step text-center pt-1 pb-1 col">
                        <button class="btn next" type="submit" id="loader_page">Next step</button>
                    </div>
                </div>
            </form>
        </div>
    <?php
    require_once("../head/footer.php");
    ?>