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
$datosTabla = $obj->obtenerDatosTabla($email);
?>

<head>
    <title>MOVE-IT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MrcW6ZMFYlzcLA8NlNl+NtUVUyJoyZ8j9WamEScpJ8H4/FFWzw33PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="../../asset/css/inventary.css" rel="stylesheet">
    <script src="../../asset/js/main.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="title_inventory row">
            <p class="text_title_inventory">¿Qué deseas llevar en tu mudanza?</p>
        </div>
        <p class="separate_inventory"></p>
        <div class="text text-center pt-1 pb-1">
            <p class="text-muted conditions mx-2">Al hacer clic en "Registrarse", aceptas nuestras Condiciones, la Política de privacidad y la Política de cookies.</p>
        </div>
        <p class="separate_inventory"></p>
        <form  action="save_inventory.php" id="registroForm" method="POST">
            <div class="article form-outline">
                <label for="tipo-inventario"></label>
                <select name="TIPO" id="tipo-inventario" onchange="mostrarOpciones()" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                    <option value="Mobiliario">Mobiliario</option>
                    <option value="Electrodomésticos">Electrodomésticos</option>
                    <option value="Ropa y Articulos">Ropa y Articulos</option>
                    <option value="Decoración y Misceláneos">Decoración y Misceláneos</option>
                    <option value="Herramientas y Equipos">Herramientas y Equipos</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Mobiliario" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Mobiliario" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione un articulo</option>
                    <option value="Sofá">Sofá</option>
                    <option value="Silla">Sillas</option>
                    <option value="Mesa">Mesas</option>
                    <option value="Cama">Cama</option>
                    <option value="Colchon">Colchon</option>
                    <option value="Armario">Armario</option>
                    <option value="Escritorio">Escritorio</option>
                    <option value="Estanteria">Estanteria</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Electrodomésticos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Electrodomésticos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione un articulo</option>
                    <option value="Nevera/Refrigerador">Nevera/Refrigerador</option>
                    <option value="Lavadora">Lavadora</option>
                    <option value="Microondas">Microondas</option>
                    <option value="Secadora">Secadora</option>
                    <option value="Television">Television</option>
                    <option value="Computador">Computador</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Utensilios-de-Cocina" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Utensilios-de-Cocina" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione un articulo</option>
                    <option value="Ollas y sartenes">Ollas y sartenes</option>
                    <option value="Vajilla">Vajilla</option>
                    <option value="Pequeños electrodomésticos">Pequeños electrodomésticos</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Ropa-y-Articulos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Ropa-y-Articulos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione un articulo</option>
                    <option value="Ropa">Ropa</option>
                    <option value="Zapatos">Zapatos</option>
                    <option value="Artículos de aseo personal">Artículos de aseo personal</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Decoración-y-Misceláneos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Decoración-y-Misceláneos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione un articulo</option>
                    <option value="Lámparas">Lámparas</option>
                    <option value="Espejos">Espejos</option>
                    <option value="Cuadros/Decoraciones de pared">Cuadros/Decoraciones de pared</option>
                    <option value="Plantas de interior">Plantas de interior</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Herramientas-y-Equipos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Herramientas-y-Equipos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Seleccione un articulo</option>
                    <option value="Herramientas básicas">Herramientas básicas</option>
                    <option value="Equipo de jardinería">Equipo de jardinería</option>
                    <option value="Artículos deportivos">Artículos deportivos</option>
                </select>
            </div>

            <div class="article form-outline mb-2">
                <label for="cantidad"></label>
                <input type="number" name="CANTIDAD" id="cantidad" class="form-control input" placeholder="Cantidad" required>
            </div>
            <div class="agregar text-center pt-1 pb-1">
                <button class="mb-3 registrarse" type="submit">Agregar Artículo</button>
            </div>
        </form>
        <div class="tabla_container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Articulo</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosTabla as $fila) : ?>
                    <tr>
                        <td><?php echo $fila['ID']; ?></td>
                        <td><?php echo $fila['TIPO']; ?></td>
                        <td><?php echo $fila['ARTICULO']; ?></td>
                        <td><?php echo $fila['CANTIDAD']; ?></td>
                        <td><a href="delete_article.php?ID=<?php echo $fila['ID']; ?>" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <div class="agregar text-center pt-1 pb-1">
            <a class="btn next" href="location.php">Siguente paso</a>
        </div>
    </div>
<?php
require_once("../head/footer.php");
?>