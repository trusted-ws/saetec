<?php 
// Inicia sessões, para assim poder destruí-las 
session_start(); 
session_destroy(); 
 
header("location:../index.php"); 
?>