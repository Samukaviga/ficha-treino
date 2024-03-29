<?php

    include_once("../conexao.php");
    include_once("./funcoes/aluno.php");

    session_start();  
    
    $id_usuario = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION['email'];

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ./login.php");
        exit;
    }

    $aluno = buscandoAluno($pdo, $email);


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
                    <li class="navegacao__lista__item"><a href="./treino.php?tipo=A">Treino - A</a><img src="../assets/treino1.svg" class="icone-menu" alt="Icone treino"></li>
                    <li class="navegacao__lista__item"><a href="./treino.php?tipo=B">Treino - B</a><img src="../assets/treino1.svg" class="icone-menu" alt="Icone treino"></li>
                    <li class="navegacao__lista__item"><a href="./treino.php?tipo=C">Treino - C</a><img src="../assets/treino1.svg" class="icone-menu" alt="Icone treino"></li>
                    <li class="navegacao__lista__item"><a href="./alterarSenha.php">Alterar Senha</a><img src="../assets/alterar.svg" class="icone-menu" alt="Icone treino"></li>
                    <li class="navegacao__lista__item"><a href="./logout.php">SAIR</a><img src="../assets/sair.svg" class="icone-menu" alt="Icone treino"></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="principal">
        <section class="sessao__treino">
            <div class="sessao__treino__container">
                <h1 class="sessao__treino__container__titulo"><a href="./treino.php?tipo=A">Treino - A</a></h1>
            </div>
            <div class="sessao__treino__container">
                <h2 class="sessao__treino__container__titulo"><a href="./treino.php?tipo=B">Treino - B</a></h2>
            </div>
            <div class="sessao__treino__container">
                <h3 class="sessao__treino__container__titulo"><a href="./treino.php?tipo=C">Treino - C</a></h3>
            </div>
        </section>

        <section class="sessao__dados">
            <ul class="sessao__dados__lista">
                <li class="sessao__dados__lista__item" ><strong class="strong">ALUNO: </strong><?= $aluno['nome']; ?></li>
                <li class="sessao__dados__lista__item" ><strong class="strong">PROFESSOR: </strong><?= $aluno['professor']; ?></li>
                <li class="sessao__dados__lista__item" ><strong class="strong">OBJETIVO: </strong><?= $aluno['objetivo']; ?></li>
                <li class="sessao__dados__lista__item" ><strong class="strong">Data Nascimento: </strong><?= $aluno['data_nascimento'] ? date("d/m/Y", strtotime($aluno['data_nascimento'])) : ' --' ; ?></li>
                <li class="sessao__dados__lista__item" ><strong class="strong">Data Inicio: </strong><?= $aluno['data_inicio'] ? date("d/m/Y", strtotime($aluno['data_inicio'])) : ' --' ; ?></li>
                <li class="sessao__dados__lista__item" ><strong class="strong">Data de Troca: </strong><?= $aluno['data_troca'] ? date("d/m/Y", strtotime($aluno['data_troca'])) : ' --'; ?></li>
                <li class="sessao__dados__lista__item" ><strong class="strong">Saúde/Medicamento: </strong><?= $aluno['saude_medicamento'] ? $aluno['saude_medicamento'] : ' --' ; ?></li>
                <div class="sessao_botao-editar">
                    <a href="./editar.php">Editar</a>
                </div>
            </ul>
            
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