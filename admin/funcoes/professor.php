<?php 


function buscandoProfessor($pdo, $email) {
    $sql = "SELECT id, email, nome, senha, admin FROM professor WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(); 
    return $result;
}

function cadastrandoProfessor($pdo, $nome, $email, $senha) {
    
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO professor (nome, email, senha) 
                VALUES (:nome, :email, :senha)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
    
    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}

function listaAlunos($pdo, $nome){
   
    if($nome != ''){
        $sql = "SELECT id, nome FROM aluno WHERE nome LIKE CONCAT('%', :nome, '%')";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;

    } else {
        $sql = "SELECT id, nome FROM aluno";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

}

function alerta($mensagem) {
    echo "<script>alert('$mensagem');</script>";
}


function buscandoDadosAluno($pdo, $id) {
      
    $sql = "SELECT aluno.id, aluno.email, aluno.nome, aluno.senha, aluno.id_professor, aluno.objetivo, aluno.data_inicio, aluno.data_troca, professor.nome as 'professor' FROM aluno INNER JOIN professor ON professor.id = aluno.id_professor WHERE aluno.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(); 
    return $result;
}

function listagemExercicios($pdo) {
    $sql = "SELECT * FROM exercicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemTreino($pdo, $tipo, $id){
    $sql = "SELECT exercicio.agrupamento, exercicio.nome, treino.id, treino.serie, treino.tipo 
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


function adicionandoTreino($pdo, $serie, $id_professor, $id_exercicio, $id_aluno, $tipo){
    
    $sql = "INSERT INTO treino (serie, id_professor, id_exercicio, id_aluno, tipo) 
                VALUES (:serie, :id_professor, :id_exercicio, :id_aluno, :tipo)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':serie', $serie, PDO::PARAM_STR);
    $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
    $stmt->bindParam(':id_exercicio', $id_exercicio, PDO::PARAM_INT);
    $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    
    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}

function excluirTreino($pdo, $id){
    $sql = "DELETE FROM treino WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  
    if($stmt->execute()){
    return true;   
    } else {
    return false;
    }
}

function alterandoData($pdo ,$id_aluno ,$dataInicio, $dataTroca) {
    
    $sql = "UPDATE aluno SET data_inicio = :dataInicio, data_troca = :dataTroca WHERE id = :id";
                
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":dataInicio", $dataInicio, PDO::PARAM_STR);
        $stmt->bindParam(":dataTroca", $dataTroca, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id_aluno, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount()){
           return true;
        } 
    
    } else {
        return false;
    }
}

function adicionandoExercicio($pdo, $agrupamento, $nome_exercicio){
    
    $sql = "INSERT INTO exercicio (agrupamento, nome) 
                VALUES (:agrupamento, :nome)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':agrupamento', $agrupamento, PDO::PARAM_STR);
    $stmt->bindParam(':nome', $nome_exercicio, PDO::PARAM_STR);
   
    
    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}

function alterarSenha($pdo, $senhaNova, $senhaAntiga, $id){


    $sql = "SELECT senha FROM professor WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $sql_senha = $stmt->fetch(); 

            if(password_verify($senhaAntiga, $sql_senha['senha'])){

                $senhaCriptografada = password_hash($senhaNova, PASSWORD_DEFAULT);

                $sql = "UPDATE professor SET senha = :senha WHERE id = :id";
                
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