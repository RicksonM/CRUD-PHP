<?php

class Conexao {
    private $usuario;
    private $senha;
    private $bd;
    private $server;
    private static $pdo;

    public function __construct() {
        $this->server = "localhost";
        $this->bd = "verdanatech";
        $this->usuario = "root";
        $this->senha = "";
    }
    
    //$dsn = 'mysql:dbname=demo;host=server;port=3306;charset=utf8';
    //$connection = new \PDO($dsn, $username, $password);
    
    public function conectar() {
        try{
            if(is_null(self::$pdo)){
                self::$pdo = new PDO("mysql:dbname=verdanatech;host=localhost;port=3306;charset=utf8;","root","");
                
            }
            return self::$pdo;


        } catch(PDOException $ex) {

        }
    }
}

?>