<?php

use GuzzleHttp\Psr7\Header;

require_once("../../controller/homeController.php");
require_once("../user/session_started.php");

$obj = new homeController();

$email = $_SESSION['datas'];

$base = "7500";
$articulos = $obj->traerArticulos($email);

$origen = $obj->recogerOrigen($email);
$destino = $obj->recogerDestino($email);
$fecha = $obj->recogerFecha($email);
$hora = $obj->recogerHora($email);

$preciosPorTipo = [
    "Sofá"=>  0.6,
    "Silla"=>  0.4,
    "Mesa"=>  0.6,
    "Cama"=>  0.8,
    "Colchón"=>  0.8,
    "Armario"=>  0.8,
    "Escritorio"=>  0.6,
    "Estantería"=>  0.6,
    "Nevera/Refrigerador"=>  0.8,
    "Lavadora"=>  0.8,
    "Microondas"=>  0.6,
    "Secadora"=>  0.6,
    "Televisión"=>  0.6,
    "Computador"=>  0.6,
    "Ollas y sartenes"=>  0.4,
    "Vajilla"=>  0.4,
    "Pequeños electrodomésticos"=>  0.4,
    "Ropa"=>  0.4,
    "Zapatos"=>  0.4,
    "Artículos de aseo personal"=>  0.4,
    "Lámparas"=>  0.4,
    "Espejos"=>  0.4,
    "Cuadros/Decoraciones de pared"=>  0.4,
    "Plantas de interior"=>  0.4,
    "Herramientas básicas"=>  0.4,
    "Equipo de jardinería"=>  0.6,
    "Artículos deportivos"=>  0.6,
];

$precioPorKilometro = 750;
$costoTotal = $base;

// Calcular el costo total basado en los artículos y la distancia (reemplaza 'distancia' con tu valor real)
$distancia = 15; // Ejemplo de distancia en kilómetros obtenida de algún lugar

// Crear el mensaje con el costo total y los detalles del cálculo
$message = "<b>TU PEDIDO HA SIDO GUARDADO CON EXITO, NO OLVIDES VERIFICARLO POR MEDIO DE TU CORREO ELECTRONICO PARA QUE SE TE ASIGNE UN CONDUCTOR</b><br>";
$message .= "<li>Tarifa base: $" . number_format($base, 2) . " COP</li>";
$message .= "<li>Detalle de artículos y sus precios:</li>";

foreach ($articulos as $articulo) {
    $tipo = $articulo['ARTICULO']; // Obtener el tipo del artículo
    $cantidad = $articulo['CANTIDAD']; // Obtener la cantidad del artículo

    if (isset($preciosPorTipo[$tipo])) {
        $subtotalArticulo = $base * $preciosPorTipo[$tipo] * $cantidad;
        $message .= "&nbsp;&nbsp;&nbsp;&nbsp;- $tipo x $cantidad: $" . number_format($subtotalArticulo, 2) . " COP<br>";
        $costoTotal += $subtotalArticulo;
    }
}

$subtotalDistancia = $distancia * $precioPorKilometro;
$message .= "<li>Costo por distancia ($distancia km a $precioPorKilometro COP/km): $" . number_format($subtotalDistancia, 2) . " COP</li>";

$costoTotal += $subtotalDistancia;
$message .= "<li>Costo total: $" . number_format($costoTotal, 2) . " COP</li>";

// Redirigir a panel_control_client.php con el mensaje de costo total y detalles como parámetro
header("Location: panel_control_client.php?message=" . urlencode($message));
exit(); // Terminar la ejecución del script después de la redirección

?>