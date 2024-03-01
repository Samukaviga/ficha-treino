<?php

    
    include_once("../../conexao.php");

    $id = $_GET['id'];
    $tipo = $_GET['tipo'];
    
    $sql = "UPDATE treino
    SET concluido = 2
    WHERE tipo = :tipo and id_aluno = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->execute();

   // Responder com uma mensagem de sucesso
    header("Location: ../");
    exit;
