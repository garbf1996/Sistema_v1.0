<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}else if($_SESSION['idrol'] !=1){
  header('Location: /SISTEMA_V1.0/');
}
?>



<?php
include "conexion.php";
if(!empty($_POST)){

  if(  $idusuario= $_POST['idusuario']==1){
    header("location: list_usuario.php");
    mysqli_close($conection);
    exit;
  }

  $idusuario= $_POST['idusuario'];
  // $query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario = $idusuario");
 $query_delete = mysqli_query($conection,"UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario");
 mysqli_close($conection);
  if($query_delete){
    header("location: list_usuario.php");
    mysqli_close($conection);
  }else{
    echo "error";
  }

}

if(empty($_REQUEST['id'])||empty($_REQUEST['id'])==1){

header("location: list_usuario.php");

}else{


$idusuario = $_REQUEST['id'];

$query = mysqli_query($conection,"SELECT u.nombre,u.usuario,r.rol FROM usuario u INNER JOIN rol r on u.idrol = r.idrol WHERE u.idusuario=$idusuario");
mysqli_close($conection);
$result = mysqli_num_rows($query);

if($result > 0){

while($data = mysqli_fetch_array($query)){
$nombre = $data['nombre'];
$usuario = $data['usuario'];
$rol = $data['rol'];

}

}else{

    header("location: list_usuario.php");
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
 <br>
<div class="m-0 vh-100 row justify-content-center align-itms-center">
<section class="contiarner">
<div class="card shadow-lg" style="width:  30rem;">
  <div class="card-body text-center">
    <h2 class=" card-header  card-title">¿Está seguro quiere eliminar este usuario?</h2>
    <br>
<p class=" h5 font-weight-bold">Nombre: <span class="text-primary"><?php echo $nombre ?></span></p>
<p class=" h5 font-weight-bold" >Usuario: <span class="text-primary"><?php echo $usuario ?></span></p>
<p class=" h5 font-weight-bold">Accesos: <span class="text-primary"><?php echo $rol ?></span></p>
<br>
<form method="POST" action="">
  <input type="hidden" name="idusuario" value="<?php echo $idusuario?>">
<button type="submit" class="btn btn-success" id="btnGuadar">Aceptar</button>
<a href="list_usuario.php"><button type="submit" class="btn btn-danger" id="btnGuadar" value=" salier">Cancelar</button></a>
</form>
    </div>
    </div>
    </section>
      </div>
<script src="js/app.js"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>