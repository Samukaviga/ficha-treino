<?php

    include_once("../conexao.php");
    include_once("./funcoes/aluno.php");

    session_start();  
    
    $id_professor = $_SESSION["id"];
    $id_aluno = $_SESSION['id'];



    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ./login.php");
        exit;
    }

    

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        $nomeExercicio = $_GET['nome'];
        $tipo_treino = $_GET['tipo'];
        $id_treino = $_GET['id_treino'];
        
        $treino = buscandoTreino($pdo, $id_treino);
       
    }

        $concluido = $treino[0]['concluido'];
        $checkboxConcluido = ($concluido == 0) ? 'checked' : '';


   


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

            <a href="./treino.php?tipo=<?= $tipo_treino; ?>"><img class="icone__voltar" src="../assets/angulo-esquerdo.svg" alt=""></a>
            <h1 class="treino__titulo"><?= $nomeExercicio; ?></h1>
    

        <section class="treino">
            <img class="treino__gif" src="../assets/gif/<?=$nomeExercicio;?>.gif" alt="Exercicio Gif">
        </section>

       
            <h2 class="treino__gif__titulo">Descricao</h2>
           
            <div class="treino__gif__div">    
                
                <div class="treino__gif__subdiv">
                    <p class="serie__titulo">Série:</p>
                    <p class="treino__gif__div__descricao"><?= $treino[0]['serie']; ?></p>
                </div>

                <div class="treino__container__serie">
                <input class="form-check-input" type="checkbox" role="switch" onchange="checkboxConcluido(this, '<?php echo $id_treino; ?>')" <?= $checkboxConcluido; ?>>
                </div>
            </div>

            <div class="treino__gif__div">    
                
                <div class="treino__gif__subdiv">
                    <p class="serie__titulo">Obs:</p>
                    <p class="treino__gif__div__descricao"><?= $treino[0]['obs'] ? $treino[0]['obs'] : '---' ?></p>
                </div>

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