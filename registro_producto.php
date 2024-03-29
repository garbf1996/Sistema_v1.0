<?php

use function PHPSTORM_META\type;

session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>

<?php
include "conexion.php";
if(!empty($_POST)){
$alesrt='';
if(empty($_POST['nombre'])||empty($_POST['modelos'])||empty($_POST['ser_no'])||empty($_POST['categoria']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

  
  $nombre = $_POST["nombre"];
  $modelos = $_POST["modelos"];
  $ser_no = $_POST["ser_no"];
  $categoria = $_POST["categoria"];
  $proveedor  = $_POST["proveedor"];
  $precio = $_POST["precio"];
  $existencia= $_POST["existencia"];
  $idusuario = $_SESSION['idusuario'];
 
    $query_insert = mysqli_query($conection,"INSERT INTO  producto (nombre,modelos,ser_no,categoria,proveedor,precio,existencia,idusuario)
    VALUES(' $nombre','$modelos','$ser_no',' $categoria','$proveedor','$precio','$existencia','$idusuario')");

        if($query_insert){

          $alesrt = '<h2><p class="alert alert-success" role="alert">Productos registrados</p></h2>';

        }else{
          $alesrt ='</h2><p class="alert alert-danger" role="alert">No fue imposible de registra el Productos</p></h2>';
        }
   }
}

?>
<!doctype html>
<html lang="en">
  <head>
  <?php
  include "nav.php";
  ?>
    <title>Sistemas</title> 
    <link rel="stylesheet" href="css/estilos.css">  
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  </head>
  <body>
  <!--Formulario-->
<div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
        <div class="card-header text-center"> <h1>Agregar Nuevo Productos </h1></div>
        <div class="card-body col-md-12">
        <br>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="registro_producto.php">Nuevo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list_producto.php">Consulta</a>
              </li>
            </ul>
           <br>

              
          <form id="empleado-Datos" action="" method="POST" onsubmit="return validar();" enctype="multipart/form-data">
            <!--Grupo 1-->
            

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Producto</label>
                <input type="text" class="form-control" id="proveedor" placeholder="Producto" name="nombre">
              </div>
            
               
              <div class="form-group col-md-6">
                <label for="modelos">Modelos</label>
                <input type="text" class="form-control" id="modelos" placeholder="Modelos" name="modelos">
              </div>


            
              <div class="form-group col-md-6">
                <label for="ser_no">S/N</label>
                <input type="text" class="form-control" id="ser_no" placeholder="S/N" name="ser_no">
              </div>

              <div class="form-group col-md-6">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" placeholder="Categoria" name="categoria">
              </div>


            
              <div class="form-group col-md-6">    
            <?php 
            $query_proveedor = mysqli_query($conection,"SELECT idproveedor,proveedor From proveedor WHERE
             estatus = 1 ORDER BY proveedor "); 
             $resultado_proveedor = mysqli_num_rows($query_proveedor);
             mysqli_close($conection);
            ?>
            
             <div class="form-group ">
                <label for="proveedor"> Proveedor</label>
                <select id="proveedor" class="form-control rol opction" name="proveedor">
             <?php
             if($resultado_proveedor > 0)
             {
             while($proveedor = mysqli_fetch_array($query_proveedor)){
            ?>
              <option value="<?php echo $proveedor['idproveedor']?>"><?php echo $proveedor['proveedor']?>
              <option>
            <?php
             }
               }
             ?>
                </select>
            </div> 
            </div>
               
              <div class="form-group col-md-6">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" id="precio" placeholder="Precio" name="precio">
              </div>


              <div class="form-group col-md-6">
                <label for="existencia">Existencia</label>
                <input type="text" class="form-control" id="existencia" placeholder="existencia" name="existencia">
              </div> 
            </div>

          <div class="alert text-center ">
             <?php echo isset( $alesrt )?  $alesrt  : '';?>
            </div>
            <button type="submit" class="btn btn-primary" id="btnGuadar">Registrar</button>
          </form>
        </div>   
    </div>
            </div>       
        </div>                  
    </div>
      
    <script type="text/javascript" src="app.js"></script> 
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>