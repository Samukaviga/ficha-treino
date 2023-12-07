<?php
    /*
    require "vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load(); */

    $servidor = '127.0.0.1:3306';
    $usuario = 'u348518502_samuel';
    $senha = '8Gfz&[UU?I~$'; 
    $banco = 'u348518502_database';


    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão estabelecida com sucesso!";
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage(); 
    }
    
?>