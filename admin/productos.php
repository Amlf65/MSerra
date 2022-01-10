<?php
session_start();
if (!isset($_SESSION['ingreso'])) 
{
    header("location: login.php");
}

include "../php/conexion.php";

$resultado = $conexion->query(
  "select * from
    productos
    order by codigo"
) or die("$conexion->error");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adm-Productos</title>

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
  <div class="wrapper">

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
              <h1 class="m-0">Productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Insertar Producto
              </button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          if (isset($_GET['error'])) {

          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $_GET['error']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
          }
          ?>

          <?php
          if (isset($_GET['success'])) {

          ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              El registro se ha insertado correctamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
          }
          if (isset($_GET['success2'])) {

            ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                El registro se ha actualizado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
            }
          ?>


          <table class="table table-hover table-responsive-sm">
            <thead>
              <tr>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                while ($f = mysqli_fetch_array($resultado)) {
                ?>
                  <td>
                    <img src="../images/<?php echo $f['imagen']; ?>" width="50px" alt="<?php echo $f['imagen']; ?>">
                  </td>
                  <td><?php echo $f['codigo']; ?></td>
                  <td><?php echo $f['descripcion']; ?></td>
                  <td>
                 
                    <button class="btn btn-primary btn-small btnEditar" 
                    data-id="<?php echo $f['id']; ?>" 
                    data-codigo="<?php echo $f['codigo']; ?>" 
                    data-descripcion="<?php echo $f['descripcion']; ?>" 
                    data-serie="<?php echo $f['serie']; ?>" 
                    data-tipo="<?php echo $f['tipo']; ?>" 
                    data-imagen="<?php echo $f['imagen']; ?>" 

                    data-laminado="<?php echo $f['laminado']; ?>" 
                    data-estructura="<?php echo $f['estructura']; ?>" 
                    data-tapizado="<?php echo $f['tapizados']; ?>" 
                    data-slaminado="<?php echo $f['sel_laminado']; ?>" 
                    data-sestructura="<?php echo $f['sel_estructura']; ?>" 
                    data-stapizado="<?php echo $f['sel_tapizado']; ?>" 

                    data-toggle="modal" data-target="#modalEditar">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-small btnEliminar" 
                    data-id="<?php echo $f['id']; ?>" 
                    data-toggle="modal" data-target="#modalEliminar">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
              </tr>
            <?php
                }
            ?>
            </tbody>
          </table>
        </div>
      </section>
      <!-- /.content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="../php/insertarProducto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Insertar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                
                <label for="nombre">Código</label>
                <input type="text" name="codigo" id="nombre" placeholder="nombre" class="form-control" required><br/>
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="Descripcion" placeholder="Descripción" class="form-control" required><br/>
                <label for="imagen">Imagen</label><br/>  
                <input type="file" name="imagen" id="imagen" placeholder="Imagen" required><br/><br/>
                <label for="serie">Serie</label>
                <input type="text" name="serie" id="serie" placeholder="Serie" class="form-control" required><br/>
                <label for="tipo">Categorías </label>
                <select name="tipo" id="tipo" class="form-control" required><br/><br/>
                  <?php 
                    $opciones = $conexion->query("select id, descripcion from categorias");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['descripcion']." </option>";
                      }
                  ?>        
                </select>
                
                <fieldset class="border border-secondary text-secondary px-3 py-3 mt-3">
                  <input type="checkbox"  name="laminado" id="laminado" onchange="show1()" />
                  <label for="laminado"> Acabado laminado</label><br>
                  <select name="tipoA" id="tipoA"  class="form-control d-none" ><br/>
                  <?php 
                    $opciones = $conexion->query("select distinct serie from extras where tipo='Laminado' order by serie");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['descripcion']." </option>";
                      }
                  ?>   
                  </select>
                  <input type="checkbox"  name="estructura" id="estructura" onchange="show2()" />
                  <label for="estructura"> Acabado estructura</label><br>
                  <select name="tipoB" id="tipoB" class="form-control d-none" ><br/>
                  <?php 
                    $opciones = $conexion->query("select distinct serie from extras where tipo='Estructura' order by serie");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['nombre']." </option>";
                      }
                  ?>       
                  </select>
                  <input type="checkbox"  name="tapizado" id="tapizado" onchange="show3()" />
                  <label for="tapizado"> Tapizado</label><br>
                  <select name="tipoC" id="tipoC"  class="form-control d-none" ><br/>
                  <?php 
                    $opciones = $conexion->query("select distinct serie from extras where tipo='Tapizado' order by serie");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['descripcion']." </option>";
                      }
                  ?>   
                  </select>
                </fieldset>

              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="../php/editarProducto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="idEdit" name="id">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            >
                <label for="codigoEdit">Código</label>
                <input type="text" name="codigo" id="codigoEdit" placeholder="nombre" class="form-control" required><br/>
                <label for="descripcionEdit">Descripción</label>
                <input type="text" name="descripcion" id="descripcionEdit" placeholder="Descripción" class="form-control" required><br/>
                <label for="imagenEdit">Imagen</label><br/>  
                <input type="file" name="imagen" id="imagenEdit" placeholder="Imagen"><br/><br/>
                <label for="serieEdit">Serie</label>
                <input type="text" name="serie" id="serieEdit" placeholder="Serie" class="form-control" required><br/>
                <label for="tipo">Categorías </label>
                <select name="tipo" id="tipoEdit" class="form-control" required><br/><br/>
                  <?php 
                    $opciones = $conexion->query("select id, descripcion from categorias");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['descripcion']." </option>";
                      }
                  ?>        
                </select>
                
                <fieldset class="border border-secondary text-secondary px-3 py-3 mt-3">
                  <input type="checkbox"  name="laminado" id="laminadoEdit" onchange="show1Edit()" />
                  <label for="laminadoEdit"> Acabado laminado</label><br>
                  <select name="tipoA" id="tipoAEdit"  class="form-control d-none" ><br/>
                  <?php 
                    $opciones = $conexion->query("select distinct serie from extras where tipo='Laminado'");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['serie']." </option>";
                      }
                  ?>       
                  </select>
                  <input type="checkbox"  name="estructura" id="estructuraEdit" onchange="show2Edit()" />
                  <label for="estructuraEdit"> Acabado estructura</label><br>
                  <select name="tipoB" id="tipoBEdit" class="form-control d-none" ><br/>
                  <?php 
                    $opciones = $conexion->query("select distinct serie from extras where tipo='Estructura'");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['serie']." </option>";
                      }
                  ?>       
                  </select>
                  <input type="checkbox"  name="tapizado" id="tapizadoEdit" onchange="show3Edit()" />
                  <label for="tapizadoEdit"> Tapizado</label><br>
                  <select name="tipoC" id="tipoCEdit"  class="form-control d-none" ><br/>
                    <?php 
                    $opciones = $conexion->query("select distinct serie from extras where tipo='Tapizado'");
                    while ($row = mysqli_fetch_array($opciones)){
                        echo "<option> ".$row['serie']." </option>";
                      }
                  ?>       
                  </select>
                </fieldset>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ¿Desea eliminar el producto?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
    <?php //include "./layouts/footer.php" ?>
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
          $(fila).fadeOut(1000);
        });
      });
      $(".btnEditar").click(function() {
        
        var idEditar=$(this).data('id');
        var codigo=$(this).data('codigo');
        var descripcion=$(this).data('descripcion');
        var serie=$(this).data('serie');
        var tipo=$(this).data('tipo');
        var imagen=$(this).data('imagen');

        var laminado=$(this).data('laminado');
        var estructura=$(this).data('estructura');
        var tapizado=$(this).data('tapizado');
        var slaminado=$(this).data('slaminado');
        var sestructura=$(this).data('sestructura');
        var stapizado=$(this).data('stapizado');

        $("#idEdit").val(idEditar);
        $("#codigoEdit").val(codigo);
        $("#descripcionEdit").val(descripcion);
        $("#serieEdit").val(serie);
        $("#tipoEdit").val(tipo);
        $("#imageEdit").val(imagen);
        
        if(slaminado==1){
          $("#laminadoEdit").prop("checked", true);
          $("#tipoAEdit").removeClass("d-none")
          $("#tipoAEdit").val(laminado);
        }
        if(sestructura==1){
          $("#estructuraEdit").prop("checked", true);
          $("#tipoBEdit").removeClass("d-none")
          $("#tipoBEdit").val(estructura);
        }
        if(stapizado==1){
          $("#tapizadoEdit").prop("checked", true);
          $("#tipoCEdit").removeClass("d-none")
          $("#tipoCEdit").val(tapizado);
        }

       
        
       
      })
    });

    function show1() {
      $("#tipoA").toggleClass("d-none")
    }
    function show2() {
      $("#tipoB").toggleClass("d-none")
    }
    function show3() {
      $("#tipoC").toggleClass("d-none")
    }

    
    function show1Edit() {
      $("#tipoAEdit").toggleClass("d-none")
    }
    function show2Edit() {
      $("#tipoBEdit").toggleClass("d-none")
    }
    function show3Edit() {
      $("#tipoCEdit").toggleClass("d-none")
    }

  </script>
</body>

</html>