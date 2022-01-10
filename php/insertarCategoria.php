<?php
include "./conexion.php";

if(isset($_POST['descripcion']) ){
    $conexion->query(
    "insert into categorias (descripcion) values( 
        '".$_POST['descripcion']."')")or die($conexion->error);
        header('Location: ../admin/categorias.php?success');
}else{
    header('Location: ../admin/categorias.php?error=Campos incompletos.');
}
?>