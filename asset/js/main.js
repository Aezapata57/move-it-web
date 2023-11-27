function mostrarContraseña(idPassword, idIcon){
    let inputPassword = document.getElementById(idPassword);
    let icon = document.getElementById(idIcon);
    if(inputPassword.type =="password" && icon.classList.contains("fa-eye")){
        inputPassword.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    }else{
        inputPassword.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}

window.fbAsyncInit = function() {
    FB.init({
    appId      : '852563055938241',
    cookie     : true,
    xfbml      : true,
    version    : 'v8.0'
    });
    
    FB.AppEvents.logPageView();
    
};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function onLogin(){
FB.login((response) => {
    if(response.authResponse){
        FB.api('/me', (response) => {
            console.log(response)
        })
    }
})
}

function mostrarOpciones() {
    const tipoInventario = document.getElementById("tipo-inventario").value;

    const opciones = document.querySelectorAll('[id^="opciones-"]');
    opciones.forEach((opcion) => {
        if (opcion.id === `opciones-${tipoInventario.replace(/ /g, "-")}`) {
            opcion.style.display = "block";
            opcion.removeAttribute('disabled');
            opcion.setAttribute('required', 'required');
        } else {
            opcion.style.display = "none";
            opcion.removeAttribute('required');
            opcion.disabled = true;
        }
    });
}


let directionsRenderer; // Declara directionsRenderer fuera de la función initMap

function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 4.640843, lng: -74.1080917 },
        zoom: 11,
        gestureHandling: 'none',
        draggable: false,
        zoomControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        streetViewControl: false,
        fullscreenControl: false,
        mapTypeControl: false,
    });

    const geocoder = new google.maps.Geocoder();
    const autocompleteOrigen = new google.maps.places.Autocomplete(document.getElementById('origen'));
    const autocompleteDestino = new google.maps.places.Autocomplete(document.getElementById('destino'));

    directionsRenderer = new google.maps.DirectionsRenderer({ map: map });

    // Esta función calculará la ruta y mostrará la distancia y el tiempo estimado en el mapa
    function calcularRuta() {
        // Borra la ruta existente antes de trazar una nueva
        directionsRenderer.setDirections({ routes: [] });

        const directionsService = new google.maps.DirectionsService();

        const request = {
            origin: document.getElementById('origen').value,
            destination: document.getElementById('destino').value,
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, (result, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(result);

                const distancia = result.routes[0].legs[0].distance.text;
                const tiempo = result.routes[0].legs[0].duration.text;

                // Mostrar la distancia y el tiempo estimado en tu página
                document.getElementById('distancia').innerText = `Distancia: ${distancia}`;
                document.getElementById('tiempo').innerText = `Tiempo estimado: ${tiempo}`;

                ocultarCarga();
            } else {
                alert('Error al calcular la ruta: ' + status);
                ocultarCarga();
            }
        });
    }

    verificarCampos = function() {
        const origen = document.getElementById('origen').value;
        const destino = document.getElementById('destino').value;

        if (!origen || !destino) {
            alert('Por favor, completa los campos de origen y destino.');
            return;
        }

        calcularRuta(); // Actualiza el mapa si los campos están completos
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const calcularBtn = document.getElementById("calcularBtn");
    if (calcularBtn) {
        calcularBtn.addEventListener("click", function() {
            if (typeof verificarCampos === 'function') {
                mostrarCarga();
                verificarCampos(); // Llama a la función verificarCampos si está definida
            } else {
                console.error('La función verificarCampos no está definida.');
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById("loader_page");
    if (loader) {
        loader.addEventListener("click", function() {
                mostrarCarga();
        });
    }
});

// Esta función muestra el círculo de carga y el fondo opaco
function mostrarCarga() {
    document.getElementById('overlay').style.display = 'flex'; // Muestra el overlay
}

// Esta función oculta el círculo de carga y el fondo opaco
function ocultarCarga() {
    document.getElementById('overlay').style.display = 'none'; // Oculta el overlay
}


$(document).ready(function() { 
    // Calcular la fecha hace 18 años
    var fechaHace18Anios = new Date();
    fechaHace18Anios.setFullYear(fechaHace18Anios.getFullYear() - 18);

    // Obtener la fecha en formato 'dd/mm/yyyy'
    var formattedDate = ('0' + fechaHace18Anios.getDate()).slice(-2) + '/' + ('0' + (fechaHace18Anios.getMonth() + 1)).slice(-2) + '/' + fechaHace18Anios.getFullYear();

    $("#DATE").datepicker({
        dateFormat: 'dd/mm/yy', // Formato de fecha deseado para la visualización
        showOn: 'focus', // Mostrar el calendario al hacer clic en el campo
        changeMonth: true, // Permitir cambiar el mes
        changeYear: true, // Permitir cambiar el año
        defaultDate: formattedDate // Establecer la fecha predeterminada en formato 'dd/mm/yyyy'
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
