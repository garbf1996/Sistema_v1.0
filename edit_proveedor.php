<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>
<?php
include "conexion.php";
?>

<?php
include "conexion.php";
if(!empty($_POST)){
$alesrt='';
if(empty($_POST['proveedor'])||empty($_POST['sector_comercial'])||empty($_POST['telefono']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

   $idproveedor= $_POST['id'];
   $proveedor = $_POST["proveedor"];
   $sector_comercial = $_POST["sector_comercial"];
   $documentos = $_POST["documentos"];
   $correo = $_POST["correo"];
   $URL = $_POST["URL"];
   $dirrecion = $_POST["dirrecion"];
   $ciudad= $_POST["ciudad"];
   $telefono = $_POST["telefono"];



 
   $sql_update = mysqli_query($conection, "UPDATE proveedor
   SET proveedor='$proveedor',sector_comercial='$sector_comercial',documentos=$documentos,correo='$correo',URL='$URL', dirrecion='$dirrecion',ciudad='$ciudad',telefono = '$telefono'
   WHERE idproveedor = $idproveedor");
 
   if($sql_update){
     $alesrt = '<h1><p class="alert-success" role="alert">Cliente Actualizado</p></h1>';
   }else{
     $alesrt = '<h2><p class="alert alert-danger" role="alert">No fue imposible actualizar el cliente</p></h2>';
   }
}
mysqli_close($conection);
}


//Mostrar datos
if(empty($_REQUEST['id'])){
  header("Location: list_proveedor.php");
  mysqli_close($conection);
}
//
$idproveedor= $_REQUEST['id'];
$sql = mysqli_query($conection,"SELECT * From proveedor WHERE idproveedor = $idproveedor");
$result_sql = mysqli_num_rows($sql);
mysqli_close($conection);
if($result_sql == 0){
  header("Location: list_proveedor.php");

}else{
$option = '';
  while($data = mysqli_fetch_array($sql)){
  $idproveedor=$data["idproveedor"];
  $proveedor = $data["proveedor"];
  $sector_comercial = $data ["sector_comercial"];
  $documentos = $data["documentos"];
  $correo = $data["correo"];
  $URL= $data["URL"];
  $dirrecion = $data["dirrecion"];
  $ciudad= $data["ciudad"];
  $telefono= $data["telefono"];



  
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
  </head>
  <body>      
    <div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
        <div class="card-header text-center"> <h1>Actualizar Proveedor </h1></div>
        <div class="card-body col-md-12">
        <br>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="registro_proveedor.php">Nuevo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list_proveedor.php">Consulta</a>
              </li>
            </ul>
           <br>


            <!--Grupo 1-->   
            <form id="" action="" method="POST" onsubmit="return validar();">
            <input type="hidden" name="id" value="<?php echo $idproveedor?>">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" placeholder="proveedor" name="proveedor" value="<?php echo $proveedor ?>">
              </div>
            
               
              <div class="form-group col-md-6">
                <label for="sector_comercial">Sector comercial</label>
                <input type="text" class="form-control" id="sector_comercial" placeholder="Sector comercial" name="sector_comercial"  value="<?php echo $sector_comercial ?>">
              </div>


            
              <div class="form-group col-md-6">
                <label for="numdocumentos">Documentos</label>
                <input type="text" class="form-control" id="numdocumentos" placeholder="Documentos" name="documentos"  value="<?php echo $documentos ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="correo">Gmail</label>
                <input type="text" class="form-control" id="correo" placeholder="Gmail" name="correo"  value="<?php echo $correo ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="URL">URL</label>
                <input type="text" class="form-control" id="URL" placeholder="URL" name="URL"  value="<?php echo $URL ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="dirrecion">Dirrecion</label>
                <input type="text" class="form-control" id="dirrecion" placeholder="dirrecion" name="dirrecion"  value="<?php echo $dirrecion ?>">
              </div>


            
              <div class="form-group col-md-6">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad"  value="<?php echo $ciudad ?>">
              </div>


              <div class="form-group col-md-6">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono"  value="<?php echo $telefono ?>">
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
    <script src="js/app.js"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>