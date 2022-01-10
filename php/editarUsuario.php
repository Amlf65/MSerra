 <?php

include "./conexion.php";

if(isset($_POST['nombre']) &&
isset($_POST['telefono']) &&
isset($_POST['user']) &&
isset($_POST['clave']) &&
isset($_POST['dpto']) &&
isset($_POST['email']) &&
isset($_POST['nivel'])   ){


        if($_FILES['imagen']['name']!=''){
            $carpeta="../images/";
            $nombre=$_FILES['imagen']['name'];

            $temp=explode('.',$nombre);
            $extension=end($temp);
            $nombreFinal=time().'.'.$extension;
            if($extension=='jpg' || $extension=='png'){
                if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){               
                    $fila=$conexion->query("select img_perfil from usuario where id=".$_POST['id']);
                    $id=mysqli_fetch_row($fila);
                    if(file_exists($carpeta.$id[0])){
                        unlink(($carpeta.$id[0]));
                    }
                    $conexion->query("update usuario set
                        img_perfil ='". $nombreFinal."' where id=".$_POST['id'])or die($conexion->error); 
                }
            }else{
                header('Location: ../admin/usuarios.php?error=Imagen incorrecta (jpg o png).');
            }
               
               
        }
        else{
            header('Location: ../admin/usuarios.php?error=Imagen vacía.');
        }

    $conexion->query("update usuario set
        nombre ='".$_POST['nombre']."', 
        telefono ='".$_POST['telefono']."',
        user ='".$_POST['user']."',
        password ='".sha1($_POST['clave'])."',
        departamento ='".$_POST['dpto']."',
        email ='".$_POST['email']."',
        nivel ='".$_POST['nivel']."'
        where id=".$_POST['id']) or die($conexion->error); 

        header('Location: ../admin/usuarios.php?success2');
}else{
    header('Location: ../admin/usuarios.php?error=Campos incompletos.');
}
?>