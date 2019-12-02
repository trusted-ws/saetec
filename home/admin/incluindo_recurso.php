<?php

// Conexão com a base de dados
require('../../includes/conn.php');
// Verificador de Sessão
require('../../includes/verifica.php');
// Verifica se usuário autenticado possuí privilégios de administrador
require('../../includes/admin.php');

$nome = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;
$quantidade = isset($_POST["quantidade"]) ? addslashes(trim($_POST["quantidade"])) : FALSE; 
$descricao = isset($_POST["descricao"]) ? addslashes(trim($_POST["descricao"])) : FALSE; 
$categoria = isset($_POST["categoria"]) ? addslashes(trim($_POST["categoria"])) : FALSE; 

if(!($nome || $quantidade || $descricao || $categoria)) {
    header("Location: ../index.php");
    exit;
}

$query = "INSERT INTO `recurso` ( `nome`, `tipo_recurso`, `quantidade`, `descricao` ) VALUES ( '" . $nome . "', '" . $categoria . "', '" . $quantidade . "', '" . $descricao . "');";
if(mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
    header("location:incluir_objeto.php?c=nrcs");
}

mysqli_close($con);

?>