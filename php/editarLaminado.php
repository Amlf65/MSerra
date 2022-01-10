<?php

include "./conexion.php";

if(isset($_POST['id']) &&
isset($_POST['serie']) &&
isset($_POST['nombre']) 
){
    if($_FILES['imagen']['name']!=''){
        $carpeta="../images/";
        $nombre=$_FILES['imagen']['name'];

        $temp=explode('.',$nombre);
        $extension=end($temp);
        $nombreFinal=time().'.'.$extension;


        if($extension=='jpg' || $extension=='png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
                
                echo("---".$_POST['id']);
                $fila=$conexion->query("select imagen from extras where id=".$_POST['id']);
                $id=mysqli_fetch_row($fila);
                if(file_exists($carpeta.$id[0])){
                    unlink(($carpeta.$id[0]));
                }
                $conexion->query("update extras set
                    imagen ='".$nombreFinal."' where id=".$_POST['id'])or die($conexion->error); 
            }
        }else{
            header('Location: ../admin/laminados.php?error=Imagen incorrecta (jpg o png).');
        }
            
            
    }
    //  else{
    //     header('Location: ../admin/productos.php?error=Imagen vacía.');
    // } 


    echo "update extras set
    tipo ='Laminado',
    serie ='".$_POST['serie']."',
    nombre ='".$_POST['nombre']."' 
    where id=".$_POST['id'];


    $conexion->query( "update extras set
    tipo ='Laminado',
    serie ='".$_POST['serie']."',
    nombre ='".$_POST['nombre']."' 
    where id=".$_POST['id']) or die($conexion->error); 
    //echo "actualizado";
    header('Location: ../admin/laminados.php?success2');
}else{
    header('Location: ../admin/laminados.php?error=Campos incompletos.');
}
