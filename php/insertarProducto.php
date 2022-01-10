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
    $val_lam="";
}else{
    $val_lam=$_POST['tipoA'];
}

if(!isset($_POST['tipoB'])){
    $val_est="";
}else{
    $val_est=$_POST['tipoB'];
}

if(!isset($_POST['tipoC'])){
    $val_tap="";
}else{
    $val_tap=$_POST['tipoC'];
}

if(isset($_POST['codigo']) &&
isset($_POST['descripcion']) &&
isset($_POST['serie']) &&
isset($_POST['tipo'])    ){
    $carpeta="../images/";
    $nombre=$_FILES['imagen']['name'];

    $temp=explode('.',$nombre);
    $extension=end($temp);
    $nombreFinal=time().'.'.$extension;
    if($extension=='jpg' || $extension=='png'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
            $conexion->query(
                "insert into productos (codigo, descripcion, serie, tipo, imagen, sel_laminado, laminado, sel_estructura,estructura, sel_tapizado,tapizados,inventario)
                values( 
                    '".$_POST['codigo']."',
                    '".$_POST['descripcion']."',
                    '".$_POST['serie']."',
                    '".$_POST['tipo']."',
                    '$nombreFinal',
                    ".$val_slam.",
                    '".$val_lam."',
                    ".$val_sest.",
                    '".$val_est."',
                    ".$val_stap.",
                    '".$val_tap."',
                    ". 1 ."
            )")or die($conexion->error);
            header('Location: ../admin/productos.php?success');
        }else{

            header('Location: ../admin/productos.php?error=Error de transferencia.');
        }
    }else{
        header('Location: ../admin/productos.php?error=Imagen incorrecta (jpg o png).');
    }
}else{
    header('Location: ../admin/productos.php?error=Campos incompletos.');
}
?>