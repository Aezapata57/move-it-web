<?php
    class homeModel{
        private $PDO;
        public function __construct()
        {
            require_once('../../config/db.php');
            $pdo = new db();
            $this->PDO = $pdo->conexion();
        }
        
        //---------------------------REGISTRO---------------------------------//
        public function agregarNuevoUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado, $intentos, $ultimo_intento, $recuperacion_token, $recuperacion_expiracion){
            $statement = $this->PDO->prepare("INSERT INTO datas VALUES(null, :NAMES, :SURNAMES, :EMAIL, :PHONE, :CITY, :PASSWORD, :DATE, :CC, :TYPE, :TOKEN, :VERIFICADO, :INTENTOS, :ULTIMO_INTENTO, :RECUPERACION_TOKEN, :RECUPERACION_EXPIRACION)");
            $statement->bindParam(":NAMES",$nombre);
            $statement->bindParam(":SURNAMES",$apellidos);
            $statement->bindParam(":EMAIL",$email);
            $statement->bindParam(":PHONE",$telefono);
            $statement->bindParam(":CITY",$ciudad);
            $statement->bindParam(":PASSWORD",$contraseña);
            $statement->bindParam(":DATE",$fecha);
            $statement->bindParam(":CC",$cc);
            $statement->bindParam(":TYPE",$tipo);
            $statement->bindParam(":TOKEN",$token);
            $statement->bindParam(":VERIFICADO",$verificado);
            $statement->bindParam(":INTENTOS",$intentos);
            $statement->bindParam(":ULTIMO_INTENTO",$ultimo_intento);
            $statement->bindParam(":RECUPERACION_TOKEN",$recuperacion_token);
            $statement->bindParam(":RECUPERACION_EXPIRACION",$recuperacion_expiracion);
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }   

        public function verificarRegistroEmail($email) {
            $statement = $this->PDO->prepare("SELECT * FROM datas WHERE EMAIL = :EMAIL;");
            $statement->bindParam(":EMAIL",$email);

            try {
                $statement->execute();
                $result = $statement->fetchAll();

                return count($result) > 0;
            } catch (PDOException $e) {
                return false;
            }
        }
        public function verificarRegistroCC($cc) {
            $statement = $this->PDO->prepare("SELECT * FROM datas WHERE CC = :CC;");
            $statement->bindParam(":CC",$cc);

            try {
                $statement->execute();
                $result = $statement->fetchAll();

                return count($result) > 0;
            } catch (PDOException $e) {
                return false;
            }
        }
        public function verificarRegistroTelefono($telefono) {
            $statement = $this->PDO->prepare("SELECT * FROM datas WHERE PHONE = :PHONE;");
            $statement->bindParam(":PHONE",$telefono);

            try {
                $statement->execute();
                $result = $statement->fetchAll();

                return count($result) > 0;
            } catch (PDOException $e) {
                return false;
            }
        }

        //---------------------------VERIFICAR-REGISTRO---------------------------------//
        public function validarToken($token) {
            $statement = $this->PDO->prepare("UPDATE datas SET VERIFICADO = 1, INTENTOS = 0 WHERE TOKEN = :TOKEN");
            $statement->bindParam(':TOKEN', $token, PDO::PARAM_STR);
            try {
                $statement->execute();
                return $statement->rowCount() > 0;
            } catch (PDOException $e) {
                return false;
            }
        }        
       
        //---------------------------INICIO DE SESION---------------------------------//
        public function obtenerclave($email){
            $statement = $this->PDO->prepare("SELECT PASSWORD FROM datas WHERE :EMAIL = EMAIL");
            $statement->bindParam(":EMAIL",$email);
            return ($statement->execute()) ? $statement->fetch()["PASSWORD"] : false;
        }

        public function leerVerificacion($email){
            $statement = $this->PDO->prepare("SELECT * FROM datas WHERE EMAIL = :EMAIL AND VERIFICADO = 1;");
            $statement->bindParam(":EMAIL",$email);

            try {
                $statement->execute();
                $result = $statement->fetchAll();

                return count($result) > 0;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function leerTipo($email){
            $statement = $this->PDO->prepare("SELECT TYPE FROM datas WHERE EMAIL = :EMAIL;");
            $statement->bindParam(":EMAIL",$email);
            $statement->execute();
            return $statement->fetch()["TYPE"];
        }

        //---------------------------BLOQUEO---------------------------------//

        public function actualizarIntentos($email, $intentos, $ultimoIntento) {
            $statement = $this->PDO->prepare("UPDATE datas SET INTENTOS = :INTENTOS, ULTIMO_INTENTO = :ULTIMO_INTENTO WHERE EMAIL = :EMAIL");
            $statement->bindParam(":INTENTOS", $intentos, PDO::PARAM_INT);
            $statement->bindParam(":ULTIMO_INTENTO", $ultimoIntento);
            $statement->bindParam(":EMAIL", $email);
            return $statement->execute();
        }

        public function obtenerDatosIntentos($email) {
            $statement = $this->PDO->prepare("SELECT INTENTOS, ULTIMO_INTENTO FROM datas WHERE EMAIL = :EMAIL");
            $statement->bindParam(":EMAIL", $email);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

 
        //------------------------------RECUPERACION-TOKEN------------------------------//

        public function generarTokenRecuperacion($email) {
            $token = bin2hex(random_bytes(16));
        
            $currentDateTime = new DateTime("now", new DateTimeZone('America/Bogota'));
            $expiracionDateTime = $currentDateTime->modify('+24 hours');
        
            $expiracion = $expiracionDateTime->format("Y-m-d H:i:s");
        
            $statement = $this->PDO->prepare("UPDATE datas SET RECUPERACION_TOKEN = :TOKEN, RECUPERACION_EXPIRACION = :EXPIRACION WHERE EMAIL = :EMAIL");
            $statement->bindParam(":TOKEN", $token);
            $statement->bindParam(":EXPIRACION", $expiracion);
            $statement->bindParam(":EMAIL", $email);
            $statement->execute();
        
            return $token;
        }
                
        public function verificarTokenRecuperacion($token) {
            $statement = $this->PDO->prepare("SELECT * FROM datas WHERE RECUPERACION_TOKEN = :TOKEN AND RECUPERACION_EXPIRACION > NOW()");
            $statement->bindParam(":TOKEN", $token);
            $statement->execute();
        
            return $statement->rowCount() > 0;
        }
        
        public function obtenerEmailPorTokenRecuperacion($token) {
            $statement = $this->PDO->prepare("SELECT EMAIL FROM datas WHERE RECUPERACION_TOKEN = :TOKEN AND RECUPERACION_EXPIRACION > NOW()");
            $statement->bindParam(":TOKEN", $token);
            $statement->execute();
        
            return $statement->fetch(PDO::FETCH_COLUMN);
        }

        //------------------------------RECUPERACION-CONTRASEÑA------------------------------//
        
        public function actualizarContraseñaYTokenRecuperacion($email, $nuevaContraseña) {
            $contraseñasAnteriores = $this->obtenerUltimasContraseñas($email, 5);
        
            foreach ($contraseñasAnteriores as $contraseñaAnterior) {
                if (password_verify($nuevaContraseña, $contraseñaAnterior)) {
                    $error = "<li>La contraseña nueva no puede ser una de las últimas 5 contraseñas que has utilizado.</li>";
                    header("Location: ../user/reset_password.php?token=" . $_POST["token"] . "&error=" . $error);
                    exit();
                }
            }

            $hashNewPassword = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
            $this->guardarContraseñaAnterior($email, $hashNewPassword);
        
            $statement = $this->PDO->prepare("UPDATE datas SET PASSWORD = :PASSWORD, RECUPERACION_TOKEN = NULL, RECUPERACION_EXPIRACION = NULL WHERE EMAIL = :EMAIL");
            $statement->bindParam(":PASSWORD", $hashNewPassword);
            $statement->bindParam(":EMAIL", $email);
            $statement->execute();
        }        
        
        public function obtenerUltimasContraseñas($email, $cantidad = 5) {
            $statement = $this->PDO->prepare("SELECT PASSWORD FROM contraseñas_anteriores WHERE EMAIL = :EMAIL ORDER BY FECHA DESC LIMIT :CANTIDAD");
            $statement->bindParam(":EMAIL", $email);
            $statement->bindParam(":CANTIDAD", $cantidad, PDO::PARAM_INT);
            $statement->execute();
        
            $contraseñasAnteriores = [];
            foreach ($statement->fetchAll(PDO::FETCH_COLUMN) as $contraseñaAnterior) {
                $contraseñasAnteriores[] = $contraseñaAnterior;
            }
        
            return $contraseñasAnteriores;
        }

        public function guardarContraseñaAnterior($email, $hashContraseña) {
            $statement = $this->PDO->prepare("INSERT INTO contraseñas_anteriores VALUES (:EMAIL, :PASSWORD, NOW())");
            $statement->bindParam(":EMAIL", $email);
            $statement->bindParam(":PASSWORD", $hashContraseña);
            $statement->execute();
        }

        //---------------------------------------------------------------------------//

    }

?>