<?php
session_start();
?>

<?php
include "conexion.php";
if(!empty($_POST)){
$alesrt='';
if(empty($_POST['nombre'])||empty($_POST['apellido'])||empty($_POST['correo'])||empty($_POST['dirrecion'])||empty($_POST['ciudad'])||empty($_POST['movil']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

  
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $documentos = $_POST["documentos"];
  $correo = $_POST["correo"];
  $dirrecion = $_POST["dirrecion"];
  $ciudad = $_POST["ciudad"];
  $movil = $_POST["movil"];
  $idusuario = $_SESSION['idusuario'];

  $result = 0;

  if(is_numeric($documentos) and $documentos !=0 ){
    $query = mysqli_query($conection,"SELECT * FROM cliente WHERE documentos = '$documentos' ");
    $result = mysqli_fetch_array($query);
  }

   if($result > 0){

    $alesrt ='<h2><p class="alert alert-danger" role="alert">Este cliente está registrados</p></h2>';
   }else{
    $query_insert = mysqli_query($conection,"INSERT INTO cliente(nombre,apellido,documentos,correo,dirrecion,ciudad,movil,idusuario )
    VALUES('$nombre','$apellido','$documentos','$correo','$dirrecion','$ciudad','$movil','$idusuario')");

        if($query_insert){
        
          $alesrt = '<h2><p class="alert alert-success" role="alert">Cliente registrados</p></h2>';

        }else{
          $alesrt ='</h2><p class="alert alert-danger" role="alert">No fue imposible de registra el usuario</p></h2>';
        }
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
        <div class="card-header text-center"> <h1>Agregar Nuevo Cliente</h1></div>
        <div class="card-body col-md-12">
        <br>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="registrar_cliente.php">Nuevo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list_cliente.php">Consulta</a>
              </li>
            </ul>
           <br>

              
          <form id="empleado-Datos" action="" method="POST" onsubmit="return validar();">
            <!--Grupo 1-->
            <div class="form-row">

            <div class="form-group col-md-6">
                <label for="nombre">Mombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
              </div>

              <div class="form-group col-md-6">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="apellido" name="apellido">
              </div>

              <div class="form-group col-md-6">
                <label for="documentos">Documentos</label>
                <input type="text" class="form-control" id="documentos" placeholder="Documentos" name="documentos">
              </div>

               
              <div class="form-group col-md-6">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" id="correo" placeholder="correo" name="correo">
              </div>

              <div class="form-group col-md-12">
              <label for="dirrecion">Dirreción</label>
              <input type="text" class="form-control" id="dirrecion" placeholder="Dirreción" name="dirrecion">
            </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                  <label for="ciudad">Ciudad</label>
                  <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="contactos">Contactos</label>
                  <input type="text" class="form-control" id="contactos" placeholder="contactos" name="movil">
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
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>