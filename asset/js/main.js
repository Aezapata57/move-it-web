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


let verificarCampos;
let shouldCalculate = false;
function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 4.640843, lng: -74.1080917 },
        zoom: 11
    });

    const geocoder = new google.maps.Geocoder();
    const autocompleteOrigen = new google.maps.places.Autocomplete(document.getElementById('origen'));
    const autocompleteDestino = new google.maps.places.Autocomplete(document.getElementById('destino'));

    

    // Esta función calculará la ruta y mostrará la distancia y el tiempo estimado en el mapa
    function calcularRuta() {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({ map: map });

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
            } else {
                alert('Error al calcular la ruta: ' + status);
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
                verificarCampos(); // Llama a la función verificarCampos si está definida
            } else {
                console.error('La función verificarCampos no está definida.');
            }
        });
    }
});
    