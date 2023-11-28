<?php
    class homeController{
        private $MODEL;
        public function __construct()
        {
            require_once('../../model/homeModel.php');
            $this->MODEL = new homeModel();
        }
        //---------------------------REGISTRO---------------------------------//
        public function guardarUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado, $intentos, $ultimo_intento, $recuperacion_token, $recuperacion_expiracion) {
            $valor = $this->MODEL->agregarNuevoUsuario($nombre, $apellidos, $this->limpiarcorreo($email), $telefono, $ciudad, $this->encriptarcontraseña($this->limpiarcadena($contraseña)), $fecha, $cc, $tipo, $token, $verificado, $intentos, $ultimo_intento, $recuperacion_token, $recuperacion_expiracion);
            return $valor;
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

        //---------------------------VERIFICAR-REGISTRO---------------------------------//
        public function verificarToken(): bool {
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $result = $this->MODEL->validarToken($token);
        
                return $result;
            } else {
                return false;
            }
        }

        //---------------------------INICIO DE SESION---------------------------------//
        public function verificarusuario($email,$contraseña){
            $keydb = $this->MODEL->obtenerclave($email);
            return (password_verify($contraseña, $keydb)) ? $keydb : false;
        }

        public function validarVerificacion($email){
            $result = $this->MODEL->leerVerificacion($email);
            return $result;
        }

        public function RecogerTipo($email){
            $result = $this->MODEL->leerTipo($email);
            return $result;
        }

        //-----------------------------BLOQUEO---------------------------------//

        public function actualizarIntentos($email, $intentos, $ultimoIntento) {
            return $this->MODEL->actualizarIntentos($email, $intentos, $ultimoIntento);
        }

        public function obtenerDatosIntentos($email) {
            return $this->MODEL->obtenerDatosIntentos($email);
        }


        //------------------------------RECUPERACION-TOKEN------------------------------//

        public function generarTokenRecuperacion($email){
            return $this->MODEL->generarTokenRecuperacion($email);
        }

        public function VerificarTokenRecuperacion($token){
            return $this->MODEL->VerificarTokenRecuperacion($token);
        }

        public function obtenerEmailPorTokenRecuperacion($token) {
            $statement = $this->MODEL->obtenerEmailPorTokenRecuperacion($token);
            return $statement;
        }

        //------------------------------RECUPERACION-CONTRASEÑA------------------------------//

        public function actualizarContraseñaYTokenRecuperacion($email, $contraseña) {
            $this->MODEL->actualizarContraseñaYTokenRecuperacion($email, $contraseña);
        }

        //-----------------------------------------------------------------//

    }
?>