<?php
include "./conexion.php";
if(isset($_POST['id'])) {
    $conexion->query("delete from categorias where id=".$_POST['id']);
    echo "Registro Eliminado";
header('Location: ../admin/categorias.php?success2');
}else{
    header('Location: ../admin/categorias.php?error=Campos incompletos.');
}
?>
