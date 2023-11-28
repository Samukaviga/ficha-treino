<?php

function alerta($mensagem) {
    echo "<script>alert('$mensagem');</script>";
}

function buscandoAluno($pdo, $email) {
      
    $sql = "SELECT aluno.id, aluno.email, aluno.nome, aluno.senha, aluno.id_professor, aluno.objetivo, aluno.data_inicio, aluno.data_troca, professor.nome as 'professor' FROM aluno INNER JOIN professor ON professor.id = aluno.id_professor WHERE aluno.email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(); 
    return $result;
}

function cadastrandoAluno($pdo, $nome, $email, $objetivo, $id_professor, $senha){

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO aluno (nome, email, objetivo, id_professor, senha) 
                VALUES (:nome, :email, :objetivo, :id_professor, :senha)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
    $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
    
    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}