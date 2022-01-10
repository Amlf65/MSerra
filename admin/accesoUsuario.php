<?php
	session_start();

    include "../php/conexion.php";

    $user = $_POST['user'];
	$password = $_POST['password'];
    $pass=sha1($password);

    $resultado = $conexion->query(
        "SELECT * FROM usuario where user='$user' && password='$pass'"
        ) or die("$conexion->error");
    /* if(!empty(mysqli_fetch_row($resultado))){
        $_SESSION['ingreso']=$user;
        echo "existe";
    }else{
        echo "error";
    }  */
    $fila[8]="";
    while ($fila = mysqli_fetch_row($resultado)) {
        $_SESSION['ingreso']=$user;
        echo ($fila[8]);
    }
    $resultado->close();

?>