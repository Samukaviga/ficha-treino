<?php

    include_once("../conexao.php");
    include_once("./funcoes/aluno.php");

    session_start();  
    
    $id = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION['email'];


    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ./login.php");
        exit;
    }


    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
        $_SESSION['tipo_treino'] = $tipo;
    }


     $treinos = listagemTreino($pdo, $tipo, $id);


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
    <main class="principal__treino">

            <a href="./"><img class="icone__voltar" src="../assets/angulo-esquerdo.svg" alt=""></a>
            <h1 class="treino__titulo">Treino - <?= $tipo; ?></h1>
    
        <?php $i = 1; ?>
        <?php
         
         foreach($treinos as $treino): 
         
            $concluido = $treino['concluido'];
            $checkboxConcluido = ($concluido == 0) ? 'checked' : '';
         
         ?>
        <section class="treino">
            <div class="treino__container__conteudo" >
                <a href="./gif.php?nome=<?= $treino['nome']; ?>&tipo=<?= $tipo; ?>&id_treino=<?=$treino['id']; ?>">
                    <p class="treino__container__conteudo__titulo" ><?= $treino['tipo']; ?><?= $i; ?> <?= $treino['agrupamento']; ?></p>
                    <p class="treino__container__conteudo__exercicio"><?= $treino['nome']; ?></p>
                </a>
            </div>
            <div class="treino__container__serie">
                <input class="form-check-input" type="checkbox" role="switch" onchange="checkboxConcluido(this, '<?php echo $treino['id']; ?>')" <?= $checkboxConcluido; ?>>
            </div>
        </section>
        <?php $i += 1; ?>
        <?php endforeach; ?>

        <div class="div__botao">
            <a href="./funcoes/treinoConcluido.php?id=<?= $id; ?>&tipo=<?= $tipo; ?>" class="botao__concluido">Concluir</a>
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
<script src="./funcoes/js/checkbox.js" ></script>
</body>
</html>