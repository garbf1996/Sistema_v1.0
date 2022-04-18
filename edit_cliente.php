<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}else if($_SESSION['idrol'] !=1){
  header('Location: /SISTEMA_V1.0/');
}
?>


<?php
include "funtion.php";
?>



<?php
include "conexion.php";
if(!empty($_POST)){
$alesrt='';
if(empty($_POST['nombre'])||empty($_POST['apellido'])||empty($_POST['correo'])||empty($_POST['dirrecion'])||empty($_POST['ciudad'])||empty($_POST['movil']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

   $idcliente= $_POST['id'];
   $nombre = $_POST["nombre"];
   $apellido = $_POST["apellido"];
   $documentos = $_POST["documentos"];
   $correo = $_POST["correo"];
   $dirrecion = $_POST["dirrecion"];
   $ciudad = $_POST["ciudad"];
   $movil = $_POST["movil"];

   $result = 0;

   if(is_numeric($documentos) and $documentos !=0){
    $query = mysqli_query($conection,"SELECT * FROM cliente WHERE ( documentos = '$documentos' AND idcliente != $idcliente)");
    $result = mysqli_fetch_array($query);
    $result = count ($result);
   }
if($result > 0){
  echo '<h2><p class="alert alert-danger" role="alert">Este cliente esta registrado</p></h2>';
}else{
  if($documentos == ''){
    $documentos = 0;
  }
  $sql_update = mysqli_query($conection, "UPDATE cliente
  SET nombre='$nombre',apellido='$apellido',documentos=$documentos,correo='$correo', dirrecion='$dirrecion',ciudad='$ciudad'
  WHERE idcliente = $idcliente");

  if($sql_update){
    $alesrt = '<h1><p class="alert-success" role="alert">Cliente Actualizado</p></h1>';
  }else{
    $alesrt = '<h2><p class="alert alert-danger" role="alert">No fue imposible actualizar el cliente</p></h2>';
  }

}

}
mysqli_close($conection);
}


//Mostrar datos
if(empty($_GET['id'])){
  header("Location: list_cliente.php");
  mysqli_close($conection);
}
//
$idcliente= $_GET['id'];
$sql = mysqli_query($conection,"SELECT * From cliente WHERE idcliente = $idcliente");
$result_sql = mysqli_num_rows($sql);
mysqli_close($conection);
if($result_sql == 0){
  header("Location: list_cliente.php");

}else{
$option = '';
  while($data = mysqli_fetch_array($sql)){
  $idcliente=$data["idcliente"];
  $nombre = $data["nombre"];
  $apellido =  $data["apellido"];
  $documentos = $data["documentos"];
  $correo = $data["correo"];
  $dirrecion = $data["dirrecion"];
  $ciudad= $data["ciudad"];
  $movil= $data["movil"];



  
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
  
<!--Formulario-->

<div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
        <div class="card-header text-center"> <h1>Actualizar Cliente </h1></div>
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
              <input type="hidden" name="id" value="<?php echo $idcliente; ?>">

            <div class="form-group col-md-6">
                <label for="nombre">Mombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre"  value="<?php echo $nombre; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="apellido" name="apellido"value="<?php echo $apellido; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="documentos">Documentos</label>
                <input type="text" class="form-control" id="documentos" placeholder="Documentos" name="documentos" value="<?php echo $documentos; ?>">
              </div>

               
              <div class="form-group col-md-6">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" id="correo" placeholder="correo" name="correo" value="<?php echo $correo; ?>">
              </div>

              <div class="form-group col-md-12">
              <label for="dirrecion">Dirreción</label>
              <input type="text" class="form-control" id="dirrecion" placeholder="Dirreción" name="dirrecion" value="<?php echo $dirrecion; ?>">
            </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-6">
                  <label for="ciudad">Ciudad</label>
                  <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad" value="<?php echo $ciudad; ?>">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="contactos">Contactos</label>
                  <input type="text" class="form-control" id="contactos" placeholder="contactos" name="movil" value="<?php echo $movil; ?>">
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
   
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>