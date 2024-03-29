<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>
<?php
include "conexion.php";
$query_dash = mysqli_query($conection,"CALL data_count();");
$result_dash = mysqli_num_rows($query_dash);
if($result_dash > 0){
  $data_dash = mysqli_fetch_assoc($query_dash);
  mysqli_close($conection);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <title>Sistemas</title> 
    <link rel="stylesheet" href="estilos.css">
    <script type="text/javascript" language="javascript" src="{{url_for('static',filename='js/main.js')}}"></script>
    <link rel="stylesheet" href="estilos.css"> 
    <script src="https://kit.fontawesome.com/fdd9306a56.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <?php
   include "nav.php";
   ?>
   <br>

  <section class="contenedor">
    <div class="divContainer">
      <div>
        <h1 class="titlepanelcontrol">Panel de control</h1>
      </div>
      <div class="dashboard">
         <a href="list_usuario.php">
         <i class="fa fa-user" aria-hidden="true"></i>
           <p>
             <strong>Usuarios</strong><br>
             <span><?= $data_dash['usuario']?></span>
           </p>
         </a>
          
         <a href="list_cliente.php">
         <i class="fa-solid fa-user-group"></i>
           <p>
             <strong>Clientes</strong><br>
             <span><?= $data_dash['cliente']?></span>
           </p>
         </a>

         <a href="list_proveedor.php">
         <i class="fa-solid fa-user-tie"></i>
           <p>
             <strong>Proveedores</strong><br>
             <span><?= $data_dash['proveedor']?></span>
           </p>
         </a>

       

         <a href="list_producto.php">
         <i class="fas fa-box"></i>
           <p>
             <strong>Productos</strong><br>
             <span><?= $data_dash['producto']?></span>
           </p>
         </a>

         <a href="list_ventas.php">
         <i class="fa fa-shopping-cart" aria-hidden="true"></i>
           <p>
             <strong>Ventas</strong><br>
             <span><?= $data_dash['ventas']?></span>
           </p>
         </a>
      </div>
    </div>



  </section> 


    <script type="text/javascript" src="funcio.js"></script> 
    <script src="jquery/jquery-3.6.0.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>