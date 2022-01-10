<?php

session_start();
  if (!isset($_SESSION['ingreso'])) 
  {
      header("location: ./admin/login.php");
  }

include("./php/conexion.php");
if (!isset($_GET['texto'])) {
  header("Location: ./index.php");
} else {
  if ($_GET['texto'] == "") {
    header("Location: ./index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

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
          <div class="col-md-9 order-2">
            <div class="float-md-left mb-4">
              <h2 class="text-black h5">Buscando resultados para <?php echo $_GET['texto']; ?></h2>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <?php

          $limite = 9; // productos por página
          $totalQuery = $conexion->query("select count(*) from productos 
              where serie like '%" . $_GET['texto'] . "%' or
              tipo like '%" . $_GET['texto'] . "%' or
              descripcion like '%" . $_GET['texto'] . "%'") or die($conexion->error);
          $totalProductos = mysqli_fetch_row($totalQuery);
          $totalBotones = floor($totalProductos[0] / $limite);
/*  echo "------";
echo $_GET['texto'];
echo $totalProductos[0];
echo "/";
echo $totalBotones; */ 
          if (isset($_GET['limite'])) {
            $resultado = $conexion->query("select * from productos 
                    where serie like '%" . $_GET['texto'] . "%' or
                    tipo like '%" . $_GET['texto'] . "%' or
                    descripcion like '%" . $_GET['texto'] . "%'
                    order by tipo,codigo limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
          } else {
            // $resultado = $conexion->query("select * from productos where inventario>0 order by id DESC limit " . $limite) or die($conexion->error);
            $resultado = $conexion->query("select * from productos 
                    where serie like '%" . $_GET['texto'] . "%' or
                    tipo like '%" . $_GET['texto'] . "%' or
                    descripcion like '%" . $_GET['texto'] . "%'
                    order by tipo,codigo  limit " . $limite) or die($conexion->error);
          }

          if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_array($resultado)) {
          ?>
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id=<?php echo $fila["id"]; ?>">
                      <img src="images/<?php echo $fila["imagen"]; ?>" alt="<?php echo $fila["codigo"]; ?>" class="img-fluid w-75 m-3"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id=<?php echo $fila["id"]; ?>"><?php echo $fila["codigo"]; ?></a></h3>
                    <p class="mb-0"><?php echo $fila["tipo"]; ?></p>
                    <p class="mb-0"><?php echo substr($fila["descripcion"], 0, 50) . "..."; ?></p>
                    <p class="mb-0"><?php echo $fila["serie"] ?></p>
                  </div>
                </div>
              </div>
          <?php
            }
          } else {
            echo '<h2>Sin resultados</h2>';
          }
          ?>


        </div>
        <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>

                <?php
                if (isset($_GET['limite'])) { // si se pasa por parametro desde
                  if ($_GET['limite'] > 0) { // si no empieza al principio, para ir anterior
                    echo '<li><a href="busqueda.php?texto='. $_GET['texto'] .'&limite=' . ($_GET['limite'] - $limite) . '">&lt;</a></li>';
                  }
                }
                for ($k = 0; $k < $totalBotones; $k++) { // ponemos botones calculados
                  echo '<li><a href="busqueda.php?texto='. $_GET['texto'] .'&limite=' . ($k * $limite) . '">' . ($k + 1) . '</a></li>';
                }
                if (isset($_GET['limite'])) { //si se pasa por parametro desde
                  if (($_GET['limite'] + $limite) <= ($totalBotones * $limite)) {// mostramos siguiente si desde+9<botones*9
                    echo '<li><a href="busqueda.php?texto='. $_GET['texto'] .'&limite=' . ($_GET['limite'] + $limite) . '">&gt;</a></li>';
                  }
                } elseif($totalBotones > 0) {
                  echo '<li><a href="busqueda.php?texto='. $_GET['texto'] .'&limite='.$limite.'">&gt;</a></li>';
                }
                ?>
              </ul>
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
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>