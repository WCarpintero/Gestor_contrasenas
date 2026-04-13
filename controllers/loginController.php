<?php
session_start();
header('Content-Type: application/json');
require_once('../models/Login.php');
$log = new Login();
$action = $_GET['case'] ?? $_POST['case'] ?? '';
switch ($action) {
    case 'iniciarSesion':
        $usuario = $_POST['correo'] ?? '';
        $password = $_POST['password'];

        $iniciar = $log->iniciarSesion($usuario);

        if ($iniciar) {
            if (password_verify($password, $iniciar['password_hash'])) {

                session_regenerate_id(true);

                $_SESSION['id_usuario'] = $iniciar['id_usuario'];
                $_SESSION['nombre_usuario'] = $iniciar['nombre_usuario'];
                $_SESSION['correo_usuario'] = $iniciar['correo'];

                //CLAVE DINÁMICA
                $_SESSION['master_key'] = $password;
                echo json_encode([
                    "success" => true
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "mensaje" => "Credenciales incorrecta"
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "mensaje" => "Credenciales incorrecta"
            ]);
        }

        break;
    default:
        echo json_encode([
            "success" => false,
            "mensaje" => "Acción no reconocida, has caído en el deafault"
        ]);
        break;
}
