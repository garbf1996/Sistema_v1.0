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

  if(empty($_POST['nofactura'])){
    header("location: list_ventas.php");
    mysqli_close($conection);
  }

$no_nofactura= $_POST['nofactura'];
// $query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario = $idusuario");
 $query_delete = mysqli_query($conection,"CALL anular_factura($no_nofactura)");
 mysqli_close($conection);
  if($query_delete){
    header("location: list_ventas.php");
    mysqli_close($conection);
  }else{
    echo "error";
  }

}

if(empty($_REQUEST['id'])){

header("location:  list_ventas.php");

}else{


$no_nofactura = $_REQUEST['id'];

$query = mysqli_query($conection,"SELECT * FROM factura  WHERE nofactura = $no_nofactura");
mysqli_close($conection);
$result = mysqli_num_rows($query);

if($result > 0){

while($data = mysqli_fetch_array($query)){
    $no_nofactura = $data["nofactura"];
}

}else{

    header("location: list_ventas.php");
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
    <h2 class=" card-header  card-title">¿Está seguro quiere eliminar este Producto?</h2>
    <br>
<p class=" h5 font-weight-bold">Nombre: <span class="text-primary"><?php echo $no_nofactura ?></span></p>


<br>
<form method="POST" action="">
  <input type="hidden" name="nofactura" value="<?php echo $no_nofactura;?>">
<button type="submit" class="btn btn-success" id="btnGuadar">Aceptar</button>
<a href="list_ventas.php"><button type="submit" class="btn btn-danger" id="btnGuadar" value=" salier">Cancelar</button></a>
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