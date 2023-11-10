<?php
    require_once("../head/headersupport.php");
    if(empty($_SESSION['datas'])){
        header("Location:login.php");
    }
    require_once("../head/head.php");
    require_once("../../controller/homeController.php");
    $obj = new homeController();
    $rows = $obj->showsupport();
?>
<br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Problema</th>
            <th scope="col">Comentario</th>
        </tr>
    </thead>
    <body>
        <?php if($rows): ?>
            <?php foreach($rows as $row): ?>
                <tr>
                    <th><?= $row[0] ?></th>
                    <th><?= $row[2] ?></th>
                    <th><?= $row[3] ?></th>
                    <th>
                        <a href="read.php?ID=<?= $row[0]?>" class="btn btn-primary">Ver</a>
                        <a href="edit.php?ID=<?= $row[0]?>" class="btn btn-primary">Modificar</a>
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Desea eliminar el registro?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Una vez eliminado no se podra recuperar el registro 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                                        <a href="delete.php?ID=<?= $rows[0]?>" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">No hay registros</td>
            </tr>
        <?php endif; ?>
    </body>
</table>


<?php
    require_once("../head/footer.php");
?>