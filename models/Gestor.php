<?php
require_once('../config/PDOconn.php');
class Gestor extends db
{
    function guardarCredenciales($sitio, $user, $idCategoria, $pass, $notas)
    {
        try {
            $insert = "INSERT INTO contrasenas(sitio, usuario_sitio, categoria_sitio_fk, contrasena, notas)
                        VALUES(:sitio, :user, :categoria, :pass, :notas);";
            $params = [
                ':sitio' => $sitio,
                ':user' => $user,
                ':categoria'=> $idCategoria,
                ':pass' => $pass,
                ':notas' => $notas
            ];

            return $this->query($insert, $params);

        } catch (Exception $e) {
            return false;
        }
    }

    function listarCategorias()
    {
        try {
            $sql = "SELECT * 
                    FROM categoria_sitio";

            return $this->table($sql);

        } catch (Exception $e) {
            return false;
        }
    }

    function listarCredenciales($idUsuario){
    $sql = "SELECT c.*, cat.categoria 
            FROM contrasenas c
            INNER JOIN categoria_sitio cat 
            ON c.categoria_sitio_fk = cat.id_categoria
            WHERE c.id_usuario = :id";

    return $this->table($sql, [':id'=>$idUsuario]);
}
}