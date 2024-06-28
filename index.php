<?php

session_start();
error_reporting(0);

$validar = $_SESSION['$correo'];
if($validar == null || $validar == ''){
    header("Location: ./inicio.html");
    die();
}else {
    header("Location: ./vistasCliente/inicioCliente.php");
}

    
