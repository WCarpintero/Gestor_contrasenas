<?php
date_default_timezone_set('America/Bogota');
require_once('config.php');
class db{
    private static $conn; 
    private function getConnection(){
        if(self::$conn == null){
            try{
                self::$conn = new PDO(connstring, user, pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("ERROR DE CONEXIÓN ". $e->getMessage());
            }
        }
        return self::$conn;
    }

    /* Funciones para las transacciones */
    function beginTransaction(){
        return $this->getConnection()->beginTransaction();
    }

    function commit(){
        return $this->getConnection()->commit();
    }

    function rollBack(){
        return $this->getConnection()->rollBack();
    }

    function query($sql, $params = null)
    {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            $sw = true;
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
            // $sw=json_encode(array("mensaje" => $ex->getMessage()));
            $sw = false;
        }
        return $sw;
    }

    /*Devuelve una fila*/
    function row($sql, $params = null)
    {
        $row = '';
        try {

            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
        return $row;
    }

    /*Devuelve una tabla*/
    function table($sql, $params = null)
    {
        $data = array();

        try {

            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
            }
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
        return $data;
    }

    /*Devolver el ultimo id insertado */
    public function lastId(){
        return $this->getConnection()->lastInsertId();
    }
}