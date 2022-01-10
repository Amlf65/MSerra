<?php
//si es necesario cambiar la config. del php.ini desde tu script
ini_set("session.use_only_cookies","1");
ini_set("session.use_trans_sid","0");
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Icono-->
  <link rel="icon" type="image/svg+xml" href="dist/img/serra.png" sizes="any">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Administración</b>
  </div>

  <div class="card rounded">
    <div class="card-body login-card-body m-3">


      <form role="form">
        <div class="input-group mb-3">
          <input id="user" type="text" class="form-control" placeholder="Usuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              
            </div>
          </div>

          <div class="col-4">
            <button id="btn_confirmar" type="submit" class="btn btn-primary btn-block mt-4">Entrar</button>
          </div>

        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  
  $("#btn_confirmar").on("click", function() {
    var user = $('#user').val();
    var password = $('#password').val();
    $.ajax({
        url: 'accesoUsuario.php',
        type: 'POST',
        data: 'user=' + user + '&password=' + password
    }).done(function(resp) {
      //alert(resp);
       
        if (resp == 'adm') {
          location.href = 'index.php';
        } else if (resp == 'usr' || resp == 'inv') {
          location.href = '../index.php';
        } else {
          location.href = 'login.php';
        }
        setTimeout(function() {
          $_SESSION['ingreso']=$("#user").val();
          $("#user").val('');
          $("#password").val('');
        }, 1000);
    });
  });
</script>
</body>
</html>