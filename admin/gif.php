<?php

    include_once("../conexao.php");
    include_once("./funcoes/professor.php");

    session_start();  
    
    $id_professor = $_SESSION["id"];
    $id_aluno = $_SESSION['id_aluno'];
    $admin = $_SESSION['admin'];
    

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $admin != 1){
        header("location: ./login.php");
        exit;
    }

    

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $nomeExercicio = $_GET['nome'];
        $tipo_treino = $_GET['tipo'];
        $id_treino = $_GET['id_treino'];
    }

    $treino = buscandoTreino($pdo, $id_treino);



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
                    <li class="navegacao__lista__item"><a class="strong-home" href="./">HOME</a><img src="../assets/home-svgrepo-com.svg" class="icone-menu" alt="Icone menu"></li>
                    <li class="navegacao__lista__item"><a class="strong-home" href="./exercicio.php">Exercicio</a><img src="../assets/treino1.svg" class="icone-menu" alt="Icone treino"></li>
                    <li class="navegacao__lista__item"><a class="strong-home" href="./alterarSenha.php">Alterar Senha</a><img src="../assets/alterar.svg" class="icone-menu" alt="Icone treino"></li>
                    <li class="navegacao__lista__item"><a class="strong-home" href="./logout.php">SAIR</a><img src="../assets/sair.svg" class="icone-menu" alt="Icone treino"></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="principal__treino">

            <a href="./treino.php?tipo=<?= $tipo_treino; ?>"><img class="icone__voltar" src="../assets/angulo-esquerdo.svg" alt=""></a>
            <h1 class="treino__titulo"><?= $nomeExercicio; ?></h1>
    

        <section class="treino">
            <img class="treino__gif" src="../assets/gif/<?= $nomeExercicio; ?>.gif" alt="">
        </section>

        <h2 class="treino__gif__titulo">Descricao</h2>
           
           <div class="treino__gif__div">    
               
               <div class="treino__gif__subdiv">
                   <p class="serie__titulo">Série:</p>
                   <p class="treino__gif__div__descricao"><?= $treino['serie']; ?></p>
               </div>

               
           </div>

           <div class="treino__gif__div">    
               
               <div class="treino__gif__subdiv">
                   <p class="serie__titulo">Obs:</p>
                   <p class="treino__gif__div__descricao"><?= $treino['obs'] ? $treino['obs'] : '---' ?></p>
               </div>

           </div>
           <div class="sessao__dados__alterar" >
                <a class="sessao__dados__alterar__botao editar__botao" href="./editarDados.php?id_treino=<?= $treino['id']; ?>">Editar</a>
            </div>



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