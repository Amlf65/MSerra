<?php

session_start();
if (!isset($_SESSION['ingreso'])) 
{
    header("location: login.php");
}
/*   session_start();
  
  if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  if($arregloUsuario['nivel']!='admin'){
    header('Location: ../index.php');
  } */
include "../php/conexion.php";
/* $resultado = $conexion->query(
  "select productos.*, colores.color from
    productos inner join colores on id_colores=id_tabla
    order by productos.id DESC"
) or die("$conexion->error"); */
$resultado = $conexion->query(
  "select * from
    productos
    order by productos.id DESC"
) or die("$conexion->error");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administración</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.min.css">
  <!-- Icono-->
  <link rel="icon" type="image/svg+xml" href="dist/img/serra.png" sizes="any">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php
      include "./layouts/header.php";
    ?>

    <img src="dist/img/fondo.png" class="w-100" alt="">
    <?php // include "./layouts/footer.php" ?>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="./plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="./plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="./plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="./plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="./plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="./dist/js/pages/dashboard.js"></script>

  <script>
    $(document).ready(function() {
      var idEliminar=-1;
      var idEditar=-1;
      var fila;
      $(".btnEliminar").click(function() {
        idEliminar=$(this).data('id');
        fila=$(this).parent('td').parent('tr');
      });
      $(".eliminar").click(function() {
        $.ajax({
          url:'../php/eliminarProducto.php',
          method: 'POST',
          data:{
            id:idEliminar
          }
        }).done(function(res){
          alert(res);
          $(fila).fadeOut(1000);
        });
      });
      $(".btnEditar").click(function() {
        var idEditar=$(this).data('id');
        var nombre=$(this).data('nombre');
        var descripcion=$(this).data('descripcion');
        var serie=$(this).data('serie');
        var precio=$(this).data('precio');
        var inventario=$(this).data('inventario');

        $("#nombreEdit").val(nombre);
        $("#descripcionEdit").val(descripcion);
        $("#serieEdit").val(serie);
        $("#precioEdit").val(precio);
        $("#inventarioEdit").val(inventario);
        $("#idEdit").val(idEditar);

      })
    });

  </script>
</body>

</html>