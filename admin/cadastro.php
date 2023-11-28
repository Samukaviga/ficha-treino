<?php

include_once("../conexao.php");
include_once("./funcoes/professor.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
     
    if(empty(trim($_POST["email"]))){
        alerta("Por favor, insira o email de usuário.");
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["senha"]))){
        alerta("Por favor, insira sua senha.");
    } 

    if($_POST['senha'] != $_POST['senhaRedigitada']){
        alerta('As senha nao se coincidem. Digite novamente!');
    } else{
        $senhaDigitada = trim($_POST["senha"]);

        $aluno = buscandoProfessor($pdo, $email);

        if($aluno){
            alerta('Professor já cadastrado!');
        } else {

            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $nome = $_POST['nome'];
        
            if(cadastrandoProfessor($pdo, $nome, $email, $senha)){
                alerta('Cadastro realizado com sucesso!');
            } else {
                alerta('Falha ao cadastrar');
            }
        } 
    }

      
        

    
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Ficha de Treino</title>
</head>
<body>

    <main class="cadastro">

        <h1 class="login__titulo">Cadastrar </h1>

        <form class="formulario" action="" method="POST">
            
            <div class="formulario__div">
                <label class="formulario__div__label" for="">Nome Completo</label>
                <input class="formulario__div__input" type="text" name="nome" required>
            </div>           

            <div class="formulario__div">
                <label class="formulario__div__label" for="">Email</label>
                <input class="formulario__div__input" type="email" name="email" required>
            </div>
            
            <div class="formulario__div">    
                <label class="formulario__div__label" for="">Senha</label>
                <input class="formulario__div__input" type="password" name="senha" required>
            </div>

            <div class="formulario__div">    
                <label class="formulario__div__label" for="">Confirmar a Senha</label>
                <input class="formulario__div__input" type="password" name="senhaRedigitada" required>
            </div>
            <button class="formulario__botao" type="submit" name="enviar" >Entrar</button>
        </form>

        <div class="formulario__adicionais" >
            <a href="./login.php" class="formulario__adicionais__link">Já tenho o Cadastro</a>
        </div>

    </main>

</body>
</html>