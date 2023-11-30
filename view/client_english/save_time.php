<?php

require_once("../../controller/homeController.php");
require_once("../user/session_started.php");

$obj = new homeController();

$email = $_SESSION['datas'];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$error = "";

// Función para verificar si una fecha es festivo colombiano
function esFestivoColombiano($fecha) {
    // Lista de festivos colombianos hasta el año 2026
    $festivos_colombianos = [
        "2023-01-01", "2023-01-09", "2023-03-20", "2023-04-06", "2023-04-07", "2023-05-01", "2023-05-22", "2023-06-12",
        "2023-06-19", "2023-07-03", "2023-07-20", "2023-08-07", "2023-08-21", "2023-10-16", "2023-11-06", "2023-11-13",
        "2023-12-08", "2023-12-25", "2024-01-01", "2024-01-08", "2024-03-25", "2024-03-28", "2024-03-29", "2024-05-01",
        "2024-05-13", "2024-06-03", "2024-06-10", "2024-07-01", "2024-07-20", "2024-08-07", "2024-08-19", "2024-10-14",
        "2024-11-04", "2024-11-11", "2024-12-08", "2024-12-25", "2025-01-01", "2025-01-06", "2025-03-24", "2025-04-17",
        "2025-04-18", "2025-05-01", "2025-06-02", "2025-06-23", "2025-06-30", "2025-07-20", "2025-08-07", "2025-08-18",
        "2025-10-13", "2025-11-03", "2025-11-17", "2025-12-08", "2025-12-25", "2026-01-01", "2026-01-12", "2026-03-23",
        "2026-04-09", "2026-04-10", "2026-05-01", "2026-05-25", "2026-06-15", "2026-06-22", "2026-07-20", "2026-08-07",
        "2026-08-17", "2026-10-12", "2026-11-02", "2026-11-16", "2026-12-08", "2026-12-25"
    ];    
    return in_array($fecha, $festivos_colombianos);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    // Convertir fecha al formato de festivos
    $fecha_formateada = date("Y-m-d", strtotime($fecha));
    $dia_semana = date("w", strtotime($fecha));
    $hora_valida = strtotime($hora) >= strtotime('08:00:00') && strtotime($hora) <= strtotime('17:00:00');
    
    // Verificar si la fecha es un festivo colombiano
    if (esFestivoColombiano($fecha_formateada)) {
        // Redirigir con un mensaje de error
        $error .= "<li>Services will not be held on holidays, please choose another date</li>";
        header("Location:date.php?error=" . $error);
        exit();
    }else if ($dia_semana == 0) { // Si es domingo (7)
        $error .= "<li>Services will not be held on Sundays, please choose another date</li>";
        header("Location:date.php?error=" . $error);
        exit();
    }else if (!$hora_valida) {
        $error .= "<li>Services will not be performed before 8am or after 5pm, please choose a valid time</li>";
        header("Location:date.php?error=" . $error);
        exit();
    }else if ($fecha_formateada < $fecha_actual || ($fecha_formateada == $fecha_actual && strtotime($hora) < strtotime($hora_actual))) {
        $error .= "<li>The selected date and time is earlier than the current date and time</li>";
        header("Location:date.php?error=" . $error);
        exit();
    }else{
        $obj->guardarFechaHora($email, $fecha, $hora);
        header("Location:confirm.php");
    }
}
?>