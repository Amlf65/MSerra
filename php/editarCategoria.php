<?php

include "./conexion.php";


if(isset($_POST['descripcion']) ){

    $conexion->query("update categorias set
    descripcion ='".$_POST['descripcion']."'
    where id=".$_POST['id']) or die($conexion->error); 
    //echo "actualizado";
    header('Location: ../admin/categorias.php?success2');
}else{
    header('Location: ../admin/categorias.php?error=Campos incompletos.');
}
?>