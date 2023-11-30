<?php
require_once("../head_english/header_client_eng.php");
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
    <div class="overlay">
        <div class="loader"></div>
    </div>
    <div class="container-fluid">
        <div class="title_inventory row">
            <p class="text_title_inventory">What do you want to take with you on your move?</p>
        </div>
        <p class="separate_inventory"></p>
        <div class="text text-center pt-1 pb-1">
            <p class="text-muted conditions mx-2">In this section, choose the items you should take with you during your move. Don't worry if you add the wrong item, you can delete it.</p>
        </div>
        <p class="separate_inventory"></p>
        <form  action="save_inventory.php" id="registroForm" method="POST">
            <div class="article form-outline">
                <label for="tipo-inventario"></label>
                <select name="TIPO" id="tipo-inventario" onchange="mostrarOpciones()" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select a category</option>
                    <option value="Mobiliario">Furniture</option>
                    <option value="Electrodomésticos">Home appliances</option>
                    <option value="Ropa y Articulos">Clothing and Items</option>
                    <option value="Decoración y Misceláneos">Decoration and Miscellaneous</option>
                    <option value="Herramientas y Equipos">Tools and Equipment</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Mobiliario" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Mobiliario" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select an article</option>
                    <option value="Sofá">Couch</option>
                    <option value="Silla">Chairs</option>
                    <option value="Mesa">Tables</option>
                    <option value="Cama">Bed</option>
                    <option value="Colchon">Mattress</option>
                    <option value="Armario">Cupboard</option>
                    <option value="Escritorio">Desk</option>
                    <option value="Estanteria">Shelving</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Electrodomésticos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Electrodomésticos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select an article</option>
                    <option value="Nevera/Refrigerador">Fridge/Refrigerator</option>
                    <option value="Lavadora">Washing machine</option>
                    <option value="Microondas">Microwave</option>
                    <option value="Secadora">Dryer</option>
                    <option value="Television">Television</option>
                    <option value="Computador">Computer</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Utensilios-de-Cocina" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Utensilios-de-Cocina" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select an article</option>
                    <option value="Ollas y sartenes">Pots and pans</option>
                    <option value="Vajilla">Crockery</option>
                    <option value="Pequeños electrodomésticos">Small appliances</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Ropa-y-Articulos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Ropa-y-Articulos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select an article</option>
                    <option value="Ropa">Clothes</option>
                    <option value="Zapatos">Shoes</option>
                    <option value="Artículos de aseo personal">Personal toiletries</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Decoración-y-Misceláneos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Decoración-y-Misceláneos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select an article</option>
                    <option value="Lámparas">Lamps</option>
                    <option value="Espejos">Mirrors</option>
                    <option value="Cuadros/Decoraciones de pared">Paintings/Wall Decorations</option>
                    <option value="Plantas de interior">Inside plants</option>
                </select>
            </div>

            <div class="article form-outline" id="opciones-Herramientas-y-Equipos" style="display: none;">
                <label for="opciones"></label>
                <select name="OPCIONES" id="opciones-Herramientas-y-Equipos" class="form-select form-outline input" required>
                    <option value="" selected disabled>Select an article</option>
                    <option value="Herramientas básicas">Basic tools</option>
                    <option value="Equipo de jardinería">gardening equipment</option>
                    <option value="Artículos deportivos">Sports articles</option>
                </select>
            </div>

            <div class="article form-outline mb-2">
                <label for="cantidad"></label>
                <input type="number" name="CANTIDAD" id="cantidad" class="form-control input" placeholder="Cantidad" required min="1">
            </div>
            <div class="agregar text-center pt-1 pb-1">
                <button class="mb-3 registrarse" type="submit" id="loader_page">Add Article</button>
            </div>
        </form>
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
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($datosTabla as $fila) : ?>
                    <tr>
                        <td><?php echo $fila['ID']; ?></td>
                        <td><?php echo $fila['TIPO']; ?></td>
                        <td><?php echo $fila['ARTICULO']; ?></td>
                        <td><?php echo $fila['CANTIDAD']; ?></td>
                        <td><a href="delete_article.php?ID=<?php echo $fila['ID']; ?>" class="btn btn-danger">Eliminate</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <div class="caption text-center">
            <div class="text-muted mx-2">List of your inventory, remember to add everything you will take in your move</div>
        </div>
        <div class="agregar text-center pt-1 pb-1">
            <a class="btn next" href="location.php" id="loader_page">Next step</a>
        </div>
    </div>
<?php
require_once("../head/footer.php");
?>