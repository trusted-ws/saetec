<?php 

// Conexão com a base de dados
require('../../includes/conn.php');
// Verificador de Sessão
require('../../includes/verifica.php');
// Verifica se usuário autenticado possuí privilégios de administrador
require('../../includes/admin.php');

if(isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = "UPDATE `usuarios` SET `pendente` = 0 WHERE `id` = $uid;";
    if($result = mysqli_query($con, $query)) {
        header('location: gerenciar.php');
    }

}

?>