<?php 

// Conexão com a base de dados
require('../../includes/conn.php');
// Verificador de Sessão
require('../../includes/verifica.php');
// Verifica se usuário autenticado possuí privilégios de administrador
require('../../includes/admin.php');

if(isset($_GET['recId'])) {
    $recId = $_GET['recId'];

    $query = "DELETE FROM `recurso` WHERE `recId` = $recId;";
    if($result = mysqli_query($con, $query)) {
        header('location: gerenciar_recursos.php');
    }
}

?>