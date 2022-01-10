<?php

include "./conexion.php";

if(isset($_POST['laminado'])){
    $val_slam=1;
}else{
    $val_slam=0;
}
if(isset($_POST['estructura'])){
    $val_sest=1;
}else{
    $val_sest=0;
}

if(isset($_POST['tapizado'])){
    $val_stap=1;
}else{
    $val_stap=0;
}
if(!isset($_POST['tipoA'])){
    $val_lam=" ";
}else{
    $val_lam=$_POST['tipoA'];
}

if(!isset($_POST['tipoB'])){
    $val_est=" ";
}else{
    $val_est=$_POST['tipoB'];
}

if(!isset($_POST['tipoC'])){
    $val_tap=" ";
}else{
    $val_tap=$_POST['tipoC'];
}


if(isset($_POST['id']) &&
isset($_POST['codigo']) &&
isset($_POST['descripcion']) &&
isset($_POST['serie']) &&
isset($_POST['tipo'])
   ){

        if($_FILES['imagen']['name']!=''){
            $carpeta="../images/";
            $nombre=$_FILES['imagen']['name'];

            $temp=explode('.',$nombre);
            $extension=end($temp);
            $nombreFinal=time().'.'.$extension;


            if($extension=='jpg' || $extension=='png'){
                if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
                    
                    
                    $fila=$conexion->query("select imagen from productos where id=".$_POST['id']);
                    $id=mysqli_fetch_row($fila);
                    if(file_exists($carpeta.$id[0])){
                        unlink(($carpeta.$id[0]));
                    }
                    $conexion->query("update productos set
                        imagen ='".$nombreFinal."' where id=".$_POST['id'])or die($conexion->error); 
                }
            }else{
                header('Location: ../admin/productos.php?error=Imagen incorrecta (jpg o png).');
            }
               
               
        }
        //  else{
        //     header('Location: ../admin/productos.php?error=Imagen vacía.');
        // } 
    

        echo "update productos set
        codigo ='".$_POST['codigo']."', 
        descripcion ='".$_POST['descripcion']."',
        serie ='".$_POST['serie']."',
        tipo ='".$_POST['tipo']."',
        sel_laminado =".$val_slam.",
        laminado ='".$val_lam."',
        sel_estructura =".$val_sest.",
        estructura ='".$val_est."',
        sel_tapizado =".$val_stap.",
        tapizados ='".$val_tap."' 
        where id=".$_POST['id'];


        $conexion->query("update productos set
        codigo ='".$_POST['codigo']."', 
        descripcion ='".$_POST['descripcion']."',
        serie ='".$_POST['serie']."',
        tipo ='".$_POST['tipo']."',
        sel_laminado =".$val_slam.",
        laminado ='".$val_lam."',
        sel_estructura =".$val_sest.",
        estructura ='".$val_est."',
        sel_tapizado =".$val_stap.",
        tapizados ='".$val_tap."' 
        where id=".$_POST['id']) or die($conexion->error); 
        //echo "actualizado";
        header('Location: ../admin/productos.php?success2');
    }else{
        header('Location: ../admin/productos.php?error=Campos incompletos.');
}
?>