<?php
include "./conexion.php";
if(isset($_POST['id'])) {
    $conexion->query("delete from productos_venta where id=".$_POST['id']);
    echo "Registro Eliminado";
}
