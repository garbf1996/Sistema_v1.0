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
$alesrt='';
if(empty($_POST['nombre'])||empty($_POST['usuario'])||empty($_POST['correo'])||empty($_POST['rol']))
{
$alesrt = '<h2><p class="alert alert-danger" role="alert">Los campos no esta completos</p></h2>';
}else{

   $idUsuario = $_POST['idUsuario'];
   $nombre = $_POST['nombre'];
   $usuario = $_POST['usuario'];
   $correo = $_POST['correo'];
   $clave = $_POST['clave'];
   $rol = $_POST['rol'];

  //ejecutando query
   $query = mysqli_query($conection,"SELECT * FROM usuario 
   WHERE (usuario = '$usuario' AND idusuario != $idUsuario) OR (correo ='$correo' AND idusuario != $idUsuario)");
   $result = mysqli_fetch_array($query);
   if($result > 0){

      echo '<h2><p class="alert alert-danger" role="alert">Este usuario no esta disponible</p></h2>';
   }else{

     if(empty(['clave'])){
          $sql_update = mysqli_query($conection, "UPDATE usuario
                                                   SET nombre='$nombre',usuario='$usuario',correo='$correo', idrol='$rol'
                                                   WHERE idusuario = $idUsuario");

     }else{

      $sql_update = mysqli_query($conection, "UPDATE usuario
      SET nombre='$nombre',usuario='$usuario',clave='$clave',correo='$correo', idrol='$rol'
      WHERE idusuario = $idUsuario");
     }      

        if($sql_update){
        
         $alesrt = '<h1><p class="alert-success" role="alert">Usuario Actualizado</p></h1>';

        }else{
           $alesrt = '<h2><p class="alert alert-danger" role="alert">No fue imposible actualizar usuario</p></h2>';
        }
   }
}
mysqli_close($conection);
}
//Mostrar datos
if(empty($_REQUEST['id'])){
  mysqli_close($conection);
  header("Location: list_usuario.php");
}
$iduser = $_REQUEST['id'];
$sql = mysqli_query($conection,"SELECT u.idusuario,u.nombre,u.usuario,u.correo,u.estatus,(u.idrol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.idrol = r.idrol WHERE idusuario = $iduser");
$result_sql = mysqli_num_rows($sql);
mysqli_close($conection);
if($result_sql == 0){
  header("Location: list_usuario.php");

}else{
$option = '';
//areglos de usuario
  while($data = mysqli_fetch_array($sql)){
  $iduser = $data ['idusuario'];
  $nombre = $data ['nombre'];
  $usuario = $data ['usuario'];
  $correo = $data ['correo'];
  $estatus = $data ['estatus'];
  $idrol = $data ['idrol'];
  $rol = $data ['rol'];
// Validando el tipo de usuario
  if($idrol ==1){
  $option = '<option value"'.$idrol.'" select>'.$rol.'</option>';
  }else if($idrol==2){
    $option = '<option value"'.$idrol.'" select>'.$rol.'</option>';
  }else if ($idrol==3){
  $option = '<option value"'.$idrol.'" select>'.$rol.'</option>';
  }

  
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
    <link rel="stylesheet" href="css/estilos.css"> 
  </head>
  <body>
<!--Formulario-->

<div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
        <div class="card-header text-center"> <h1>Actualizar usuario </h1></div>
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

               <input type="hidden" name="idUsuario" value="<?php echo  $iduser;?>">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Mombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo $nombre; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="user" placeholder="Usuario" name="usuario" value="<?php echo $usuario; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="pasword ">Contraseña</label>
                <input type="password" class="form-control" id="pasword " placeholder="pasword " name="clave">
              </div>

               
              <div class="form-group col-md-6">
                <label for="correo">Gmail</label>
                <input type="text" class="form-control" id="correo" placeholder="Gmail" name="correo" value="<?php echo $correo; ?>">
              </div>
               <?php
               include "conexion.php";
                      $query_rol = mysqli_query($conection,"SELECT * FROM rol");
                      mysqli_close($conection);
                      $resultado_rol = mysqli_num_rows($query_rol);
               
               ?>

              <div class="form-group col-md-6">
                <label for="accesos">Tipos de accesos </label>
                <select id="rol" class="form-control rol opction" name="rol">
             <?php
             echo $option;
             if($resultado_rol > 0)
             {
             while($rol = mysqli_fetch_array($query_rol)){
            ?>
            <option value="<?php echo $rol["idrol"];?>"><?php echo $rol["rol"]?></option>
            <?php
             }
               }
             ?>
                </select>
            </div> 
            </div>
            <div class="alert text-center ">
                              <?php echo isset($alesrt)? $alesrt : '';?>
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