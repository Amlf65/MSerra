<?php
session_start();
if (!isset($_SESSION['ingreso'])) 
{
    header("location: admin/login.php");
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

        <div class="row mb-5">
          <?php
         
          include("./php/conexion.php");
          /* for($i=0;$i<50;$i++){
                $conexion->query("insert into productos (nombre,descripcion,precio,imagen,inventario,id_categoria,talla,color) 
                values ('Producto $i','Descripción $i',".rand(10,1000).",'cloth_1.jpg',".rand(1,100).",1,'XL','Orange'
                )") or die($conexion->error);
             } */
          $limite = 9; // productos por página
          $totalQuery = $conexion->query("select count(*) from productos where inventario>0") or die($conexion->error);
          $totalProductos = mysqli_fetch_row($totalQuery);
          $totalBotones = round($totalProductos[0] / $limite);
          /* echo $totalProductos[0];
          echo $totalBotones; */
          if (isset($_GET['orden'])) {
            if (isset($_GET['limite'])) {
              $resultado = $conexion->query("select * from productos where inventario>0 order by " .$_GET['orden']." ,codigo limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
            } else {
              $resultado = $conexion->query("select * from productos where inventario>0 order by " .$_GET['orden']. ",codigo limit " . $limite) or die($conexion->error);
            }
          } else {
            if (isset($_GET['limite'])) {
              $resultado = $conexion->query("select * from productos where inventario>0 order by tipo,codigo limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
            } else {
              $resultado = $conexion->query("select * from productos where inventario>0 order by tipo,codigo limit " . $limite) or die($conexion->error);
            }
          }
          //$resultado = $conexion->query("select * from productos where inventario>0 order by id DESC limit 10") or die($conexion->error);
          while ($fila = mysqli_fetch_array($resultado)) {
          ?>
            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
              <div class="block-4 text-center border">
                <figure class="block-4-image">
                  <a href="shop-single.php?id=<?php echo $fila["id"]; ?>">
                    <img src="images/<?php echo $fila["imagen"]; ?>" alt="<?php echo $fila["imagen"]; ?>" class="img-fluid m-3 " style="height:200px"></a>
                </figure>
                <div class="block-4-text p-4">
                  <h3><a href="shop-single.php?id=<?php echo $fila["id"]; ?>"><?php echo $fila["codigo"]; ?></a></h3>
                  <p class="mb-0"><?php echo $fila["tipo"]; ?></p>
                  <p class="mb-0"><?php echo substr($fila["descripcion"],0,50)."..."; ?></p>
                  <p class="mb-0"><?php echo $fila["serie"]?></p>
                </div>
              </div>
            </div>
          <?php
          }
          ?>

        </div>
         <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>

                <?php
                if (isset($_GET['limite'])) {
                  if ($_GET['limite'] > 0) {
                    echo '<li><a href="index.php?limite=' . ($_GET['limite'] - $limite) . '">&lt;</a></li>';
                  }
                }
                for ($k = 0; $k < $totalBotones; $k++) {
                  echo '<li><a href="index.php?limite=' . ($k * $limite) . '">' . ($k + 1) . '</a></li>';
                }
                if (isset($_GET['limite'])) {
                  if (($_GET['limite'] + $limite) < ($totalBotones * $limite)) {
                    echo '<li><a href="index.php?limite=' . ($_GET['limite'] + $limite) . '">&gt;</a></li>';
                  }
                } elseif($totalBotones > 0) {
                  echo '<li><a href="index.php?limite='.$limite.'">&gt;</a></li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div> 
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

</body>

</html>