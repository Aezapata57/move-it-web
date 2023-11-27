<?php
    require_once("view/head/headerindex.php");
?>


<head>
        <title>MOVE-IT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="asset/css/index.css" rel="stylesheet">
        <meta http-equiv="X-frame-Options" content="DENY">
        <script src="asset/js/main.js"></script>
</head>
<body>
<div class="overlay" id="overlay">
    <div class="loader"></div>
</div>
<div class="container-fluid">
    <div class="row section-1">
        <div class="col-5">
            <h4 class="pb-1 mb-3 slogan">NOS MOVEMOS POR TI</h4>
        </div>
        <div class="col section-1-right">
            <div class="container-section-1-right">

            </div>
        </div>
    </div>
    <div class="option-div">
        <div class="options">
            <img src="asset/image/ac.png" width="80" alt="">
            <div class="title-option">Atención personalizada</div>
            <div class="text-option">Te ofrecemos un servicio único, adaptado a tus necesidades, con atención especializada en cada detalle.</div>
        </div>
        <div class="options">
            <img src="asset/image/chat.png" width="80" alt="">
            <div class="title-option">Chat directo con el conductor</div>
            <div class="text-option">Mantén una comunicación constante con el conductor de tu mudanza a través de nuestro chat en tiempo real.</div>
        </div>
        <div class="options">
            <img src="asset/image/precios.png" width="80" alt="">
            <div class="title-option">Precios accesibles</div>
            <div class="text-option">Calidad y asequibilidad se unen en nuestros precios, para que mudarte no sea un dolor de cabeza para tu bolsillo.</div>
        </div> 
    </div>
    <div class="option-div">
        <div class="options">
            <img src="asset/image/pa.png" width="80" alt="">
            <div class="title-option">Profesionales en el área</div>
            <div class="text-option">Nuestro equipo interno está orientado a satisfacer tus necesidades y garantizar que tu mudanza sea una experiencia sin preocupaciones.</div>
        </div>
        <div class="options">
            <img src="asset/image/soporte.png" width="80" alt="">
            <div class="title-option">Soporte 24/7</div>
            <div class="text-option">Estamos disponibles las 24 horas del día, los 7 días de la semana, para brindarte apoyo en cualquier momento.</div>
        </div>
    </div>
    <div class="row footer">
        <div class="col-5 rights">
            <p class="">© 2023 Move-it Corp. All rights reserved</p>
        </div>
        <div class="col-5"></div>
        <div class="col socials">
            <button class="x"></button>
            <button class="youtube"></button>
            <button class="instagram"></button>
        </div>
    </div>
</div>
</body>


<?php
    require_once("view/head/footer.php");
?>