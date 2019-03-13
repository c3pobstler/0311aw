<?php

class Application{
    private $host;
    private $bd;
    private $user;
    private $pass;
    private static $instance=null;

    public function init($BDData) {
        $this->host=$BDData['host'];
        $this->bd=$BDData['bd'];
        $this->user=$BDData['user'];
        $this->pass=$BDData['pass'];
        $this->conn=null;
    }

    public function connectBD() {
        if(is_null($this->conn)) {
            $conn= new \mysqli($this->host,$this->user,$this->pass, $this->bd);
            if ( $conn->connect_errno ) {
                echo "Error de conexión a la BD: (" . $conn->connect_errno . ") " . utf8_encode($conn->connect_error);
                exit();
        }
            if ( ! $conn->set_charset("utf8mb4")) {
                echo "Error al configurar la codificación de la BD: (" . $conn->errno . ") " . utf8_encode($tconn->error);
                exit();
            }
            $this->conn=$conn;
        }
        
        return $this->conn;
    }

    public static function getInstance() {
        if(self::$instance==null) {
            self::$instance=new Application();
        }
        return self::$instance;
    }
}

?>