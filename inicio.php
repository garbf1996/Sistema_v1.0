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
  <img class="card-img-top" src="https://cdn-icons.flaticon.com/png/512/3161/premium/3161402.png?token=exp=1652817081~hmac=0cc8cd1e4702a17478bc325b3dc1db94" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons.flaticon.com/png/512/2143/premium/2143272.png?token=exp=1652817074~hmac=6f1f4569b14fb515684388f4e44b4341" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/72/72109.png" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
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
    <h5 class="card-title">Card title</h5>
    <p class="card-text"></p>
  </div>
</div>
    </div>
    <div class="col-4">
    <div class="card" style="width: 12rem;">
  <img class="card-img-top" src="https://cdn-icons.flaticon.com/png/512/5553/premium/5553917.png?token=exp=1652817484~hmac=02018ec02e3419243fa84b907f11d916" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
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