<?php
  session_start();

  if (!isset($_SESSION['ingreso'])) 
  {
      header("location: ./admin/login.php");
  }
  
  //unset($_SESSION['carrito'])
  include './php/conexion.php';
  $resultado = $conexion->query(
    "select nombre, departamento, email from usuario where user='".$_SESSION['ingreso']."'"
  ) or die("$conexion->error");
  while ($f = mysqli_fetch_array($resultado)) {
    $mi_user=$f["nombre"];
    $mi_dpto=$f["departamento"];
    $mi_email=$f["email"];
  }
  
  if (isset($_POST['uds'])) {
    $uds = $_POST['uds'];
  } else {
    $uds = 1;
  }
  if (isset($_POST['laminado'])) {
    $lam = $_POST['laminado'];
  } else {
    $lam = "No";
  }
  if (isset($_POST['estructura'])) {
    $est = $_POST['estructura'];
  } else {
    $est = "No";
  }
  if (isset($_POST['tapizado'])) {
    $tap = $_POST['tapizado'];
  } else {
    $tap = "No";
  }

  if (isset($_SESSION['carrito'])) {

    //existe sesion

    if (isset($_POST['id'])) {

      //existe id
      $arreglo = $_SESSION['carrito'];
      $encontrado = false;
      $numero = 0;

      for ($i = 0; $i < count($arreglo); $i++) {
        if ($arreglo[$i]['Id'] == $_POST['id']  && $arreglo[$i]['Laminado'] == $lam && $arreglo[$i]['Estructura'] == $est && $arreglo[$i]['Tapizado'] == $tap) {
          $encontrado = true;
          $numero = $i;
        }
      }
        if ($encontrado == true) {

          $arreglo[$numero]['Cantidad'] = ($arreglo[$numero]['Cantidad'] + $uds);
          $_SESSION['carrito'] = $arreglo;
        } else {

          $codigo = "";
          $descripcion = "";
          $imagen = "";
          $res = $conexion->query('select * from productos where id=' . $_POST['id']) or die($conexion->error);
          $fila = mysqli_fetch_row($res);
          $codigo = $fila[1];
          $descripcion = $fila[2];
          $imagen = $fila[5];
          $arregloNuevo = array(
            'Id' => $_POST['id'],
            'Codigo' => $codigo,
            'Descripcion' => $descripcion,
            'Imagen' => $imagen,
            'Cantidad' => $uds,
            'Laminado' => $lam,
            'Estructura' => $est,
            'Tapizado' => $tap
          );
          array_push($arreglo, $arregloNuevo);
          $_SESSION['carrito'] = $arreglo;
        }
      }
    } else {
      if (isset($_POST['id'])) {

        $nombre = "";
        $precio = "";
        $imagen = "";
        $res = $conexion->query('select * from productos where id=' . $_POST['id']) or die($conexion->error);
        $fila = mysqli_fetch_row($res);
        $codigo = $fila[1];
        $descripcion = $fila[2];
        $imagen = $fila[5];
        $arreglo[] = array(
          'Id' => $_POST['id'],
         'Codigo' => $codigo,
         'Descripcion' => $descripcion,
         'Imagen' => $imagen,
         'Cantidad' => $uds,
         'Laminado' => $lam,
         'Estructura' => $est,
         'Tapizado' => $tap
        );
        $_SESSION['carrito'] = $arreglo;
      }
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
          <form class="col-md-12" method="post" action="grabaPedido.php">
            <div  class="container">
              <div class="row">
                <div class="col-sm-4  col-xs-12">
                  <label for="lnombre">NOMBRE </label><br/>
                  <input class="form-control" type="text" id="lnombre" name="lnombre" value= "<?php echo $mi_user; ?>" required>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <label for="ldpto">DEPARTAMENTO </label><br/>
                  <input class="form-control" type="text" id="ldpto" name="ldpto" value="<?php echo $mi_dpto; ?>" required>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <label for="lemail">EMAIL </label><br/>
                  <input class="form-control" type="text" id="lemail" name="lemail" value="<?php echo $mi_email; ?>" required>
                </div>
              </div>
            </div> 
            <div class="site-blocks-table ">
              
              <table class="table table-bordered table-responsive mt-3">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Imagen</th>
                    <th class="product-name">Código</th>
                    <th class="product-name">Descripción</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-quantity">Laminado</th>
                    <th class="product-quantity">Estructura</th>
                    <th class="product-quantity">Tapizado</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    // $total=0;
                    if (isset($_SESSION['carrito'])) {
                      $arregloCarrito = $_SESSION['carrito'];
                      for ($i = 0; $i < count($arregloCarrito); $i++) {
                        /* $total= $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']) */
                  ?>
                      <tr>
                        <td class="product-thumbnail">
                          <img src="images/<?php echo $arregloCarrito[$i]['Imagen'] ?>" alt="<?php echo $arregloCarrito[$i]['Imagen'] ?>" class="img-fluid">
                        </td>
                        <td class="product-name">
                          <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Codigo'] ?></h2>
                        </td>
                        <td class="product-name">
                          <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Descripcion'] ?></h2>
                        <td>
                          <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Cantidad'] ?>
                        </td>
                        </h2>

                        <td class="product-name">
                          <?php
                            if ($arregloCarrito[$i]['Laminado'] != "No") {
                          ?>
                          <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Laminado'] ?></h2>
                          <?php
                            }
                          ?>
                        </td>


                        <td class="product-name">
                          <?php
                            if ($arregloCarrito[$i]['Estructura'] != "No") {
                          ?>
                          <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Estructura'] ?></h2>
                          <?php
                            }
                          ?>
                        </td>


                        <td class="product-name">
                          <?php
                            if ($arregloCarrito[$i]['Tapizado'] != "No") {
                          ?>
                          <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Tapizado'] ?></h2>
                          <?php
                            }
                          ?>
                        </td>

                        <td><a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id']; ?>">X</a></td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
               <tfoot>
                  <tr>
                    <td colspan="8">
                        <button class="btn btn-primary btn-lg py-3 btn-block" type="submit" class="btn btn-primary btn-lg py-3 btn-block">Confirmar</button> 
                    </td>
                  </tr>
               </tfoot> 
              </table>
            </div>
          </form>
        </div>
        <!-- <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='grabaPedido.php'">Confirmar</button> 
            <button class="btn btn-primary btn-lg py-3 btn-block">Confirmar</button> 
          </div>
        </div> -->
      </div>
    </div>
    <?php include("./layouts/footer.php"); ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <!-- <script src="js/jquery-ui.js"></script> -->
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="js/owl.carousel.min.js"></script> -->
  <!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
  <!-- <script src="js/aos.js"></script> -->

  <script src="js/main.js"></script>
  <script>
    $(document).ready(function() {
      $(".btnEliminar").click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        boton = $(this);
        $.ajax({
          method: 'POST',
          url: './php/eliminarCarrito.php',
          data: {
            id: id
          }
        }).done(function(respuests) {
          boton.parent('td').parent('tr').remove();
        });
      });
      $(".txtCantidad").change(function() {
        var cantidad = $(this).val();
        var precio = $(this).data("precio");
        var id = $(this).data("id");
        incrementar(cantidad, precio, id);
      })
      $(".btnIncrementar").click(function() {
        var cantidad = $(this).parent("div").parent("div").find("input").val();
        var precio = $(this).parent("div").parent("div").find("input").data("precio");
        var id = $(this).parent("div").parent("div").find("input").data("id");
        incrementar(cantidad, precio, id);
      });
    });
  </script>
  <script>
    function confirmar() {

    }
  </script>
</body>
</html>