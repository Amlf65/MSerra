<?php
session_start();
if (!isset($_SESSION['ingreso'])) 
{
    header("location: ./admin/login.php");
}
include'./php/conexion.php';
//exit("nombre".$_POST['lnombre'].$_POST['ldpto'].$_POST['lemail']."---".count($_SESSION['carrito']));

if(!isset($_SESSION['carrito'])
or !isset($_POST['lnombre'])
or !isset($_POST['ldpto'])
or !isset($_POST['lemail'])){
  header('Location: ./index.php');
}
$arreglo = $_SESSION['carrito'];
$arr_lnombre= $_POST['lnombre'];
$arr_ldpto = $_POST['ldpto'];
$arr_lemail= $_POST['lemail'];
/*$total=0;
for($i=0;$i<count($arreglo);$i++){
  $total=$total+($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}
// control usuario
 $password="";
if(isset($_POST['c_account_password'])){
  if($_POST['c_account_password']!=""){
    $password=$_POST['c_account_password'];
  }
} */



$fecha=date('Y-m-d h:m:s');

$conexion->query("insert into ventas(usuario,departamento,email,fecha) 
  values('$arr_lnombre','$arr_ldpto','$arr_lemail','$fecha'
  )") or die($conexion->error);

$id_venta = $conexion->insert_id;

$mensaje="Fecha : ".$fecha."\n";
$mensaje=$mensaje."Venta : ".$id_venta."\n";
$mensaje=$mensaje."Usuario : ".$arr_lnombre."\n";
$mensaje=$mensaje."Departamento : ".$arr_lnombre."\n";

for($i=0;$i<count($arreglo);$i++){

  $conexion->query("insert into productos_venta(id_venta,id_producto,cantidad,laminado,estructura,tapizado) 
  values(
    $id_venta,
    ".$arreglo[$i]['Id'].",
    ".$arreglo[$i]['Cantidad'].",
    '".$arreglo[$i]['Laminado']."',
    '".$arreglo[$i]['Estructura']."',
    '".$arreglo[$i]['Tapizado']."'
    )") or die($conexion->error);
    $mensaje=$mensaje."Id : ".$arreglo[$i]['Id']."\r\n";
    $mensaje=$mensaje."Cantidad : ".$arreglo[$i]['Cantidad']."\r\n";
    $mensaje=$mensaje."Laminado : ".$arreglo[$i]['Laminado']."\r\n";
    $mensaje=$mensaje."Estructura : ".$arreglo[$i]['Estructura']."\r\n";
    $mensaje=$mensaje."Tapizado : ".$arreglo[$i]['Tapizado']."\r\n";
}
//mespino@laspalmasgc.es
$para="farencibia@amserra.com;amlf65@gmail.com".$arr_lemail;
$titulo="Web Martínez Serra";
$cabeceras = "From: webmaster@example.com";

mail($para, $titulo, $mensaje, $cabeceras);

unset($_SESSION['carrito']);
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
   <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <p class="lead mb-5">Su pedido ha sido grabado</p>
            <p><a href="index.php" class="btn btn-sm btn-primary">Volver a Inicio</a></p>
          </div>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>