<?php
include "./conexion.php";

if(isset($_POST['nombre']) &&
isset($_POST['telefono']) &&
isset($_POST['user']) &&
isset($_POST['clave']) &&
isset($_POST['dpto']) &&
isset($_POST['email']) &&
isset($_POST['nivel'])   ){
    $carpeta="../images/";
    $nombre=$_FILES['imagen']['name'];

    $temp=explode('.',$nombre);
    $extension=end($temp);
    $nombreFinal=time().'.'.$extension;
    if($extension=='jpg' || $extension=='png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
            $conexion->query(
                "insert into usuario (nombre, telefono, user, departamento, email, password, img_perfil, nivel)
                values( 
                    '".$_POST['nombre']."',
                    '".$_POST['telefono']."',
                    '".$_POST['user']."',
                    '".$_POST['dpto']."',
                    '".$_POST['email']."',
                    '".sha1($_POST['clave'])."',
                    '$nombreFinal',
                    '".$_POST['nivel']."'
            )")or die($conexion->error);
            header('Location: ../admin/usuarios.php?success');
        }else{

            header('Location: ../admin/usuarios.php?error=Error de transferencia.');
        }
    }else{
        header('Location: ../admin/usuarios.php?error=Imagen incorrecta (jpg o png).');
    }
}else{
    header('Location: ../admin/usuarios.php?error=Campos incompletos.');
}
?>