<?php
include "./conexion.php";
if(isset($_POST['id'])) {
    $fila=$conexion->query("select img_perfil from usuario where id=".$_POST['id']);
    $id=mysqli_fetch_row($fila);
    if(file_exists('../images/'.$id[0])){
        unlink(('../images/'.$id[0]));
    }
    $conexion->query("delete from usuario where id=".$_POST['id']);
    echo "Registro Eliminado";
}
