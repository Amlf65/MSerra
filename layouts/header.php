<header class="site-navbar" role="banner">
  <div class="site-navbar-top">
    <div class="container">
      <div class="row align-items-center">

      <div class="col-12 col-md-4 order-2 order-md-1 site-search-icon text-left">
          <form action="./busqueda.php" class="site-block-top-search" method="GET">
            <span class="icon icon-search2"></span>
            <input type="text" class="form-control border-0 h4" placeholder="Buscar..." name="texto">
          </form>
         <!--  <form action="" class="site-block-top-search" method="GET">
            <input type="text" class="form-control border-0 h4" placeholder="Ordenar..." name="orden"> 
            <select name="orden" placeholder="Ordernar...">
            <option value="codigo">Código</option>
            <option value="descripcion">Descripción</option>
            <option value="tipo">Tipo</option>
            <option value="serie">Serie</option>
          </select> 
          <button type="submit">>></button>
          </form>-->
        </div>

        <div class="col-12 col-md-4 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
          <a href="index.php"><img src="images/martinez-serra.png" class="w-100" alt="martinez-serra.png"></a>
        </div>

        <div class="col-12 col-md-4 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-right">
          <a href="cart.php" class="site-cart">
            <span class="icon icon-shopping_cart"></span>
            <span class="count">
              <?php
              if (isset($_SESSION['carrito'])) {
                echo count($_SESSION['carrito']);
              } else {
                echo 0;
              }
              ?>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</header>