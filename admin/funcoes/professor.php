<?php 


function buscandoProfessor($pdo, $email) {
    $sql = "SELECT id, email, nome, senha FROM professor WHERE email = :email";
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

function listaAlunos($pdo){
    $sql = "SELECT id, nome FROM aluno";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
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

function listagemTreino($pdo){
    $sql = "SELECT exercicio.agrupamento, exercicio.nome, treino.serie, treino.tipo FROM treino INNER JOIN exercicio ON exercicio.id = treino.id_exercicio";
    $stmt = $pdo->prepare($sql);
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