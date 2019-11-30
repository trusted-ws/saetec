<?php
require('includes/conn.php');

session_start();


$login = isset($_POST["username"]) ? addslashes(trim($_POST["username"])) : FALSE;
$senha = isset($_POST["password"]) ? md5(trim($_POST["password"])) : FALSE; 

if(!$login || !$senha) 
{ 
    header('location:index.php?c=uopwb');
    exit; 
}

$query = "SELECT * FROM `usuarios` WHERE `username` = '$login' AND `password` = '$senha'";
$result = mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
$total = mysqli_num_rows($result);

if($total) {
    $dados = mysqli_fetch_array($result);

    if(!strcmp($senha, $dados["password"])) {
        if($dados["pendente"] == 1) {
            header('location:index.php?c=tuip'); // Usuario pendente
            exit;
        }
        if(!$dados["ativo"] == 0) {
            $_SESSION["id_usuario"]= $dados["id"]; 
            $_SESSION["username"]= $dados["username"]; 
            $_SESSION["nome_usuario"] = stripslashes($dados["nome"]); 
            $_SESSION["permissao"] = $dados["tipo"]; 
            $_SESSION['logado'] = true;
            $_SESSION['primeiroAcesso'] = true;
            header("location:/home/index.php"); 
            exit;
        } else {
            header('location:index.php?c=taina');
            // Usuario nao ativo
            exit;
        }
    } else {
        header('location:index.php?c=uopww');
        // echo $senha . " " . $username;
        exit;
    }
} else {
    header('location:index.php?c=uopww');
    // exit;
}

?>