<?php
require('../../includes/conn.php');
require('../../includes/verifica.php');
// Verifica se usuário autenticado possuí privilégios de administrador
require('../../includes/admin.php');

$login = isset($_POST["username"]) ? addslashes(trim($_POST["username"])) : FALSE;
$senha = isset($_POST["password"]) ? md5(trim($_POST["password"])) : FALSE; 
$nome = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE; 
$tipo = isset($_POST["tipoconta"]) ? addslashes(trim($_POST["tipoconta"])) : FALSE; 

// if(!$login || !$senha || $nome || $tipo) 
// { 
//     header('location:cadastrar.php');
//     exit; 
// }
$query_usuario = "SELECT * FROM `usuarios` WHERE `username` = '" . $login . "';";

$result = mysqli_query($con, $query_usuario) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
$total = mysqli_num_rows($result);
if($total == 0) {
    $query = "INSERT INTO `usuarios` ( `nome`, `username`, `password`, `tipo`, `ativo` ) VALUES ( '" . $nome . "', '" . $login . "', '" . $senha . "', '" . $tipo . "', '1');";
    if(mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
        header("location:cadastrar.php?c=nrcs");
        //echo $total;
    }
}else {
    //echo "existe";
    header("location:cadastrar.php?c=uaeidb");
}

mysqli_close($con);

?>