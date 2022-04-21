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

  $id_producto = $_POST["id"];
  $nombre = $_POST["nombre"];
  $modelos = $_POST["modelos"];
  $ser_no = $_POST["ser_no"];
  $categoria = $_POST["categoria"];
  $proveedor  = $_POST["proveedor"];
  $idusuario = $_SESSION['idusuario'];




  $sql_update = mysqli_query($conection,"UPDATE producto SET nombre = '$nombre',modelos='$modelos',ser_no='$ser_no',categoria='$categoria',proveedor=$proveedor
    WHERE codproducto = $id_producto");
   
   if($sql_update){
    $alesrt = '<h1><p class="alert-success" role="alert">Cliente Actualizado</p></h1>';
  }else{
    $alesrt = '<h2><p class="alert alert-danger" role="alert">No fue imposible actualizar el cliente</p></h2>';
  }   
   }
}

if(!empty($_POST)){
  header("location: list_producto.php");
}else{
  $id_producto = $_REQUEST['id'];
  if(!is_numeric($id_producto)){
    header("location: list_producto.php");
  }
  $quety_producto = mysqli_query($conection,"SELECT p.codproducto,p.nombre,p.modelos,p.ser_no,p.categoria,pr.proveedor FROM producto p INNER JOIN proveedor pr on p.proveedor = pr.idproveedor
  WHERE p.codproducto = $id_producto AND p.estatus = 1");
  $resultado_producto = mysqli_num_rows($quety_producto);
  if($resultado_producto > 0){
    $data_producto = mysqli_fetch_array($quety_producto);
  }else{
    header("location: list_producto.php");
  }
}

?>


<?php
include "conexion.php";
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
        <div class="card-header text-center"> <h1>Actualizar Productos </h1></div>
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
            
            <input type="hidden" name="id" value="<?php echo $data_producto['codproducto']?>">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Producto</label>
                <input type="text" class="form-control" id="proveedor" placeholder="Producto" name="nombre" value="<?php echo $data_producto ['nombre'] ?>">
              </div>
            
               
              <div class="form-group col-md-6">
                <label for="modelos">Modelos</label>
                <input type="text" class="form-control" id="modelos" placeholder="Modelos" name="modelos"value="<?php echo $data_producto ['modelos'] ?>">
              </div>


            
              <div class="form-group col-md-6">
                <label for="ser_no">S/N</label>
                <input type="text" class="form-control" id="ser_no" placeholder="S/N" name="ser_no"value="<?php echo $data_producto ['ser_no'] ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" placeholder="Categoria" name="categoria" value="<?php echo $data_producto ['categoria'] ?>">
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
            </div>

          <div class="alert text-center ">
             <?php echo isset( $alesrt )?  $alesrt  : '';?>
            </div>
            <button type="submit" class="btn btn-primary" id="btnGuadar">Actualizar</button>
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