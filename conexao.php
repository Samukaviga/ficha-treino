<?php
    /*
    require "vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load(); */

    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'academia';


    try {
        $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão estabelecida com sucesso!";
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage(); 
    }
    
?>