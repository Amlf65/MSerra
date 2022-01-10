<?php
session_start();
$arreglo = $_SESSION['carrito'];
echo "primera linea";
echo $arreglo[$i]['Id'];
echo "segunda linea";
echo $_POST['id'];
for($i=0;$i<count($arreglo);$i++){
    if($arreglo[$i]['Id'] != $_POST['id']){
        $arregloNuevo[]=array(
            'Id'=>$arreglo[$i]['Id'],
            'Nombre'=>$arreglo[$i]['Nombre'],
            'Precio'=>$arreglo[$i]['Precio'],
            'Imagen'=>$arreglo[$i]['Imagen'],
            'Cantidad'=>$arreglo[$i]['Cantidad']
        );
    }
}
if(isset($arregloNuevo)){
    $_SESSION['carrito']=$arregloNuevo;
}else{
    //registro e eliminar era el único
    unset($_SESSION['carrito']);
}
echo "listo";
?>