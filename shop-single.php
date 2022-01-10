<?php
session_start();
if (!isset($_SESSION['ingreso'])) 
{
    header("location: ./admin/login.php");
}


include "./php/conexion.php";

if (isset($_GET['id'])) {
  $resultado = $conexion->query("select * from productos where id=" . $_GET['id']) or die($conexion->error);
  if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_row($resultado);
    $res_laminado = $conexion->query("select * from extras where tipo='Laminado' and serie='" . $fila['8']."'") or die($conexion->error);
    $res_estructura = $conexion->query("select * from extras where tipo='Estructura' and serie='" . $fila['9']."'") or die($conexion->error);
    $res_tapizado = $conexion->query("select * from extras where tipo='Tapizado' and serie='" . $fila['10']."'") or die($conexion->error);
  } else {
    //redireccionar
    header("Location:./index.php");
  }
} else {
  //redireccionar
  header("Location:./index.php");
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
<title>Martínez Serra</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/magnific-popup.css"> -->
  <!-- <link rel="stylesheet" href="css/jquery-ui.css"> -->
  <!-- <link rel="stylesheet" href="css/owl.carousel.min.css"> -->
  <!-- <link rel="stylesheet" href="css/owl.theme.default.min.css"> -->
  <!-- <link rel="stylesheet" href="css/aos.css"> -->

  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/svg+xml" href="../img/serra.png" sizes="any"> 

</head>

<body>

  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img id="laImagen" src="images/<?php echo $fila[5] ?>" alt="<?php echo $fila[5] ?>" class="img-fluid m-3 w-75">
            <!--  <script>
            // <img id="laImagen" src="images/<?php echo substr($fila[5], 0, strlen($fila[5]) - 4) ?>"+"_"+ micolor.selectedOptions[0].value +".png" alt="<?php echo $fila[5] ?>" class="img-fluid m-3 w-75">
            </script> -->
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $fila[1] ?></h2>
            <p class="text-black"><?php echo $fila[2] ?></p>
  
            <form action="cart.php" method="POST">
              <div class="mb-5">
                
                <input type="hidden" name="laminado" id="laminado" > <!-- 8 -->
                <input type="hidden" name="estructura" id="estructura" ><!-- 9 -->
                <input type="hidden" name="tapizado" id="tapizado" ><!-- 10 -->
                <input type="hidden" name="codigo" value="<?php echo $fila[1]?>">
                <input type="hidden" name="descripcion" value="<?php echo $fila[2]?>">
               
                <?php
                  if($fila[11]==1) {
                ?>
                <div class="wrapper1" style="width: 100%; padding: 4px;">
                  <span><?php echo $fila[8]; ?></span><br/>
                  <?php
                  while($fila_laminado = mysqli_fetch_array($res_laminado)){
                  ?>
                    <button type="button" class="laminado" data-sel1="<?php echo $fila_laminado[3]?>" title="<?php echo $fila_laminado[3]?>"><img src="./images/<?php echo $fila_laminado[4]?>" width="50px" alt=""></button>
                  <?php
                  }
                  ?>
                  <!-- <button type="button" class="laminado" data-sel1="Nogal" title="Nogal"><img src="./images/Nogal.png" width="50px" alt=""></button>
                  <button type="button" class="laminado" data-sel1="Blanco" title="Blanco"><img src="./images/Blanco.png" width="50px" alt=""></button>
                  <button type="button" class="laminado" data-sel1="Roble" title="Roble"><img src="./images/Roble.png" width="50px" alt=""></button>
                  <button type="button" class="laminado" data-sel1="Moca" title="Moca"><img src="./images/Moca.png" width="50px" alt=""></button>
                  <button type="button" class="laminado" data-sel1="Arce" title="Arce"><img src="./images/Arce.png" width="50px" alt=""></button>
                  <button type="button" class="laminado" data-sel1="Haya" title="Haya"><img src="./images/Haya.png" width="50px" alt=""></button> -->
                </div>
                <?php
                  }
                ?>
                 <?php
                  if($fila[12]==1) {
                    //if (strtoupper($fila[9])=="NEO") {
                ?>
               <!--  <div class="wrapper" style="width: 100%; padding: 4px;">
                  <span>Estructuras <?php //echo $fila[9]; ?></span><br/>
                  <button type="button" class="estructura" data-sel2="Gris Oscuro" title="Gris Oscuro"><img src="./images/NEOGOscuro.png" width="50px" alt=""></button>
                  <button type="button" class="estructura" data-sel2="Gris Plata" title="Gris Plata"><img src="./images/NEOGPlata.png" width="50px" alt=""></button>
                </div> -->
                <?php
                  //} else {
                ?>
                <div class="wrapper" style="width: 100%; padding: 4px;">
                  <span><?php echo $fila[9]; ?></span><br/>
                  <?php
                  while($fila_estructura = mysqli_fetch_array($res_estructura)){
                  ?>
                    <button type="button" class="estructura" data-sel2="<?php echo $fila_estructura[3]?>" title="<?php echo $fila_estructura[3]?>"><img src="./images/<?php echo $fila_estructura[4]?>" width="50px" alt=""></button>
                  <?php
                  }
                  ?>
                  <!-- <button type="button" class="estructura" data-sel2="Gris Oscuro" title="Gris Oscuro"><img src="./images/V30Blanco.png" width="50px" alt=""></button>
                  <button type="button" class="estructura" data-sel2="Gris Plata" title="Gris Plata"><img src="./images/V30GOscuro.png" width="50px" alt=""></button> -->
                </div>
                <?php
                    }
                  //}
                ?>
                <?php
                  if($fila[13]==1) {
                    //if($fila[10]=="Polipiel"){
                ?>
                <div class="wrapper2" style="width: 100%; padding: 4px;">
                <span><?php echo $fila[10]; ?></span><br/>
                <?php
                  while($fila_tapizado = mysqli_fetch_array($res_tapizado)){
                  ?>
                    <button type="button" class="tapizado" data-sel3="<?php echo $fila_tapizado[3]?>" title="<?php echo $fila_tapizado[3]?>"><img src="./images/<?php echo $fila_tapizado[4]?>" width="50px" alt=""></button>
                  <?php
                  }
                  ?>

                  <!-- <button type="button" class="tapizado" data-sel3="12805" title="12805"><img src="./images/P12805.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12903" title="12903"><img src="./images/P12903.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12820" title="12820"><img src="./images/P12820.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12811" title="12811"><img src="./images/P12811.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12825" title="12825"><img src="./images/P12825.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12835" title="12835"><img src="./images/P12835.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12840" title="12840"><img src="./images/P12840.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12900" title="12900"><img src="./images/P12900.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12805" title="12805"><img src="./images/P12805.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12903" title="12903"><img src="./images/P12903.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12820" title="12820"><img src="./images/P12820.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12811" title="12811"><img src="./images/P12811.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12825" title="12825"><img src="./images/P12825.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12835" title="12835"><img src="./images/P12835.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12840" title="12840"><img src="./images/P12840.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12900" title="12900"><img src="./images/P12900.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12805" title="12805"><img src="./images/P12805.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12903" title="12903"><img src="./images/P12903.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12820" title="12820"><img src="./images/P12820.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12811" title="12811"><img src="./images/P12811.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12825" title="12825"><img src="./images/P12825.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12835" title="12835"><img src="./images/P12835.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12840" title="12840"><img src="./images/P12840.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12900" title="12900"><img src="./images/P12900.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12805" title="12805"><img src="./images/P12805.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12903" title="12903"><img src="./images/P12903.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12820" title="12820"><img src="./images/P12820.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12811" title="12811"><img src="./images/P12811.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12825" title="12825"><img src="./images/P12825.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12835" title="12835"><img src="./images/P12835.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12840" title="12840"><img src="./images/P12840.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="12900" title="12900"><img src="./images/P12900.png" width="50px" alt=""></button> -->
                <?php
                 //}elseif($fila[10]=="Telas de la oliva") {
                ?>
                <!-- <div class="wrapper2" style="width: 100%; padding: 4px;">
                <span>Tapizados //<?php echo $fila[10]; ?></span><br/>
                  <button type="button" class="tapizado" data-sel3="Negro" title="Negro"><img src="./images/BS009.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Azul_Añil" title="Azul Añil"><img src="./images/BS05.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Celeste" title="Celeste"><img src="./images/BS84.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS103.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS77.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Amarillo" title="Anarillo"><img src="./images/BS88.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rojo" title="Rojo"><img src="./images/BS105.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Claro" title="Turquesa Claro"><img src="./images/BS011.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Oscuro" title="Turquesa_Oscuro"><img src="./images/BS301.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Negro" title="Negro"><img src="./images/BS009.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Azul_Añil" title="Azul Añil"><img src="./images/BS05.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Celeste" title="Celeste"><img src="./images/BS84.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS103.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS77.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Amarillo" title="Anarillo"><img src="./images/BS88.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rojo" title="Rojo"><img src="./images/BS105.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Claro" title="Turquesa Claro"><img src="./images/BS011.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Oscuro" title="Turquesa_Oscuro"><img src="./images/BS301.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Negro" title="Negro"><img src="./images/BS009.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Azul_Añil" title="Azul Añil"><img src="./images/BS05.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Celeste" title="Celeste"><img src="./images/BS84.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS103.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS77.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Amarillo" title="Anarillo"><img src="./images/BS88.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rojo" title="Rojo"><img src="./images/BS105.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Claro" title="Turquesa Claro"><img src="./images/BS011.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Oscuro" title="Turquesa_Oscuro"><img src="./images/BS301.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Negro" title="Negro"><img src="./images/BS009.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Azul_Añil" title="Azul Añil"><img src="./images/BS05.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Celeste" title="Celeste"><img src="./images/BS84.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS103.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Verde" title="Verde"><img src="./images/BS77.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Amarillo" title="Anarillo"><img src="./images/BS88.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rojo" title="Rojo"><img src="./images/BS105.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Claro" title="Turquesa Claro"><img src="./images/BS011.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Turquesa_Oscuro" title="Turquesa_Oscuro"><img src="./images/BS301.png" width="50px" alt=""></button>
                </div> -->
                <?php
                 //}else{
                ?>
               <!--  <div class="wrapper2" style="width: 100%; padding: 4px;">
                <span>Tapizados <?php //echo $fila[10]; ?></span><br/>
                  <button type="button" class="tapizado" data-sel3="Apple" title="Apple"><img src="./images/TApple.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Solano" title="Solano"><img src="./images/TSolano.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Lobster" title="Lobster"><img src="./images/TLobster.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Belize" title="Belize"><img src="./images/TBelize.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Nougat" title="Nougat"><img src="./images/TNougat.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rainforest" title="Rainforest"><img src="./images/TRainforest.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Scuba" title="Scuba"><img src="./images/TScuba.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Parasol" title="Parasol"><img src="./images/TParasol.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Blizzard" title="Blizzard"><img src="./images/TBlizzard.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Tarot" title="Tarot"><img src="./images/TTarot.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Sombrero" title="Sombrero"><img src="./images/TSombrero.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Havana" title="Havana"><img src="./images/THavana.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Apple" title="Apple"><img src="./images/TApple.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Solano" title="Solano"><img src="./images/TSolano.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Lobster" title="Lobster"><img src="./images/TLobster.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Belize" title="Belize"><img src="./images/TBelize.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Nougat" title="Nougat"><img src="./images/TNougat.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rainforest" title="Rainforest"><img src="./images/TRainforest.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Scuba" title="Scuba"><img src="./images/TScuba.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Parasol" title="Parasol"><img src="./images/TParasol.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Blizzard" title="Blizzard"><img src="./images/TBlizzard.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Tarot" title="Tarot"><img src="./images/TTarot.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Sombrero" title="Sombrero"><img src="./images/TSombrero.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Havana" title="Havana"><img src="./images/THavana.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Apple" title="Apple"><img src="./images/TApple.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Solano" title="Solano"><img src="./images/TSolano.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Lobster" title="Lobster"><img src="./images/TLobster.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Belize" title="Belize"><img src="./images/TBelize.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Nougat" title="Nougat"><img src="./images/TNougat.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Rainforest" title="Rainforest"><img src="./images/TRainforest.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Scuba" title="Scuba"><img src="./images/TScuba.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Parasol" title="Parasol"><img src="./images/TParasol.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Blizzard" title="Blizzard"><img src="./images/TBlizzard.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Tarot" title="Tarot"><img src="./images/TTarot.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Sombrero" title="Sombrero"><img src="./images/TSombrero.png" width="50px" alt=""></button>
                  <button type="button" class="tapizado" data-sel3="Havana" title="Havana"><img src="./images/THavana.png" width="50px" alt=""></button>-->
                </div> 
                <?php
                    }
                  //}
                ?>
                <div class="input-group mt-2 p-2" style="max-width: 150px;">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $fila[0] ?>">
                  <input type="text" name="uds" class="form-control text-center txtCantidad" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                  </div>
                </div>
              </div>
              <input type="submit" class=" btn btn-sm btn-primary ml-2" value="Añadir">
            </form>
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
  <!-- <script src="js/owl.carousel.min.js"></script> -->
  <!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
  <!-- <script src="js/aos.js"></script> -->

  <!-- <script src="js/main.js"></script> -->
  <script>
    /* $(document).ready(function() {
      console.log("----------------------------------------------")
      var elcolor = document.getElementById("micolor");
      laImagen.setAttribute("src", "images/<?php echo substr($fila[5], 0, strlen($fila[5]) - 4) ?>" + "_" + micolor.selectedOptions[0].value + ".png")
      elcolor.addEventListener("change", () => {
        laImagen.setAttribute("src", "images/<?php echo substr($fila[5], 0, strlen($fila[5]) - 4) ?>" + "_" + micolor.selectedOptions[0].value + ".png")
      });

    }) */
      $(".laminado").click(function() {
      $(".laminado").css("border","1px solid black");
      $(this).css("border","5px solid black");
      $("#laminado").val($(this).data("sel1"));
    });
      $(".estructura").click(function() {
      $(".estructura").css("border","1px solid black");
      $(this).css("border","5px solid black");
      $("#estructura").val($(this).data("sel2"));
    });
      $(".tapizado").click(function() {
      $(".tapizado").css("border","1px solid black");
      $(this).css("border","5px solid black");
      $("#tapizado").val($(this).data("sel3"));
    });
    var sitePlusMinus = function() {
		$('.js-btn-minus').on('click', function(e){
			e.preventDefault();
			if ( $(this).closest('.input-group').find('.form-control').val() != 0  ) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(0));
			}
		});
		$('.js-btn-plus').on('click', function(e){
			e.preventDefault();
			$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
		});
	};
	sitePlusMinus();
  </script>

</body>

</html>