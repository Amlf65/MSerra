<?php
include "./conexion.php";

$val_tipo='Laminado';



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
                    'Laminado',
                    '".$_POST['serie']."',
                    '".$_POST['nombre']."',
                    '$nombreFinal'
            )")or die($conexion->error);
            header('Location: ../admin/laminados.php?success');
        }else{

            header('Location: ../admin/laminados.php?error=Error de transferencia.');
        }
    }else{
        header('Location: ../admin/laminados.php?error=Imagen incorrecta (jpg o png).');
    }
}else{
    header('Location: ../admin/laminados.php?error=Campos incompletos.');
}
?>