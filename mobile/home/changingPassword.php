<?php

require('../../includes/conn.php');
require('../../includes/verifica.php');
require('../../includes/admin.php');

$user = $_SESSION['username'];
$senha_atual = isset($_POST["senhaAtual"]) ? md5(trim($_POST["senhaAtual"])) : FALSE;
$senha_nova = isset($_POST["novaSenha"]) ? md5(trim($_POST["novaSenha"])) : FALSE;
$senha_repetida = isset($_POST["senhaConfirma"]) ? md5(trim($_POST["senhaConfirma"])) : FALSE;

if(!$senha_atual || !$senha_nova || !$senha_repetida) 
{ 
    header('location:index.php');
    exit; 
}


$query_verifica = "SELECT * FROM `usuarios` WHERE `username` = '" . $user . "' AND `password` = '" . $senha_atual . "'";
$result_verifica = mysqli_query($con, $query_verifica) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
$total = mysqli_num_rows($result_verifica);
if ($total) {
    // Senha digita existe. Dar continuidade.
    if (!($senha_nova != $senha_repetida)) {
        // Trocar senha
        $query_trocarSenha = "UPDATE `usuarios` SET `password` = '" . $senha_nova . "' WHERE `username` = '" . $user . "';";
        $result_trocarSenha = mysqli_query($con, $query_trocarSenha) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
        header("location: minhaconta.php?c=passwordChanged");
        exit;
    } else {
        // Senhas nao correspondem
        header("location: changePassword.php?c=passwordNotEqual");
        exit;
    }
} else {
    header("location: changePassword.php?c=incorrectPassword");
    exit;
}
//header('location:minhaconta.php?c=usernameChanged');
mysqli_close($con);

?>