<?php

// Conexão com a base de dados
require('../../includes/conn.php');
// Verificador de Sessão
require('../../includes/verifica.php');
// Verifica se usuário autenticado possuí privilégios de administrador
require('../../includes/admin.php');

// $eNome = $_POST['eNome'];
// $eStatus = $_POST['status'];
// $eTipo = $_POST['tipoconta'];
// $id = $_POST['neID'];

$eNome = isset($_POST["eNome"]) ? addslashes(trim($_POST["eNome"])) : FALSE;
$eStatus = isset($_POST["status"]) ? addslashes(trim($_POST["status"])) : FALSE; 
$eTipo = isset($_POST["tipoconta"]) ? addslashes(trim($_POST["tipoconta"])) : FALSE; 
$id = isset($_POST["neID"]) ? addslashes(trim($_POST["neID"])) : FALSE; 

if(!($eNome || $eStatus || $eTipo || $id)) {
    header("Location: ../index.php");
    exit;
}

//echo $eNome . " UID -> " . $id;
$query_update = "UPDATE usuarios SET nome = '$eNome', ativo = '$eStatus', tipo = '$eTipo' WHERE id=$id;";

if(mysqli_query($con, $query_update) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
    echo '<script language="javascript">';
    echo 'alert("Editado com sucesso!")';
    echo '</script>';
    header('location:gerenciar.php');
} else {echo "erro";}
mysqli_close($con);

?>