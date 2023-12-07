<?php

    include_once("../conexao.php");
    include_once("./funcoes/professor.php");

    session_start();  
    
    $id_usuario = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION['email'];
    $admin = $_SESSION['admin'];


    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $admin != 1){
        header("location: ./login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $nomeDigitado = $_POST['pesquisar'];
        $listas = listaAlunos($pdo, $nomeDigitado);
        

    } else {
        $nomeDigitado = '';
        $listas = listaAlunos($pdo, $nomeDigitado);
        
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
    <main class="principal">
        
        <section class="pesquisar">
            <form class="formulario" action="" method="POST">
                <div class="formulario__div">
                    <label class="formulario__div__label label__pesquisar" for="">Pesquisar Aluno</label>
                    <input class="formulario__div__input input__pesquisar" type="search" name="pesquisar" >
                </div>
                <input class="formulario__botao botao__pesquisar" value="Buscar" type="submit" name="" id="">
            </form>
        </section>

        <ul class="lista__pesquisar">
            <?php foreach($listas as $lista): ?>
            <li class="lista__pesquisar__item" ><a class="lista__pesquisar__link" href="./informacoes.php?id=<?= $lista['id'];?>"><?= $lista['nome']; ?></a></li>
        
            <?php endforeach; ?>
        </ul>

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