<?php
    require_once('../head/headerservice.php');
    require_once('../head/head.php');
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    $user = $obj->readservice($_GET['ID']);
?>

<form action="update.php" method="post" autocomplete="off">
    <h2>Modificando registro</h2>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-10">
            <input type="text" name="ID" readonly class="form-control-plaintext" id="staticEmail" value="<?= $user[0]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Origen:</label>
        <div class="col-sm-10">
            <input type="text" name="ORIGEN" class="form-control" id="inputPassword" value="<?= $user[1]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Destino:</label>
        <div class="col-sm-10">
            <input type="text" name="DESTINO" class="form-control" id="inputPassword" value="<?= $user[2]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Hora:</label>
        <div class="col-sm-10">
            <input type="text" name="HORA" class="form-control" id="inputPassword" value="<?= $user[3]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Fecha:</label>
        <div class="col-sm-10">
            <input type="text" name="FECHA" class="form-control" id="inputPassword" value="<?= $user[4]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Tipo:</label>
        <div class="col-sm-10">
            <input type="text" name="TIPO" class="form-control" id="inputPassword" value="<?= $user[4]?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Cantidad:</label>
        <div class="col-sm-10">
            <input type="text" name="CANTIDAD" class="form-control" id="inputPassword" value="<?= $user[4]?>">
        </div>
    </div>

    <div>
        <input type="submit" class="btn btn-success" value="Actualizar">
        <a class="btn btn-danger" href="read.php?ID=<?= $user[0]?>">Cancelar</a>
    </div>
</form>

<?php
    require_once('../head/footer.php');


?>