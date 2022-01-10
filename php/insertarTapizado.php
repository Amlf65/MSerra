<?php
include "./conexion.php";

$val_tipo='Tapizado';



if(isset($_POST['serie']) &&
isset($_POST['nombre'])    ){
    $carpeta="../images/";
    $nombre=$_FILES['imagen']['name'];

    $temp=explode('.',$nombre);
    $extension=end($temp);
    $nombreFinal=time().'.'.$extension;
    if($extension=='jpg' || $extension=='png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
            $conexion->query(
                "insert into extras (tipo, serie, nombre, imagen)
                values( 
                    'Tapizado',
                    '".$_POST['serie']."',
                    '".$_POST['nombre']."',
                    '$nombreFinal'
            )")or die($conexion->error);
            header('Location: ../admin/tapizados.php?success');
        }else{

            header('Location: ../admin/tapizados.php?error=Error de transferencia.');
        }
    }else{
        header('Location: ../admin/tapizados.php?error=Imagen incorrecta (jpg o png).');
    }
}else{
    header('Location: ../admin/tapizados.php?error=Campos incompletos.');
}
?>