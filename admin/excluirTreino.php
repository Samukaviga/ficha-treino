<?php 

 include_once("../conexao.php");
include_once("./funcoes/professor.php");

session_start();  

$tipo_treino = $_SESSION['tipo_treino'];

if($_SERVER["REQUEST_METHOD"] == "GET"){

    if($_GET['id']){
        $id = $_GET['id'];

        var_dump($id);

        $excluido = excluirTreino($pdo, $id);
        
        if($excluido){
            alerta('Excluido com sucesso!');
            header('Location: treino.php?tipo='.$tipo_treino);
        } else {
            alerta('Falha ao excluir!');
            header('Location: treino.php?tipo='.$tipo_treino);
        }
    }
}