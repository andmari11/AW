<?php

class Usuario
{

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return self::cargaRoles($usuario);
        }
        return false;
    }
    
    public static function crea($nombreUsuario, $password, $nombre, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre);
        $user->añadeRol($rol);
        return $user->guarda();
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRoles($usuario)
    {
        $roles=[];
            
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d", $usuario->id);
        $rs = $conn->query($query);
        if ($rs) {
            $roles = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();

            $usuario->roles = [];
            foreach($roles as $rol) {
                $usuario->roles[] = $rol['rol'];
            }
            return $usuario;

        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
   
    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password) VALUES ('%s', '%s', '%s')",
            $conn->real_escape_string($usuario->nombreUsuario),
            $conn->real_escape_string($usuario->nombre),
            $conn->real_escape_string($usuario->password)
        );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            foreach($usuario->roles as $rol) {
                $query2 = sprintf("INSERT INTO RolesUsuario(usuario, rol) VALUES (%d, %d)",
                    $usuario->id,
                    $rol
                );
                $conn->query($query2);
            }        
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    

    private $id;

    private $nombreUsuario;

    private $password;

    private $nombre;

    private $roles;

    private function __construct($nombreUsuario, $password, $nombre, $id = null, $roles = [])
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->roles = $roles;
    }


    public function añadeRol($role)
    {
        $this->roles[] = $role;
    }


    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }


}
