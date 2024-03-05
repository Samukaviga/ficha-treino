<?php

function alerta($mensagem) {
    echo "<script>alert('$mensagem');</script>";
}

function buscandoAluno($pdo, $email) {
      
    $sql = "SELECT aluno.id, aluno.email, aluno.nome, aluno.data_nascimento, saude_medicamento, aluno.senha, aluno.id_professor, aluno.objetivo, aluno.data_inicio, aluno.data_troca, professor.nome as 'professor' FROM aluno INNER JOIN professor ON professor.id = aluno.id_professor WHERE aluno.email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(); 
    return $result;
}

function cadastrandoAluno($pdo, $nome, $email, $objetivo, $id_professor, $senha, $data_nascimento, $saude_medicamento){

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO aluno (nome, email, objetivo, id_professor, senha, data_nascimento, saude_medicamento) 
                VALUES (:nome, :email, :objetivo, :id_professor, :senha, :data_nascimento, :saude_medicamento)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
    $stmt->bindParam(':saude_medicamento', $saude_medicamento, PDO::PARAM_STR);
    $stmt->bindParam(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
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

function listagemTreino($pdo, $tipo, $id){
    $sql = "SELECT exercicio.agrupamento, exercicio.nome, treino.id, treino.serie, treino.tipo, treino.concluido 
    FROM treino 
    INNER JOIN exercicio ON exercicio.id = treino.id_exercicio 
    WHERE tipo LIKE CONCAT('%', :tipo, '%') AND treino.id_aluno = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function buscandoTreino($pdo, $id){
    $sql = "SELECT serie, concluido, obs FROM treino WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function alterarSenha($pdo, $senhaNova, $senhaAntiga, $id){


    $sql = "SELECT senha FROM aluno WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $sql_senha = $stmt->fetch(); 

            if(password_verify($senhaAntiga, $sql_senha['senha'])){

                $senhaCriptografada = password_hash($senhaNova, PASSWORD_DEFAULT);

                $sql = "UPDATE aluno SET senha = :senha WHERE id = :id";
                
                if($stmt = $pdo->prepare($sql)){
                    $stmt->bindParam(":senha", $senhaCriptografada, PDO::PARAM_STR);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    $stmt->execute();

                    if($stmt->rowCount()){
                       return true;
                    } 
                
                } else {
                    return false;
                }
            }

        } else {
            return false;
        }
}

function editandoAluno($pdo, $nome, $data_nascimento, $saude_medicamento, $id){


    $sql = "UPDATE aluno SET data_nascimento = :data_nascimento, saude_medicamento = :saude_medicamento, nome = :nome WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
    $stmt->bindParam(':saude_medicamento', $saude_medicamento, PDO::PARAM_STR);
    
    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}