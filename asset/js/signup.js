$(document).ready(function() { 
    // Calcular la fecha hace 18 años
    var fechaHace18Anios = new Date();
    fechaHace18Anios.setFullYear(fechaHace18Anios.getFullYear() - 18);

    // Obtener la fecha en formato 'yyyy-mm-dd'
    var formattedDate = fechaHace18Anios.getFullYear() + '-' + ('0' + (fechaHace18Anios.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaHace18Anios.getDate()).slice(-2);

    $("#DATE").datepicker({
        dateFormat: 'yy-mm-dd', // Cambiar el formato de fecha a 'yyyy-mm-dd'
        showOn: 'focus', // Mostrar el calendario al hacer clic en el campo
        changeMonth: true, // Permitir cambiar el mes
        changeYear: true, // Permitir cambiar el año
        defaultDate: formattedDate // Establecer la fecha predeterminada en formato 'yyyy-mm-dd'
    }).attr('readonly', 'true'); // Agregar el atributo readonly al campo de fecha
});




$(document).ready(function() {
    $('input[type="name"]').disableAutoFill();
    $('input[type="surname"]').disableAutoFill();
    $('input[type="text"]').disableAutoFill();
    $('input[type="password"]').disableAutoFill();
    $('input[type="email"]').disableAutoFill();
    $('input[type="tel"]').disableAutoFill();
    $('input[type="number"]').disableAutoFill();
    // Otros tipos de campos que desees desactivar
});