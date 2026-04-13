<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
header('Content-Type: application/json');
require_once('../models/Usuarios.php');
$usu = new Usuarios();
$action = $_GET['case'] ?? $_POST['case'] ?? '';
switch ($action){
    case 'registrar':
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellido'];
        $correo = $_POST['correo'];
        $tel = $_POST['telefono'];
        $pass = $_POST['confirm_key'];

        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        $res = $usu->registrarUsuario($nombre, $apellidos, $correo, $tel, $pass_hash);

        if($res){
            echo json_encode([
                "success" => true,
                "mensaje" => "Usuario registrado correctamente"
            ]);
        }else{
            echo json_encode([
                "success" => false,
                "mensaje" => "Error al registrar usuario"
            ]);
        }
        break; 
    default:
        echo json_encode([
            "success"=>false,
            "mensaje" => "Acción no reconocida, has caído en el deafault"
        ]);
    break; 
}