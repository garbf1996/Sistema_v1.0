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
  $foto = $_FILES['foto'];
  $nombre_foto = $foto['name'];
  $typr = $foto['type'];
  $url_temp = $foto['tmp_name'];
  $nombreProducto = 'img_producto.jpg';
  
if($nombre_foto !=''){
  $distino = 'img/uploads/';
  $img_nombre = 'img_'.md5(date('d-m-y h:m:s'));
  $nombreProducto = $img_nombre.'.jpg';
  $src = $distino.$nombreProducto;
}



    $query_insert = mysqli_query($conection,"INSERT INTO  producto (nombre,modelos,ser_no,categoria,proveedor,precio,existencia,foto,idusuario)
    VALUES(' $nombre','$modelos','$ser_no',' $categoria','$proveedor','$precio','$existencia','$nombreProducto','$idusuario')");

        if($query_insert){

          if($nombre_foto != ''){
            move_uploaded_file($url_temp,$src);
          }
        
          $alesrt = '<h2><p class="alert alert-success" role="alert">Productos registrados</p></h2>';

        }else{
          $alesrt ='</h2><p class="alert alert-danger" role="alert">No fue imposible de registra el Productos</p></h2>';
        }
   }
}

?>


<?php
include "conexion.php";
include "funtion.php";
?>

<!doctype html>
<html lang="en">
  <head>
  <?php
  include "nav.php";
  ?>
    <title>Sistemas</title> 
    <link rel="stylesheet" href="estilos.css">  
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
                 <label for="proveedor">proveedor</label>
                 <select name="proveedor" id="proveedor" class="form-control">
                <?php
                if($resultado_proveedor > 0){
                  while($proveedor = mysqli_fetch_array($query_proveedor) ){
                    ?>
                     <option value="<?php echo $proveedor['idproveedor']?>"><?php echo $proveedor['proveedor']?><option>
                    
                  <?php
                  }
                }
                ?>
               </select>
              </div>

              <div class="form-group col-md-6">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" id="precio" placeholder="Precio" name="precio">
              </div>


              <div class="form-group col-md-6">
                <label for="existencia">Existencia</label>
                <input type="text" class="form-control" id="existencia" placeholder="existencia" name="existencia">
              </div> 
<div class="photo">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto notBlock">X</span>
        <label for="foto"></label>
        </div>
        <div class="upimg">
        <input type="file" name="foto" id="foto">
        </div>
        <div id="form_alert"></div>
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