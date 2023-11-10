<?php
    require_once("../head/header.php");
    if(empty($_SESSION['datas'])){
        header("Location:login.php");
    }
?>
    <h1 class="text-center mt-4 mb-5">Bienvenido <?= $_SESSION['datas']?></h1>
    <div class="row text-center">
        <div class="col-5">
        </div>
        <div class="d-grid col-2">
            <a href="../service/service.php" class="btn btn-Inicio_sesion btn-primary">Solicitar servicio</a>
        </div>
        <div class="d-grid col-2">
            <a href="../quiz/quiz.php" class="btn btn-Inicio_sesion btn-primary">Evaluacion</a>
        </div>
    </div>
<?php
    require_once("../head/footer.php");
?>