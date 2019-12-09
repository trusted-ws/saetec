<?php

require('../../includes/conn.php');
require('../../includes/verifica.php');
require('../../includes/admin.php');

$newName = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;
$currentUsername = isset($_SESSION["username"]) ? addslashes(trim($_SESSION["username"])) : FALSE;

if(!$newName || !$currentUsername) 
{ 
    header('location:index.php');
    exit; 
}

$query_trocarNome = "UPDATE `usuarios` SET `nome` = '" . $newName . "' WHERE `username` = '" . $currentUsername . "';";
$result_trocarNome = mysqli_query($con, $query_trocarNome) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
header('location:minhaconta.php?c=usernameChanged');
mysqli_close($con);

?>