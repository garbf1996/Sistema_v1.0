
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />      
    <link rel="stylesheet" href="css/bootstrap.min.css">  
	<link rel="stylesheet" href="css/estilos.css">




<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Sistema</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
          <?php
          //validando el tipos de usuario
              if($_SESSION['idrol'] ==1 || $_SESSION['idrol']==2){
                ?>
               <a class="nav-link" href="ventas.php">Ventas</a>
              <?php } ?>
          </li>
          </li>
          <li class="nav-item">
          <?php
              if($_SESSION['idrol'] ==1 || $_SESSION['idrol']==2){
                ?>
               <a class="nav-link" href="list_ventas.php">Lista de ventas</a>
              <?php } ?>
          </li>
          <li class="nav-item">
          <?php
              if($_SESSION['idrol'] ==1 || $_SESSION['idrol']==2){
                ?>
               <a class="nav-link" href="registrar_cliente.php">Nuevo Clientes</a>
              <?php } ?>
          </li>
          <?php
              if($_SESSION['idrol'] ==1 || $_SESSION['idrol'] ==3 ){
                ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Mantenimiento
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="registro_producto.php">Producto</a>
              <a class="dropdown-item" href="registro_proveedor.php">Proveedor</a>
              <?php
              if($_SESSION['idrol'] ==1 ){
                ?>
                <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="usuario.php">Usuario</a>
               <?php } ?>
            </div>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link " href="#">Contactos</a>
          </li>

        </ul>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <a href="salir.php"><button type="button"  class="btn btn-outline-danger">Salirr</button></a>
    </form>
      </div>
    </nav> 