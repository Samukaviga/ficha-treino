<?php

include_once("../conexao.php");
include_once("./funcoes/aluno.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
     
    if(empty(trim($_POST["email"]))){
        alerta("Por favor, insira o email de usuário.");
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["senha"]))){
        alerta("Por favor, insira sua senha.");
    } 

    if($_POST['objetivo'] == 0){
        alerta('Selecione um objetivo');
    }
    else if($_POST['id_professor'] == 0){
        alerta('Selecione um objetivo');

    } else if($_POST['senha'] != $_POST['senhaRedigitada']){
        alerta('As senha nao se coincidem. Digite novamente!');
    } else{
        $senhaDigitada = trim($_POST["senha"]);

        $aluno = buscandoAluno($pdo, $email);

        if($aluno){
            alerta('Aluno já cadastrado!');
        } else {

            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $nome = $_POST['nome'];
            $data_nascimento = $_POST['data_nascimento'];
            $saude_medicamento = $_POST['saude_medicamento'];
            $objetivo = $_POST['objetivo'];
            $id_professor = $_POST['id_professor'];
            
        
            if(cadastrandoAluno($pdo, $nome, $email, $objetivo, $id_professor, $senha, $data_nascimento, $saude_medicamento)){
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

        <h1 class="login__titulo">Cadastrar</h1>

        <form class="formulario" action="" method="POST">
            
            <div class="formulario__div">
                <label class="formulario__div__label" for="">Nome Completo</label>
                <input class="formulario__div__input" type="text" name="nome" required>
            </div>
            <div class="formulario__div" >
                <label class="formulario__div__label" for="">Objetivo</label>
                <select name='objetivo' class="formulario__div__input__objetivo">
                  <option value="0">Objetivo:</option>
                  <option value="Emagrecimento">Emagrecimento</option>
                  <option value="Hipertofria">Hipertrofia</option>
                  <option value="Hipertrofia + Emagrecimento">Hipertrofia + Emagrecimento</option>
                </select>
              </div>

              <div class="formulario__div" >
                <label class="formulario__div__label" for="">Professor</label>
                <select name="id_professor" class="formulario__div__input__objetivo">
                  <option value="0">Professor:</option>
                  <option value="1">Tauan Freires</option>
                </select>
              </div>
              
            <div class="formulario__div">
                <label class="formulario__div__label" for="">Data Nascimento</label>
                <input class="formulario__div__input" type="date" name="data_nascimento" required>
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

            <div class="formulario__div">
                <label class="formulario__div__label" for="">Saúde/Medicamento</label>
                <textarea class="formulario__div__input" cols="30" rows="20" type="text" name="saude_medicamento" placeholder="Se sim, descrever"></textarea>
            </div> 

            <button class="formulario__botao" type="submit" name="enviar" >Cadastrar</button>
        </form>

        <div class="formulario__adicionais" >
            <a href="./login.php" class="formulario__adicionais__link">Já tenho o Cadastro</a>
        </div>

    </main>

</body>
</html>