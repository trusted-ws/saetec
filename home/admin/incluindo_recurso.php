<?php

// Conexão com a base de dados
require('../../includes/conn.php');
// Verificador de Sessão
require('../../includes/verifica.php');
// Verifica se usuário autenticado possuí privilégios de administrador
require('../../includes/admin.php');

$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];

$query = "INSERT INTO `recurso` ( `nome`, `tipo_recurso`, `quantidade`, `descricao` ) VALUES ( '" . $nome . "', '" . $categoria . "', '" . $quantidade . "', '" . $descricao . "');";
if(mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
    header("location:incluir_objeto.php?c=nrcs");
    //echo $total;
}

mysqli_close($con);

?>