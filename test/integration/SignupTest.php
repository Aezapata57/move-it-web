<?php
declare(strict_types=1);
require_once(__DIR__ . '/../../controller/homeController.php');

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    public function testSuccessfulSignup(): void
    {
        chdir(__DIR__ . '/../../../view/user'); // Establecer el directorio de trabajo a la ubicación de signup.php

        // Simular una solicitud POST a signup.php con datos válidos
        $_POST['EMAIL'] = 'usuario@dominio.com';
        $_POST['PHONE'] = '1234567890';
        $_POST['CITY'] = 'Bogota';
        $_POST['PASSWORD'] = 'password';
        $_POST['CONFIRM'] = 'password';
        $_POST['DATE'] = '1990-01-01';
        $_POST['CC'] = '123456789';
        $_POST['TYPE'] = 'Cliente';
        $_POST['TOKEN'] = '';
        $_POST['VERIFICADO'] = '';
        $_POST['INTENTOS'] = '';
        $_POST['ULTIMO_INTENTO'] = '';
        $_POST['RECUPERACION_TOKEN'] = '';
        $_POST['RECUPERACION_EXPIRACION'] = '';
        // ... otros campos necesarios

        ob_start();
        include 'signup.php'; // Ejecutar signup.php
        ob_end_clean();

        chdir(__DIR__); // Restaurar el directorio de trabajo actual después de la prueba
        // Esto es importante para evitar posibles efectos secundarios en otras pruebas

        // Verificar que el usuario haya sido registrado correctamente
        $homeController = new homeController();
        $isUserRegistered = $homeController->verificarEmail('usuario@dominio.com');
        $this->assertTrue($isUserRegistered, 'El usuario no se registró correctamente');

        // Puedes continuar agregando más pruebas para otros escenarios
    }
}
