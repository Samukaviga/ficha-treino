<?php

    include_once("../conexao.php");
    include_once("./funcoes/professor.php");

    session_start();  
    
    $id_professor = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION['email'];
    $id_aluno = $_SESSION['id_aluno'];
    $admin = $_SESSION['admin'];


    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $admin != 1){
        header("location: ./login.php");
        exit;
    }

    

    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
        $_SESSION['tipo_treino'] = $tipo;
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){

       
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        if(empty(trim($_POST["nome_exercicio"]))){
            alerta("Por favor, insira um nome para o Exercicio.");
        } else if($_POST['agrupamento'] == 0){
            alerta('Selecione um agrupamento');
        } else {

            $agrupamento = $_POST['agrupamento'];
            $nome_exercicio = $_POST["nome_exercicio"];
    
    
            $adicionado = adicionandoExercicio($pdo, $agrupamento, $nome_exercicio);
    
            if($adicionado){
                alerta("Exercicio adicionado com sucesso!");
            } else {
                alerta("Falha ao adicionar o exercicio");
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
    <header>
        <nav class="cabecario__menu">
            <img class="cabecario__menu__icone" id="hamburguer" src="../assets/menu-hamburguer.svg" alt="Icone de navegacao lateral">
            <div class="container__menu__logo">
                <img class="cabecario__menu__logo" src="../assets/logo.jpg" alt="Logotipo da academia">
            </div>
            
            <div class="navegacao" id="navegacao">
                
                <ul class="navegacao__lista">
                    <li class="navegacao__lista__item"><a class="strong-home" href="./">HOME</a></li>
                    <li class="navegacao__lista__item"><a class="strong-home" href="./exercicio.php">Exercicio</a></li>
                    <li class="navegacao__lista__item"><a class="strong-home" href="./alterarSenha.php">Alterar Senha</a></li>
                    <li class="navegacao__lista__item"><a class="strong-home" href="./logout.php">SAIR</a></li>
                
                </ul>
            </div>
        </nav>
    </header>
    <main class="principal__treino">

            <a href="./"><img class="icone__voltar" src="../assets/angulo-esquerdo.svg" alt=""></a>
        

        <h2 class="adicionar__titulo" >Exercicio</h2>

        <section class="adicionar">
            <form class="formulario" action="" method="post">
            
               
                <div class="formulario__div" >
                    <label class="formulario__div__label" for="">Agrupamento</label>
                    <select name="agrupamento" class="formulario__div__input__objetivo">
                      <option value="0">Agrupamento:</option>
                      
                        
                        <option value="Quadriceps">Quadriceps</option>
                        <option value="Posterior Coxa">Posterior Coxa</option>
                        <option value="Biceps">Biceps</option>
                        <option value="Triceps">Triceps</option>
                        <option value="Ombro">Ombro</option>
                        <option value="Peito">Peito</option>
                         <option value="Costas">Costas</option>
                     
                    </select>
                </div>

                <div class="formulario__div">
                    <label class="formulario__div__label" for="">Nome Exercicio</label>
                    <input class="formulario__div__input" type="text" name="nome_exercicio" required>
                </div>
                  
                <button class="formulario__botao" type="submit" name="enviar" >Adicionar</button>
            </form>
        </section>
    </main>
<script>
    const hamburguer = document.querySelector("#hamburguer");
    const navegacao = document.querySelector('#navegacao');

    hamburguer.addEventListener('click', (event) => {
        event.preventDefault();
        
        const displayNavegacao = window.getComputedStyle(navegacao).display

        if(displayNavegacao == 'none'){
            navegacao.style.display = 'block';
        } else {
            navegacao.style.display = 'none';
        }
        
    });


</script>
</body>
</html>