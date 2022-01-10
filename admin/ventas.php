<?php
session_start();
if (!isset($_SESSION['ingreso'])) 
{
    header("location: login.php");
}
include "../php/conexion.php";

$resultado = $conexion->query(
  "SELECT id, usuario, departamento, fecha
  FROM  ventas order by id"
) or die("$conexion->error");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adm-Pedidos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- Icono-->
  <link rel="icon" type="image/svg+xml" href="dist/img/serra.png" sizes="any">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper ">

    <?php
      include "./layouts/header.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pedidos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <table class="table table-hover table-responsive-sm ">
            <thead>
              <tr>
                <th>Nº.</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                 $lvta="";
/*                $ltot=0; */
                while ($f = mysqli_fetch_array($resultado)) {
                    ?> 
                  <td><?php echo $f['id']; ?></td>
                  <td><?php echo $f['fecha']; ?></td>
                  <td><?php echo $f['usuario']; ?></td>
                  <td><?php echo $f['departamento']; ?></td>
                  <td>
                    </button>
                    <button class="btn btn-danger btn-small btnEliminar" 
                    data-id="<?php echo $f['id']; ?>" 
                    data-toggle="modal" data-target="#modalEliminar">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                 
              </tr>
              <?php
                // $ltot=$ltot+$f['subtotal'];
                }
              ?>
             <!-- <tr><td colspan="5"></td><td align="right"><?php echo $ltot;?></td> -->
             <td>
                
             </td>
             </tr>

            </tbody>
          </table>
        </div>
      </section>
      <!-- /.content -->
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarLabel">Eliminar venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ¿Desea eliminar la venta (se eliminarán también los pedidos correspondientes)?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src=plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

  <script>
    $(document).ready(function() {
      var idImprimir=-1;

      $(".btnEliminar").click(function() {
        idEliminar=$(this).data('id');
        fila=$(this).parent('td').parent('tr');
      });
      $(".eliminar").click(function() {
        $.ajax({
          url:'../php/eliminarVenta.php',
          method: 'POST',
          data:{
            id:idEliminar
          }
        }).done(function(res){
          $(fila).fadeOut(1000);
        });
      });
  
      $(".btnImprimir").click(function() {
            var idImprimir=$(this).data('id');
            //var printContents = document.getElementById(divName).innerHTML;
            var document_html = window.open("_blank","visible=none");
             document_html.document.write( "<html><head><title></title>" );
             document_html.document.write( "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" type=\"text/css\"/>" );
             document_html.document.write( "<link rel=\"stylesheet\" href=\"https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css\" type=\"text/css\"/>" );
             document_html.document.write( "</head><body>" );
             document_html.document.write( "<?php echo 'Imprimir desde php' ?>" );
             document_html.document.write( "prueba de impresion"+ idImprimir );
             document_html.document.write( "</body></html>" );
             document_html.print();
             //setTimeout(function () {
                   document_html.close();
             //  }, 500)
            
      });   
    });

  </script>
</body>

</html>