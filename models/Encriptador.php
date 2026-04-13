<?php
class Encriptador 
{
    private $method = 'aes-256-cbc';
    private $key;

    // Recibe la clave del usuario
    public function __construct($claveUsuario) {
        // Genera clave segura de 256 bits
        $this->key = hash('sha256', $claveUsuario);
    }

    public function encriptar($texto) {

        $iv_length = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $cipherText = openssl_encrypt(
            $texto, 
            $this->method, 
            $this->key, 
            0, 
            $iv
        );

        return base64_encode($iv . $cipherText);
    }

    public function desencriptar($data_encriptada) {

        $data = base64_decode($data_encriptada);

        $iv_length = openssl_cipher_iv_length($this->method);

        $iv = substr($data, 0, $iv_length);
        $cipherText = substr($data, $iv_length);

        return openssl_decrypt(
            $cipherText, 
            $this->method, 
            $this->key, 
            0, 
            $iv
        );
    }
}