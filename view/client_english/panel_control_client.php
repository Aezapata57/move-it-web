<?php
    require_once("../head/header_client_home.php");
    require_once("../../controller/homeController.php");

    $obj = new homeController();

    if(empty($_SESSION['datas'])){
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="../../asset/css/panel_control_client.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <h1 class="text-center mt-4 mb-5">Bienvenido <?= $_SESSION['datas']?></h1>
    <?php if(!empty($_GET['message'])):?>
        <div id="alertMessage" class="alert alert-success mb-2" role="alert">
            <?= !empty($_GET['message']) ? $_GET['message'] : ""?>
        </div>
    <?php endif;?>
</div>   
</body>
<?php
    require_once("../head/footer.php");
?>