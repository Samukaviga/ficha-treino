<?php

    include_once("../conexao.php");
    include_once("./funcoes/professor.php");

    session_start();  
    
    $id_usuario = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION['email'];
    $id_aluno = $_SESSION['id_aluno'];
    $admin = $_SESSION['admin'];

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $admin != 1){
        header("location: ./login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

       $dataTroca = $_POST['dataTroca'];
       $dataInicio = $_POST['dataInicio'];

        if(empty($dataInicio) || empty($dataTroca)){
            alerta("Preencha as datas!");
        } else {

            $alterado = alterandoData($pdo, $id_aluno, $dataInicio, $dataTroca);

            if($alterado){
                    alerta("Datas alterada com sucesso!");
            } else {
                    alerta("Falha ao alterar data");
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
                    <li class="navegacao__lista__item"><a class="strong-home" href="./logout.php">SAIR</a></li>
                
                </ul>
            </div>
        </nav>
    </header>
    <main class="principal__treino">

            <a href="./informacoes.php?id=<?= $id_aluno; ?>"><img class="icone__voltar" src="../assets/angulo-esquerdo.svg" alt=""></a>
 

        <h2 class="adicionar__titulo" >Alterar Data</h2>

        <section class="adicionar">
            <form class="formulario" action="" method="POST">
            
               
                <div class="formulario__div" >
                    <label class="formulario__div__label" for="">Data Inicio</label>
                    <input class="formulario__div__input" type="date" name="dataInicio">
                </div>

                <div class="formulario__div">
                    <label class="formulario__div__label" for="">Data de Troca</label>
                    <input class="formulario__div__input" type="date" name="dataTroca">
                </div>
                  
                <button class="formulario__botao" type="submit" name="enviar" >Alterar</button>
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