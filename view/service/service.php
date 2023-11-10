<?php
    require_once("../head/headerservice.php");
?>

<body>
    <form action="store.php" method="POST" autocomplete="off">
        <h2 class="fw-bolt text-center mt-3 mb-3">SOLICITA UN SERVICIO CON MOVE-IT</h2>
                    <div class="row text-center mx-4">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <input type="address" name="ORIGEN" required class="form-control" id="ORIGEN" placeholder="address" aria-describedby="inputGroupPrepend" required>
                                <label for="ORIGEN"> Dirección origen</label>
                            </div>
                        </div>
                    </div>  
                    <div class="row text-center mx-4">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <input type="address" name="DESTINO" required class="form-control" id="DESTINO" placeholder="address" aria-describedby="inputGroupPrepend" required>
                                <label for="DESTINO"> Dirección destino</label>
                            </div>
                        </div>
                    </div>   
                    <div class="form-floating mb-2 mx-5">
                        <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15908.372921616297!2d-74.09271535!3d4.5772749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sco!4v1667516889211!5m2!1ses!2sco"  margin= "0 auto" width="1250" height="270" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>
                    <div class="row text-center mx-4">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <input type="time" name="HORA" required class="form-control" id="HORA" placeholder="time" aria-describedby="inputGroupPrepend" required>
                                <label for="HORA">Hora del servicio</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-2">
                                    <input type="date" name="FECHA" required class="form-control" id="FECHA" placeholder="date" aria-describedby="inputGroupPrepend" required>
                                    <label for="FECHA">Fecha del servicio</label>
                            </div>
                        </div> 
                    </div>
                    <div class="row text-center mx-4">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <select type="city" name="TIPO" aria-placeholder="city" required class="form-select" aria-label="Default select example" required>
                                    <option value="Tipo_servicio" selected disabled>Tipo de servicio</option>
                                    <option value="Grúa">Grúa</option>
                                    <option value="Camión(carga delicada)">Camión(carga delicada)</option>
                                    <option value="Camión(carga normal)">Camión(carga normal)</option>
                                    <option value="Camión(carga pesada)">Camión(carga pesada)</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col">
                            <div class="form-floating mb-2">
                                <select type="amount" name="CANTIDAD" aria-placeholder="amount" required class="form-select" aria-label="Default select example" required>
                                    <option value="Cantidad de cajas o electrodomesticos" selected disabled>Cantidad de cajas o electrodomesticos</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4 o más">4 o más</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row text-center mb-2 mt-2 mx-5">
                        <div class="d-grid col-6">
                            <button type="submit" name="enviar" id="enviar" value="Solicitar" class="btn btn-lg btn-primary">Solicitar</button>
                        </div>
                        <div class="d-grid col-6">
                            <a class="btn btn-lg btn-danger" href="index.php">Cancelar</a>
                        </div>
                    </div>                
    </form>
</body>

<?php
    require_once("../head/footer.php");
?>