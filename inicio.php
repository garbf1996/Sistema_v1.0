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
 <form action="" method="POST" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct(); ">
    <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <img src="icono/caja.png"> Agragar Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <input type="hidden" name="producto_id" id="producto_id" require>
     <input type="hidden" name="action" id="addProduct" require>
     <div class="form-group">
     <input type="number" name="cantidad" id="textcantidad" class="form-control" placeholder="Cantidad del producto" require>
     </div>
     <div class="form-group">
     <input type="text" name="precio" id="txtprecio" class="form-control" placeholder="Precio del producto" require>
     </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-primary col-md-12">Guadar</button></a>
      </div>
    </div>
  </div>
      </form>
    <script type="text/javascript" src="funcio.js"></script> 
    <script src="jquery/jquery-3.6.0.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>