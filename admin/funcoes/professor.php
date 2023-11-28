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

function alerta($mensagem) {
    echo "<script>alert('$mensagem');</script>";
}
