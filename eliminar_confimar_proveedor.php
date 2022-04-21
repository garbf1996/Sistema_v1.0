<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}else if($_SESSION['idrol'] !=1 and $_SESSION['idrol']!=3){
  header('Location: /SISTEMA_V1.0/');
}
?>



<?php
include "conexion.php";
if(!empty($_POST)){

  if(empty($_POST['idproveedor'])){
    header("location: list_proveedor.php");
    mysqli_close($conection);
  }

$idproveedor= $_POST['idproveedor'];
// $query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario = $idusuario");
 $query_delete = mysqli_query($conection,"UPDATE proveedor SET estatus = 0 WHERE idproveedor = $idproveedor");
 mysqli_close($conection);
  if($query_delete){
    header("location: list_proveedor.php");
    mysqli_close($conection);
  }else{
    echo "error";
  }

}

if(empty($_REQUEST['id'])){

header("location:  list_proveedor.php");

}else{


$idproveedor = $_REQUEST['id'];

$query = mysqli_query($conection,"SELECT * FROM proveedor  WHERE idproveedor = $idproveedor");
mysqli_close($conection);
$result = mysqli_num_rows($query);

if($result > 0){

while($data = mysqli_fetch_array($query)){
    $proveedor = $data["proveedor"];
    $documentos = $data["documentos"];
}

}else{

    header("location: list_proveedor.php");
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
    <h2 class=" card-header  card-title">¿Está seguro quiere eliminar este Proveedor?</h2>
    <br>
<p class=" h5 font-weight-bold">Proveedor: <span class="text-primary"><?php echo $proveedor ?></span></p>
<p class=" h5 font-weight-bold" >Documentos: <span class="text-primary"><?php echo $documentos ?></span></p>

<br>
<form method="POST" action="">
  <input type="hidden" name="idproveedor" value="<?php echo $idproveedor;?>">
<button type="submit" class="btn btn-success" id="btnGuadar">Aceptar</button>
<a href="list_proveedor.php"><button type="submit" class="btn btn-danger" id="btnGuadar" value=" salier">Cancelar</button></a>
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