<?php 

class User {

    private function __construct($username,$name,$password,$role) {
        $this->username=$username;
        $this->name=$name;
        $this->password=$password;
        $this->role=$role;
    }

    public static function searchUser($username) {
        require_once __DIR__.'/Aplicacion.php';
        $conn =Aplicacion::getSingleton()->conexionBd();
	
	    $query=sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($username));
        $rs = $conn->query($query);
        if($rs->num_rows==0) {
            return null;
        }
        else {
            $fila=$rs->fetch_assoc();
            return new User($fila['nombreUsuario'],$fila['nombre'],$fila['password'],$fila['rol']);
        }
    }

    public function checkPassword($password) {
        return password_verify($password,$this->password);
    }

    public static function login($username,$password) {
        $user=User::searchUser($username);
        if($user!=null &&  $user->checkPassword($password)) {
            $_SESSION['login'] = true;
            $_SESSION['nombre'] = $nombreUsuario;
            $_SESSION['esAdmin'] = strcmp($fila['rol'], 'admin') == 0 ? true : false;
            header('Location: index.php');
           return $user;
        }
        else return false;
       
    }

    public static function create($username,$name,$password,$role) {
        require_once(__DIR__."/Aplicacion.php");
        $conn=Aplicacion::getSingleton()->conexionBD();
        $query=sprintf("INSERT INTO usuarios(nombreUsuario, nombre, password, rol) VALUES('%s', '%s', '%s', '%s')"
					, $conn->real_escape_string($username)
					, $conn->real_escape_string($name)
					, password_hash($password, PASSWORD_DEFAULT)
                    , 'user');
        if ( $conn->query($query) ) {
            $_SESSION['login'] = true;
            $_SESSION['nombre'] = $nombreUsuario;
            header('Location: index.php');
            return true;
        }
        else {
            return false;
        }
    }
}