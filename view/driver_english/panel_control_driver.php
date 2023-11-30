<?php
    require_once("../head_english/header_driver_eng.php");
    require_once("../../controller/homeController.php");

    $obj = new homeController();

    if(empty($_SESSION['datas'])){
        header("Location:../user_english/login_eng.php");
    }

    $email = $_SESSION['datas'];
    $type = $obj->RecogerTipo($email);

    if ($type != "Conductor") {
        header("Location:../client/panel_control_client.php");
    }
?>
    <h1 class="text-center mt-4 mb-5">Bienvenido <?= $_SESSION['datas']?></h1>
    <div class="row text-center">
        <div class="col-5">
        </div>
        <div class="d-grid col-2">
            <a href="../service/service.php" class="btn btn-Inicio_sesion btn-primary">Driver</a>
        </div>
        <div class="d-grid col-2">
            <a href="../service/service.php" class="btn btn-Inicio_sesion btn-primary">Request service</a>
        </div>
        <div class="d-grid col-2">
            <a href="../quiz/quiz.php" class="btn btn-Inicio_sesion btn-primary">Assessment</a>
        </div>
    </div>
<?php
    require_once("../head/footer_eng.php");
?>