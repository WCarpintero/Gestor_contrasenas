<?php
require_once('../config/PDOconn.php');
class Login extends db{
    function iniciarSesion($correo){
        try{
            $sql = "SELECT u.id_usuario,
                            CONCAT(u.nombre, ' ', u.apellidos) AS nombre_usuario,
                            u.correo,
                            u.telefono,
                            u.password_hash 
                    FROM usuario u 
                    WHERE u.correo = :correo"; 
            $params = [
                ':correo' => $correo
            ];

            return $this->row($sql, $params);
            
        }catch(Exception $e){
            var_dump($e);
            return false; 
        }
    }
}