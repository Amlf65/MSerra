<?php
    /* $servidor="sql207.epizy.com";
    $nombreBd="epiz_26431496_serra";
    $usuario="epiz_26431496";
    $pass="Stv6Py3nqticW"; */
    $servidor="localhost";
    $nombreBd="serra";
    $usuario="root";
    $pass="";
    $conexion= new mysqli($servidor,$usuario,$pass,$nombreBd);
    mysqli_set_charset($conexion,"utf8");
    if($conexion->connect_error){
        die("No se pudo establecer la conexión");
    }
?>