<?php
//variable para los campos vacíos
$alert = '';
//iniciar la sesión
session_start();
//verificando la sesión
if(!empty($_SESSION['active'])){
    header('location: inicio.php');
}else{


//Verificar si metodos post
if(!empty($_POST))
{
    //verificacion de los campos si esta vacío
    if(empty($_POST['usuario'])|| empty($_POST['clave'])){
        $alert = 'Ingrese su usuario y contraseña';
    }else{
        //Conexion 
        require_once "conexion.php";
        //Variable y elementos 
        $user = $_POST['usuario'];
        $pasword = $_POST['clave'];
        
        //ejecutar una consulta en la base de datos
        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$user' AND clave = '$pasword' ");
        mysqli_close($conection);
        $result = mysqli_num_rows($query);
        
        //Buscar registro en la base de datos en la tabla usuario
        if($result > 0){
            $data = mysqli_fetch_array($query);
            $_SESSION['active'] = true;
            $_SESSION['idusuario'] = $data['idusuario'];
            $_SESSION['usuario'] = $data['usuario'];
            $_SESSION['clave'] = $data['clave'];
            $_SESSION['estatus'] = $data['estatus'];
            $_SESSION['idrol'] = $data['idrol'];

            header('location: inicio.php');
        
               
        }else{
            
         $alert = 'El usuario o la contraseña son incorrectos';
         //Destruyendo la sesión si la contraseña y usuario son incorrectos 
         session_destroy();
        
        }

    
    }
}
}
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<html lang="es">
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <div class="contianer"> 
                            <div class="text-center">
                          <img src="https://us.123rf.com/450wm/123vector/123vector1803/123vector180300209/97210458-ilustraci%C3%B3n-del-icono-de-persona-sobre-fondo-blanco.jpg?ver=6" width="200px" height="200px">
                        </div> 
                            <div class="form-group">
                                <label for="usuario" class="text-info">Nombre de usuario:</label><br>
                                <input type="text" name="usuario" id="usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="clave" class="text-info">Contraseña:</label><br>
                                <input type="password" name="clave" id="clave" class="form-control">
                            <div class="alert text-center ">
                                <?php echo isset($alert)? $alert : '';?>
                            </div>
                            </div>
                            <div class="form-group">
                            <input type="submit" name="iniciar sesion" class="btn btn-info btn-md" value="Iniciar sesión">
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
