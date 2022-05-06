
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />      
    <link rel="stylesheet" href="css/bootstrap.min.css">  
	<link rel="stylesheet" href="css/estilos.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 



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
        <a href="salir.php"><button type="button"  class="btn btn-outline-danger">Salir</button></a>
    </form>
      </div>
    </nav> 

    <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="get" name="form_dele_producto" id="form_dele_producto" onsubmit="event.preventDefault(); sendDataProduct();">
         <input type="hidden" name="" id="" require>
         <input type="hidden" name="" id="" require>
          <div class="alert aletDeleproduct"><p> de acion</p></div>
         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <a href="#" class="btn_ok closeModal">Cerra</a>
        </form>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript" src="app.js"></script> 
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>  	 