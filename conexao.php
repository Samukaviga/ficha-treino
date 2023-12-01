<?php
    /*
    require "vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load(); */

    $servidor = 'localhost';
    $usuario = 'id21606598_samuel';
    $senha = 'newYORK!23'; 
    $banco = 'id21606598_academia';


    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão estabelecida com sucesso!";
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage(); 
    }
    
?>