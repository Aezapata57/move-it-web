<?php
    class homeModel{
        private $PDO;
        public function __construct()
        {
            require_once('../../config/db.php');
            $pdo = new db();
            $this->PDO = $pdo->conexion();
        } 
        public function agregarNuevoUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado){
            $statement = $this->PDO->prepare("INSERT INTO datas VALUES(null, :NAMES, :SURNAMES, :EMAIL, :PHONE, :CITY, :PASSWORD, :DATE, :CC, :TYPE, :TOKEN, :VERIFICADO)");
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
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }   
        
        // ...

        public function verificarRegistroEmail($email) {

            // Consulta para verificar si el correo, cédula o número telefónico ya está registrado
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

            // Consulta para verificar si el correo, cédula o número telefónico ya está registrado
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

            // Consulta para verificar si el correo, cédula o número telefónico ya está registrado
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

        
        public function validarToken($token) {
            $statement = $this->PDO->prepare("UPDATE datas SET VERIFICADO = 1 WHERE TOKEN = :TOKEN");
            $statement->bindParam(':TOKEN', $token, PDO::PARAM_STR);
            try {
                $statement->execute();
                return $statement->rowCount() > 0;
            } catch (PDOException $e) {
                return false;
            }
        }
        
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

        public function guardarLockoutTime($email, $lockout_time) {
            $statement = $this->PDO->prepare("UPDATE datas SET lockout_time = :LOCKOUT_TIME WHERE EMAIL = :EMAIL");
            $statement->bindParam(":LOCKOUT_TIME", $lockout_time);
            $statement->bindParam(":EMAIL", $email);
        
            try {
                $statement->execute();
                $_SESSION['lockout_time_db'] = $lockout_time;
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }        

        public function reporte($nombre, $problema, $comentario, $telefono){
            $statement = $this->PDO->prepare("INSERT INTO contacts VALUES(null, :NAMES, :PROBLEM, :COMENT, :PHONE)");
            $statement->bindParam(":NAMES",$nombre);
            $statement->bindParam(":PROBLEM",$problema);
            $statement->bindParam(":COMENT",$comentario);
            $statement->bindParam(":PHONE",$telefono);
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        public function show(){
            $stament = $this->PDO->prepare("SELECT * FROM datas");
            return ($stament->execute()) ? $stament->fetchAll() : false ;
        }
        public function read($id){
            $stament = $this->PDO->prepare("SELECT * FROM datas WHERE ID = :ID limit 1");
            $stament->bindParam(":ID", $id);
            return ($stament->execute()) ? $stament->fetch() : false ;
        }
        public function update($id, $nombre, $apellidos, $email, $telefono, $ciudad, $fecha, $cc){
            $stament = $this->PDO->prepare("UPDATE datas SET NAMES = :NAMES, SURNAMES = :SURNAMES, EMAIL = :EMAIL, PHONE = :PHONE, CITY = :CITY, DATE = :DATE, CC = :CC WHERE ID = :ID");
            $stament->bindParam(":NAMES",$nombre);
            $stament->bindParam(":SURNAMES",$apellidos);
            $stament->bindParam(":EMAIL",$email);
            $stament->bindParam(":PHONE",$telefono);
            $stament->bindParam(":CITY",$ciudad);
            $stament->bindParam(":DATE",$fecha);
            $stament->bindParam(":CC",$cc);
            $stament->bindParam(":ID",$id);
            return ($stament->execute()) ? $id : false;
        }
        public function delete($id){
            $stament = $this->PDO->prepare("DELETE FROM datas WHERE ID = :ID");
            $stament->bindParam(":ID",$id);
            return ($stament->execute()) ? true : false;
        }
        public function showsupport(){
            $stament = $this->PDO->prepare("SELECT * FROM contacts");
            return ($stament->execute()) ? $stament->fetchAll() : false ;
        }
        public function readsupport($id){
            $stament = $this->PDO->prepare("SELECT * FROM contacts WHERE ID = :ID limit 1");
            $stament->bindParam(":ID", $id);
            return ($stament->execute()) ? $stament->fetch() : false ;
        }
        public function updatesupport($id, $nombre, $problema, $comentario, $telefono){
            $stament = $this->PDO->prepare("UPDATE contacts SET NAMES = :NAMES, PROBLEM = :PROBLEM, COMENT = :COMENT, PHONE = :PHONE WHERE ID = :ID");
            $stament->bindParam(":NAMES",$nombre);
            $stament->bindParam(":PROBLEM",$problema);
            $stament->bindParam(":COMENT",$comentario);
            $stament->bindParam(":PHONE",$telefono);
            $stament->bindParam(":ID",$id);
            return ($stament->execute()) ? $id : false;
        }
        public function deletesupport($id){
            $stament = $this->PDO->prepare("DELETE FROM contacts WHERE ID = :ID");
            $stament->bindParam(":ID",$id);
            return ($stament->execute()) ? true : false;
        }
        public function mudanza($origen,$destino,$hora,$fecha,$tipo,$cantidad){
            $statement = $this->PDO->prepare("INSERT INTO service VALUES(null, :ORIGEN, :DESTINO, :HORA, :FECHA, :TIPO, :CANTIDAD)");
            $statement->bindParam(":ORIGEN",$origen);
            $statement->bindParam(":DESTINO",$destino);
            $statement->bindParam(":HORA",$hora);
            $statement->bindParam(":FECHA",$fecha);
            $statement->bindParam(":TIPO",$tipo);
            $statement->bindParam(":CANTIDAD",$cantidad);
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        public function showservice(){
            $stament = $this->PDO->prepare("SELECT * FROM service");
            return ($stament->execute()) ? $stament->fetchAll() : false ;
        }
        public function readservice($id){
            $stament = $this->PDO->prepare("SELECT * FROM service WHERE ID = :ID limit 1");
            $stament->bindParam(":ID", $id);
            return ($stament->execute()) ? $stament->fetch() : false ;
        }
        public function updateservice($id, $origen,$destino,$hora,$fecha,$tipo,$cantidad){
            $stament = $this->PDO->prepare("UPDATE service SET ORIGEN = :ORIGEN, DESTINO = :DESTINO, HORA = :HORA, FECHA = :FECHA, TIPO = :TIPO, CANTIDAD = :CANTIDAD WHERE ID = :ID");
            $stament->bindParam(":ORIGEN",$origen);
            $stament->bindParam(":DESTINO",$destino);
            $stament->bindParam(":HORA",$hora);
            $stament->bindParam(":FECHA",$fecha);
            $stament->bindParam(":TIPO",$tipo);
            $stament->bindParam(":CANTIDAD",$cantidad);
            $stament->bindParam(":ID",$id);
            return ($stament->execute()) ? $id : false;
        }
        public function deleteservice($id){
            $stament = $this->PDO->prepare("DELETE FROM service WHERE ID = :ID");
            $stament->bindParam(":ID",$id);
            return ($stament->execute()) ? true : false;
        }
    }

?>