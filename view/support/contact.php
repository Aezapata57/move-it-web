<!DOCTYPE html>
<html lang="es">
    <head>
        <title>MOVE-IT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="../../asset/css/estilos.css" rel="stylesheet">
        
    </head>
    <body class="bodyRegister">

               
        
    <div class="container bg-form w-50 mt-5 mb-5">
        <div class="row align-items-stretch">
            <br>
            <div class="text-center mt-3 mb-2">
                <img src="../../asset/image/Logo.png" width="160px" alt="">
                <h2 class="fw-bolt text-center mb-3">¿Como podemos ayudarte?</h2>
                <hr>
            </div>
            <h5 class="fw-bolt text-center mb-2">Uno de nuestros principales objetivos es que te sientas conforme con los servicios que MOVE-IT ofrece para ti, es por esto que nos preocupa tu inconformidad.</h5>
            <h5 class="fw-bolt text-center mb-2">¿Cual es tu problema?</h5> 
            <br><br>
            <form action="store_contact.php" method="POST" autocomplete="off"> 
                <div class="form-floating mb-2">
                    <input type="name" name="NAMES" class="form-control" id="NAMES" placeholder="name" aria-describedby="inputGroupPrepend" required>
                    <label for="NAMES">Nombre(s)</label>
                </div>
                <div class="row text-center" style="height:65px; margin-left: 1px; margin-right: 1px;">
                    <select type="text" name="PROBLEM" aria-placeholder="PROBLEM" class="form-select form-floating" aria-label="Default select example" required>
                        <option value="" selected disabled>Problema o incoveniente a solucionar</option>
                        <option value="Problemas con registro.">Problemas con registro.</option>
                        <option value="No puedo iniciar sesion de ninguna forma.">No puedo iniciar sesion de ninguna forma.</option>
                        <option value="Problemas con reconocimiento de contraseña.">Problemas con reconocimiento de contraseña.</option>
                        <option value="Devolucion de dinero.">Devolucion de dinero.</option>
                        <option value="Quejas y reclamos.">Quejas y reclamos.</option>
                        <option value="Mal servicio a la hora de mudanza.">Mal servicio a la hora de mudanza.</option>
                        <option value="Otros.">Otros.</option>
                    </select>
                </div>  
                <div class="form-floating mb-2">
                    <input type="text" name="COMENT" class="form-control"style="height:200px;" id="COMENT" placeholder="Comentarios" aria-describedby="inputGroupPrepend" required>
                    <label for="COMENT">Comentarios (max 255)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" name="PHONE" class="form-control" id="PHONE" placeholder="PHONE" aria-describedby="inputGroupPrepend" required>
                    <label for="PHONE">Numero Celular(+57)</label>
                </div>
            
                <div class="d-grid mb-2 mx-2">
                    <button class="btn btn-lg btn-contact btn-default2">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <img src="../../asset/image/WHATSAPP.png" width="30px" alt="">
                            </div>
                            <div class="col-8 text-center">
                                Comunicarse con un asesor
                            </div>
                        </div>
                    </button>
                </div>
                <div class="d-grid mb-4 mx-2">
                    <input type="submit" class="btn btn-lg btn-Inicio_sesion btn-default" name="Enviar" value="Enviar">
                </div>   
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>