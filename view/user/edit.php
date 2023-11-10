<?php
    require_once('../head/header.php');
    require_once('../head/head.php');
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    $user = $obj->read($_GET['ID']);
?>

<form action="update.php" method="post" autocomplete="off">
    <center><h2 class="mt-3">Modificando registro</h2></center>
    <div class="mb-3 mx-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-10">
            <input type="text" name="ID" readonly class="form-control-plaintext" id="staticEmail" value="<?= $user[0]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Nombre(s):</label>
        <div class="col-sm-10">
            <input type="text" name="NAMES" class="form-control" id="inputPassword" value="<?= $user[1]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Apellidos:</label>
        <div class="col-sm-10">
            <input type="text" name="SURNAMES" class="form-control" id="inputPassword" value="<?= $user[2]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Correo electronico:</label>
        <div class="col-sm-10">
            <input type="text" name="EMAIL" class="form-control" id="inputPassword" value="<?= $user[3]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Numero de celular(+57):</label>
        <div class="col-sm-10">
            <input type="text" name="PHONE" class="form-control" id="inputPassword" value="<?= $user[4]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Ciudad:</label>
        <div class="col-sm-10">
            <input type="text" name="CITY" class="form-control" id="inputPassword" value="<?= $user[5]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
        <div class="col-sm-10">
            <input type="text" name="DATE" class="form-control" id="inputPassword" value="<?= $user[7]?>">
        </div>
    </div>
    <div class="mb-3 mx-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">CC:</label>
        <div class="col-sm-10">
            <input type="text" name="CC" class="form-control" id="inputPassword" value="<?= $user[8]?>">
        </div>
    </div>

    <div class="mx-5">
        <input type="submit" class="btn btn-success" value="Actualizar">
        <a class="btn btn-danger" href="read.php?ID=<?= $user[0]?>">Cancelar</a>
    </div>
</form>

<?php
    require_once('../head/footer.php');


?>