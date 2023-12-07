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

        if($_GET['tipo']){
            $tipo = $_GET['tipo'];
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        if(empty(trim($_POST["serie"]))){
            alerta("Por favor, insira a serie.");
        } 

        if($_POST['id_exercicio'] == 0){
            alerta('Selecione um exercicio');
        } 
         
        $id_exercicio = $_POST['id_exercicio'];
        $serie = trim($_POST["serie"]);


        $adicionado = adicionandoTreino($pdo, $serie, $id_professor, $id_exercicio, $id_aluno, $_SESSION['tipo_treino']);

        if($adicionado){
          
        } else {
            alerta("Falha ao adicionar o exercicio");
        }
    }

    $tipo_treino = $_SESSION['tipo_treino'];

    $exercicios = listagemExercicios($pdo);
    $treinos = listagemTreino($pdo, $_SESSION['tipo_treino'], $id_aluno);

   


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

            <a href="./informacoes.php?id=<?= $id_aluno; ?>"><img class="icone__voltar" src="../assets/angulo-esquerdo.svg" alt=""></a>
            <h1 class="treino__titulo">Treino - <?= $tipo_treino; ?></h1>
            <?php $i = 1; ?>
            <?php  foreach($treinos as $treino): ?>
                
        <section class="treino treino__admin">
            
            <div class="treino__container__conteudo" >
                <a href="./gif.php?nome=<?= $treino['nome']; ?>&tipo=<?= $tipo_treino; ?>">
                    <p class="treino__container__conteudo__titulo" ><?= $treino['tipo']; ?><?= $i; ?> <?= $treino['agrupamento']; ?></p>
                    <p class="treino__container__conteudo__exercicio"><?= $treino['nome']; ?></p>
                   
                </a>
            </div>
            <div class="treino__container__serie">
                <p class="treino__container__conteudo__serie"><?= $treino['serie']; ?></p>
             
            </div>
            
        </section>
        
        <div class="container__excluir" >
            <a class="botao__excluir" href="excluirTreino.php?id=<?= $treino['id']; ?>">Excluir</a>  
        </div>
        <?php $i += 1; ?>
        <?php endforeach; ?>
 

        <h2 class="adicionar__titulo" >Adicionar Exercicio</h2>

        <section class="adicionar">
            <form class="formulario" action="" method="post">
            
               
                <div class="formulario__div" >
                    <label class="formulario__div__label" for="">Exercicio</label>
                    <select name="id_exercicio" class="formulario__div__input__objetivo">
                      <option value="0">Exercicio:</option>
                      <?php foreach($exercicios as $exercicio): ?>
                        <option value="<?= $exercicio['id']; ?>"><?= $exercicio['nome']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>

                <div class="formulario__div">
                    <label class="formulario__div__label" for="">Serie</label>
                    <input class="formulario__div__input" type="text" name="serie" required>
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