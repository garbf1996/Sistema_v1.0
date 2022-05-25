<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>
<?php
include "conexion.php";
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Sistemas</title> 
    <link rel="stylesheet" href="estilos.css">
    <script type="text/javascript" language="javascript" src="{{url_for('static',filename='js/main.js')}}"></script>

  </head>
  <body>
  <?php
   include "nav.php";
   ?>
   <br>
   <div class="container">
  <div class="row">
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons.flaticon.com/png/512/3171/premium/3171065.png?token=exp=1653439497~hmac=96c0f89e068f611b003924922ed5edce" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Usuario</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/3126/3126647.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Cliente</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/72/72109.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Proveedor</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/1524/1524711.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Producto</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons.flaticon.com/png/512/2516/premium/2516185.png?token=exp=1653440027~hmac=24c9b975cc38ca352efb1dad4bcd1cce" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Ventas</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
</div>
  


    <script type="text/javascript" src="funcio.js"></script> 
    <script src="jquery/jquery-3.6.0.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>