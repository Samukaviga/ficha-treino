<?php
    
    include_once("../../../conexao.php");
    
    
    $id = $_GET['id'];
   

    // Aqui você pode usar o seu código para atualizar o banco de dados com os valores recebidos

    // Exemplo de conexão PDO

    // Atualizar o banco de dados
    $sql = "UPDATE treino SET concluido = 2 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    
    $stmt->execute();

    // Responder com uma mensagem de sucesso
    
?>