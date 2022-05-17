<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');

}

?>
<?php
include "conexion.php";
//Verificar si metodos post
if(!empty($_POST)){
$alesrt='';
//verificacion de los campos si esta vacío
if(empty($_POST['nombre'])||empty($_POST['usuario'])||empty($_POST['clave'])||empty($_POST['correo'])||empty($_POST['rol']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

  //variable 
   $nombre = $_POST["nombre"];
   $usuario = $_POST["usuario"];
   $clave = $_POST["clave"];
   $correo = $_POST["correo"];
   $rol = $_POST["rol"];
   
   //ejecundo ejecundo query en la tabla usuario
   $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$usuario' OR correo ='$correo'");

   //haciendo  arreglo de la tabla usuario 
   $result = mysqli_fetch_array($query);
 
   //Buscando registro
   if($result > 0){

    $alesrt ='<h2><p class="alert alert-danger" role="alert">Este usuario está registrados</p></h2>';
   }else{
     //Insertar Datos 
      $query_insert = mysqli_query($conection," CALL isertar_usuario('$nombre','$usuario',$clave,'$correo',$rol)");
         //confimaando si el usuario si exicte 
        if($query_insert){
        
          $alesrt = '<h2><p class="alert alert-success" role="alert">Usuario registrados</p></h2>';

        }else{
          $alesrt ='</h2><p class="alert alert-danger" role="alert">No fue imposible de registra el usuario</p></h2>';
        }
   }
}
//cerrando la conexion
mysqli_close($conection);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Sistemas</title>  
  </head>
  <body>
  <?php
   include "nav.php";
   ?>
 

<!--Formulario-->
<div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
        <div class="card-header text-center"> <h1>Agregar Nuevo Usuario </h1></div>
        <div class="card-body col-md-12">
        <br>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="usuario.php">Nuevo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list_usuario.php">Consulta</a>
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
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="user" placeholder="Usuario" name="usuario">
              </div>

              <div class="form-group col-md-6">
                <label for="pasword ">Contraseña</label>
                <input type="password" class="form-control" id="pasword " placeholder="pasword " name="clave">
              </div>

               
              <div class="form-group col-md-6">
                <label for="correo">Gmail</label>
                <input type="text" class="form-control" id="correo" placeholder="Gmail" name="correo">
              </div>


              <div class="form-group col-md-6">
                <label for="accesos">Tipos de accesos </label>
                <select id="rol" class="form-control" name="rol">
                  <option selected value="1">Administrador</option>
                  <option value="2">Auxiliar de ventas</option>
                  <option value="3">Almacenes</option>
                </select>
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