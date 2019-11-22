<?php


if($_SESSION["permissao"] != 1) {
    header('location: ../index.php');
}

?>