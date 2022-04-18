<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>
<?php
include "conexion.php";
include "funtion.php";
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Sistemas</title> 
    <link rel="stylesheet" href="estilos.css">  
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  </head>
  <body>
   <?php
   include "nav.php";
   ?>
 <div class="container-fluid">
<h1><span><img src="icono/punto-de-venta.png"></span>Nueva Venta</h1>
<br>
<div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
      <div class="row col-md-6">
      <div class="form-group">
               <h3 for="datos">Datos Cliente</h3>
               <a href="#" class="nuevoCliente btn btn-primary " id="nuevoCliente">Nuevo Cliente</a>
                </div>
      </div>
      <form  name="form_new_cliente_venta" id="forCliente" class="datos" onsubmit="event.preventDefault();" >
      <span class="border-top">
        <br>
        <input type="hidden" name="action" value="addCliente">
         <input type="hidden" id="idcliente" name="idcliente" value="" require>
       <div class="form-row">
       <div class="form-group col-md-3">
                <label for="nit_cliente" deisable>Documentos</label>
                <input type="text" class="form-control" name="nit_cliente" id="nit_cliente" placeholder="Documentos" name="documentos">
              </div> 

              <div class="form-group col-md-4">
                <label for="nombre">Producto</label>
                <input type="text" class="form-control" id="nom_cliente" placeholder="Nombre" name="nom_cliente" disabled>
              </div>

              <div class="form-group col-md-4">
                <label for="nombre">Apellido</label>
                <input type="text" class="form-control" id="nom_apellido" placeholder="Apellido" name="nom_apellido" disabled>
              </div>
                     
              <div class="form-group col-md-4">
                <label for="nombre">Correo</label>
                <input type="text" class="form-control" id="nom_correo" placeholder="Correo" name="nom_correo" disabled>
              </div>
              

              <div class="form-group col-md-4">
                <label for="nombre">Telefono</label>
                <input type="text" class="form-control" id="movil" placeholder="Telefono" name="movil" disabled>
              </div>

 
              
               <div class="form-group col-md-4">
                <label for="nombre">Ciudad</label>
                <input type="text" class="form-control" id="Ciudad_cliente" placeholder="Ciudad" name="Ciudad_cliente" disabled>
              </div>



          
              <div class="form-group col-md-12">
                <label for="nombre">Dirreccion</label>
                <input type="text" class="form-control" id="dir_cliente" placeholder="Dirrecion" name="dir_cliente" disabled>
              </div>
           

              <input type="submit" class="ClassName  btn btn-primary" id="ClassName ">
                </div>
            </form>
          </div>
         </div>
         <br>

      <div class="container-fluid">
      <div class="row">
      <div class="col-lg-12 col-md-6">
      <div class="card shadow-lg p-3 mb-5 bg-white ">
      <h3 for="datos">Datos ventas</h3>
      <span class="border-top">

      <div class="row">
    <div class="col-sm">
      <br>
      <h3>Usuario: <?php 
         echo $_SESSION['usuario'];
         ?></h3>
      <br>
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm-1">
      <br>
    <button type="button" class="btn btn-danger" id="btn_anular_venta" >Anular</button>
    </div>

    <div class="col-sm-3">
      <br>
    <button type="button" id="btn_detalle" class="btn btn-info" style = "display:none;">Procesar</button>
    </div>
  </div>

             
          
          


                
      </span>       
      </div>
      </div>
      </div>
      </div>
     

     <br>        
   <table class="table">
  <thead>
    <tr>
      <div class="col">
      <th scope="col" id="text_cod_producto">Código</th>
      </div>
      <th scope="col">Producto</th>
      <th scope="col">Existencia</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Precio Total</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td class="col-md-1">
    <input type="text" class="form-control" name="cod_producto" id="cod_producto" placeholder="Serial" name="serial">
    </td>
    <td>
     <p id="text_nombre"></p>
    </td>
    <td>
    <p id="text_existencia" ></p>
    </td>


    <td class="col-md-2">
    <input type="number" class="col-md-4 text_cant_producto " id="text_cant_producto" value="1" min="1" disabled> 
    </td>


   <td  class="textring">
   <p id="text_precio" ></p>
    </td>
    <td  class="textring">
    <p id="text_total" ></p>
    </td>

    <td >
    <a href="#" class=" btn btn-success " id="nuevo_producto">Agregar</a>
    </td>
    </tr>
     <tr>
    <th>Código</th>
    <th colspan="2">Producto</th>
    <th clase="textcenter">Cantidad</th>
     <th class="textringht">Precio</th>
    <th class="textringht">Precio total</th>
    <th></th>
     </tr>
  </tbody>

  <tbody id="detalle_venta">
 
  </tbody>

  <tbody id = "detalle_totales">

  </tbody>  
</table>
<script type="text/javascript">

    $(document).ready(function () {
     var usuaerioid = '<?php echo $_SESSION['idusuario'];?>';
     serchforDetalle (usuaerioid);
     });

    </script> 

       </div>
       </div>
            </div>
            
            </div>
        </div>   
    <script type="text/javascript" src="app.js"></script> 
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>  	  	
  </body>
</html>