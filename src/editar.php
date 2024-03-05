<?php

    include_once("../conexao.php");
    include_once("./funcoes/aluno.php");

    session_start();  
    
    $id_usuario = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION['email'];

    $aluno = buscandoAluno($pdo, $email);
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ./login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["nome"]))){
            alerta("Campo nome obrigatório");
        } else{
           
                $editado = editandoAluno($pdo, $_POST['nome'], $_POST['data_nascimento'], $_POST['saude_medicamento'], $id_usuario);
                if($editado){
                    header('Location: ./index.php');
                    exit();
                } else {
                    alerta("Falha ao Editar!");
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
 

        <h2 class="adicionar__titulo" >Editar Dados</h2>

        <section class="adicionar">
            <form class="formulario" action="" method="POST">
            
               
                <div class="formulario__div" >
                    <label class="formulario__div__label" for="">Nome</label>
                    <input class="formulario__div__input" type="text" name="nome" value="<?= $aluno['nome'] ? $aluno['nome'] : ""; ?>">
                </div>

                <div class="formulario__div">
                    <label class="formulario__div__label" for="">Data de nascimento</label>
                    <input class="formulario__div__input" type="date" name="data_nascimento" value = "<?= $aluno['data_nascimento'] ? $aluno['data_nascimento'] : "" ?>">
                </div>
                  
                <div class="formulario__div">
                    <label class="formulario__div__label" for="">Saude / Medicamento </label>
                    <input class="formulario__div__input" type="text" name="saude_medicamento" value = "<?= $aluno['saude_medicamento'] ? $aluno['saude_medicamento'] : " " ?>">
                </div>

                <button class="formulario__botao" type="submit" name="enviar" >Editar</button>
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