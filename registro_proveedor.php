<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>
<?php
include "conexion.php";
if(!empty($_POST)){
$alesrt='';
if(empty($_POST['proveedor'])||empty($_POST['sector_comercial'])||empty($_POST['telefono']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

  
  $proveedor = $_POST["proveedor"];
  $sector_comercial = $_POST["sector_comercial"];
  $documentos = $_POST["documentos"];
  $correo = $_POST["correo"];
  $URL = $_POST["URL"];
  $dirrecion = $_POST["dirrecion"];
  $ciudad= $_POST["ciudad"];
  $telefono = $_POST["telefono"];
  $idusuario = $_SESSION['idusuario'];

    $query_insert = mysqli_query($conection,"INSERT INTO  proveedor (proveedor,sector_comercial,documentos,correo,URL,dirrecion,ciudad,telefono,idusuario)
    VALUES('$proveedor','$sector_comercial','$documentos','$correo','$URL','$dirrecion','$ciudad','$telefono','$idusuario')");

        if($query_insert){
        
          $alesrt = '<h2><p class="alert alert-success" role="alert">Proveedor registrados</p></h2>';

        }else{
          $alesrt ='</h2><p class="alert alert-danger" role="alert">No fue imposible de registra el proveedor</p></h2>';
        }
   }
   mysqli_close($conection);
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
  <!--Formulario-->
<div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
        <div class="card-header text-center"> <h1>Agregar Nuevo Proveedor </h1></div>
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

              
          <form id="empleado-Datos" action="" method="POST" onsubmit="return validar();">
            <!--Grupo 1-->
            

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" placeholder="proveedor" name="proveedor">
              </div>
            
               
              <div class="form-group col-md-6">
                <label for="sector_comercial">Sector comercial</label>
                <input type="text" class="form-control" id="sector_comercial" placeholder="Sector comercial" name="sector_comercial">
              </div>


            
              <div class="form-group col-md-6">
                <label for="numdocumentos">Documentos</label>
                <input type="text" class="form-control" id="numdocumentos" placeholder="Documentos" name="documentos">
              </div>

              <div class="form-group col-md-6">
                <label for="correo">Gmail</label>
                <input type="text" class="form-control" id="correo" placeholder="Gmail" name="correo">
              </div>

              <div class="form-group col-md-6">
                <label for="URL">URL</label>
                <input type="text" class="form-control" id="URL" placeholder="URL" name="URL">
              </div>

              <div class="form-group col-md-6">
                <label for="dirrecion">Dirrecion</label>
                <input type="text" class="form-control" id="dirrecion" placeholder="dirrecion" name="dirrecion">
              </div>


            
              <div class="form-group col-md-6">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad">
              </div>


              <div class="form-group col-md-6">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono">
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
    <script src="js/app.js"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>