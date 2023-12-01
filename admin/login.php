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
    } else{
        $senhaDigitada = trim($_POST["senha"]);
    }

    if(!empty($senhaDigitada) && !empty($email)){ 
        
        $usuario = buscandoProfessor($pdo, $email);

        if($usuario){

            $id = $usuario["id"];
            $email = $usuario["email"];
            $hashed_password = $usuario["senha"];
            $nome = $usuario['nome'];
            $admin = $usuario['admin'];

            if(password_verify($senhaDigitada, $hashed_password)){
                 
                 session_start();
                        
                 $_SESSION["loggedin"] = true;
                 $_SESSION["id"] = $id;
                 $_SESSION["email"] = $email;
                 $_SESSION['nome'] = $nome;
                 $_SESSION['admin'] = $admin;
                                             
                header("location: ./");
                
            } else {
                alerta('Usuario ou Senha incorretos!');
            }

        }else {
            alerta("Usuario ou Senha incorretos!");
        }
    } else{ 
        echo "Algo deu errado";
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

    <main class="login">

        <h1 class="login__titulo" >Login</h1>

        <form class="formulario" action="" method="POST">
            
            <div class="formulario__div">
                <label class="formulario__div__label" for="">Email</label>
                <input class="formulario__div__input" type="email" name="email">
            </div>
            
            <div class="formulario__div">    
                <label class="formulario__div__label" for="">Senha</label>
                <input class="formulario__div__input" type="password" name="senha">
            </div>
            <button class="formulario__botao" type="submit" name="enviar" >Entrar</button>
        </form>


        <div class="formulario__adicionais" >
            <a href="#" class="formulario__adicionais__link">Esqueci a senha</a>
        </div>

    </main>

</body>
</html>