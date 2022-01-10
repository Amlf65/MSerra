<?php
    $servidor="localhost";
    $nombreBd="amserramar_ayuntalpa";
    $usuario="amserramar_amserramar";
    $pass="QY&Mp)7Vxo-j";
    $conexion= new mysqli($servidor,$usuario,$pass,$nombreBd);
    mysqli_set_charset($conexion,"utf8");
    if($conexion->connect_error){
        die("No se pudo establecer la conexión");
    }
?>