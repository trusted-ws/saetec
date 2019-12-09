<?php

// Conexão com a base de dados
require('../../includes/conn.php');
// Verificador de Sessão
require('../../includes/verifica.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "UPDATE reservas SET cancelado = 1 WHERE id=$id;";
    if($result = mysqli_query($con, $query)) {
        header('location: /mobile/home/agendamentos.php');
    }
}

?>