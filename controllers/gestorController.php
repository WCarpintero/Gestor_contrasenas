<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

require_once('../models/Gestor.php');
require_once('../models/Encriptador.php');

$gestor = new Gestor();

$action = $_GET['case'] ?? $_POST['case'] ?? '';

// PROTEGER SESIÓN
if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['master_key'])) {
    echo json_encode([
        "success" => false,
        "mensaje" => "Sesión no válida"
    ]);
    exit;
}

// CREAR ENCRIPTADOR CON CLAVE DINÁMICA
$encriptador = new Encriptador($_SESSION['master_key']);

switch ($action) {

    case 'listarCategorias':

        $data = $gestor->listarCategorias();

        echo json_encode([
            "success" => $data !== false,
            "data" => $data ?? [],
            "mensaje" => $data ? "Categorías listadas" : "Error al listar"
        ]);

    break;


    case 'guardarCredenciales':

        $sitio = trim($_POST['sitio'] ?? '');
        $idCategoria = $_POST['categoria'] ?? '';
        $usuario = trim($_POST['usuario'] ?? '');
        $pass = trim($_POST['password'] ?? '');
        $notas = trim($_POST['notas'] ?? '');

        if (empty($sitio) || empty($usuario) || empty($pass)) {
            echo json_encode([
                "success" => false,
                "mensaje" => "Campos obligatorios"
            ]);
            exit;
        }

        $idUsuario = $_SESSION['id_usuario'];

        // ENCRIPTAR
        $passEncript = $encriptador->encriptar($pass);

        // GUARDAR
        $res = $gestor->guardarCredenciales(
            $sitio,
            $usuario,
            $idCategoria,
            $passEncript,
            $notas,
            $idUsuario
        );

        echo json_encode([
            "success" => $res ? true : false,
            "mensaje" => $res ? "Guardado correctamente" : "Error al guardar"
        ]);

    break;


    case 'listarCredenciales':

        $idUsuario = $_SESSION['id_usuario'];

        $data = $gestor->listarCredenciales($idUsuario);

        // DESENCRIPTAR
        foreach ($data as &$row) {
            $row['contrasena'] = $encriptador->desencriptar($row['contrasena']);
        }

        echo json_encode([
            "success" => true,
            "data" => $data
        ]);

    break;


    default:
        echo json_encode([
            "success" => false,
            "mensaje" => "Acción no reconocida"
        ]);
    break;
}