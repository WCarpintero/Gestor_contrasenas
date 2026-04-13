<?php
require_once('../config/PDOconn.php');
class Usuarios extends db{
    function registrarUsuario($nombre, $apellidos, $correo, $tel, $pass){
        try{
            $insert = "INSERT INTO usuario(nombre, apellidos, correo, telefono, password_hash)
                        VALUES(:nombre, :apellidos, :correo, :telefono, :pass);"; 
            $params = [
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':correo' => $correo,
                ':telefono' => $tel,
                ':pass' => $pass
            ];

            return $this->query($insert, $params);
            
        }catch(Exception $e){
            var_dump($e);
            return false; 
        }
    }

    
}