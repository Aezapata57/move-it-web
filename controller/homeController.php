<?php
    class homeController{
        private $MODEL;
        public function __construct()
        {
            require_once('../../model/homeModel.php');
            $this->MODEL = new homeModel();
        }
        //---------USUARIO---------//
        public function guardarUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado) {
            $valor = $this->MODEL->agregarNuevoUsuario($nombre, $apellidos, $this->limpiarcorreo($email), $telefono, $ciudad, $this->encriptarcontraseña($this->limpiarcadena($contraseña)), $fecha, $cc, $tipo, $token, $verificado);
            return $valor;
        }

        public function verificarEmail($email){
            $result = $this->MODEL->verificarRegistroEmail($email);
            return $result;
        }
        public function verificarCC($cc){
            $result = $this->MODEL->verificarRegistroCC($cc);
            return $result;
        }
        public function verificarTelefono($telefono){
            $result = $this->MODEL->verificarRegistroTelefono($telefono);
            return $result;
        }
        
        public function verificarToken(): bool {
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $result = $this->MODEL->validarToken($token);
        
                return $result;
            } else {
                return false;
            }
        }
    
        public function limpiarcadena($campo){
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_UNSAFE_RAW);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
        public function limpiarcorreo($campo){
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_SANITIZE_EMAIL);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
        public function encriptarcontraseña($contraseña){
            return password_hash($contraseña,PASSWORD_DEFAULT);
        }
        public function verificarusuario($email,$contraseña){
            $keydb = $this->MODEL->obtenerclave($email);
            return (password_verify($contraseña, $keydb)) ? $keydb : false;
        }

        public function validarVerificacion($email){
            $result = $this->MODEL->leerVerificacion($email);
            return $result;
        }

        public function guardartiempo($email, $lockout_time){
            $result = $this->MODEL->guardarLockoutTime($email, $lockout_time);
            return $result;
        }

        public function show(){
            return ($this->MODEL->show()) ? $this->MODEL->show() : false;
        }
        public function read($id){
            return ($this->MODEL->read($id) != false) ? $this->MODEL->read($id) : header("Location:show.php");
        }
        public function update($id, $nombre, $apellidos, $email, $telefono, $ciudad, $fecha, $cc){
            return($this->MODEL->update($id, $nombre, $apellidos, $email, $telefono, $ciudad, $fecha, $cc) != false) ? header("Location:read.php?id=".$id) : header("Location:show.php");
        }
        public function delete($id){
            return($this->MODEL->delete($id)) ? header("Location:show.php") : header("Location:read.php?id=".$id);
        }
        //---------SOPORTE---------//
        public function contacto($nombre, $problema, $comentario, $telefono){
            $id = $this->MODEL->reporte($nombre, $problema, $comentario, $telefono);
            return($id!=false) ? header("Location:show.php?id=".$id) : false;
        }
        public function showsupport(){
            return ($this->MODEL->showsupport()) ? $this->MODEL->showsupport() : false;
        }
        public function readsupport($id){
            return ($this->MODEL->readsupport($id) != false) ? $this->MODEL->readsupport($id) : header("Location:show_p.php");
        }
        public function updatesupport($id, $nombre, $problema, $comentario, $telefono){
            return($this->MODEL->updatesupport($id, $nombre, $problema, $comentario, $telefono) != false) ? header("Location:read.php?id=".$id) : header("Location:show_p.php");
        }
        public function deletesupport($id){
            return($this->MODEL->deletesupport($id)) ? header("Location:show_p.php") : header("Location:read.php?id=".$id);
        }
        //---------SERVICIOS---------//
        public function servicio($origen,$destino,$hora,$fecha,$tipo,$cantidad){
            $id = $this->MODEL->mudanza($origen,$destino,$hora,$fecha,$tipo,$cantidad);
            return($id!=false) ? header("Location:show_s.php?id=".$id) : false;
        }
        public function showservice(){
            return ($this->MODEL->showservice()) ? $this->MODEL->showservice() : false;
        }
        public function readservice($id){
            return ($this->MODEL->readservice($id) != false) ? $this->MODEL->readservice($id) : header("Location:show.php");
        }
        public function updateservice($id, $origen,$destino,$hora,$fecha,$tipo,$cantidad){
            return($this->MODEL->updateservice($id, $origen,$destino,$hora,$fecha,$tipo,$cantidad) != false) ? header("Location:read.php?id=".$id) : header("Location:show.php");
        }
        public function deleteservice($id){
            return($this->MODEL->deleteservice($id)) ? header("Location:show.php") : header("Location:read.php?id=".$id);
        }
    }
?>