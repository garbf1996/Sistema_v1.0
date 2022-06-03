<?php
session_start();
if(empty($_SESSION['active'])){
  header('location: ../');
}
?>
<?php
include "conexion.php";
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Sistemas</title> 
    <link rel="stylesheet" href="estilos.css">
    <script type="text/javascript" language="javascript" src="{{url_for('static',filename='js/main.js')}}"></script>
    <link rel="stylesheet" href="estilos.css"> 
    <script src="https://kit.fontawesome.com/fdd9306a56.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <?php
   include "nav.php";
   ?>
   <br>

  <section class="contenedor">
    <div class="divContainer">
      <div>
        <h1 class="titlepanelcontrol">Panel de control</h1>
      </div>
      <div class="dashboard">
         <a href="list_usuario.php">
         <i class="fa fa-user" aria-hidden="true"></i>
           <p>
             <strong>Usuarios</strong><br>
             <span>40</span>
           </p>
         </a>
          
         <a href="list_cliente.php">
         <i class="fa-solid fa-user-group"></i>
           <p>
             <strong>Clientes</strong><br>
             <span>40</span>
           </p>
         </a>

         <a href="list_proveedor.php">
         <i class="fa-solid fa-user-tie"></i>
           <p>
             <strong>Proveedores</strong><br>
             <span>40</span>
           </p>
         </a>

       

         <a href="list_producto.php">
         <i class="fas fa-box"></i>
           <p>
             <strong>Productos</strong><br>
             <span>40</span>
           </p>
         </a>

         <a href="list_ventas.php">
         <i class="fa fa-shopping-cart" aria-hidden="true"></i>
           <p>
             <strong>Ventas</strong><br>
             <span>40</span>
           </p>
         </a>
      </div>
    </div>

  <div class="">
    <div class="divContainer">
      <div>
        <h1 class="titlepanelcontrol">Configuracion</h1>
      </div>
      <div class="containerPerfil">
        <div class="containerDataUser">
         <div class="logoUser">
           <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="100">
         </div>
         <div class="divDataUser">
          <h4>Informaacion personal</h4>

          <div>
            <label>Nombre:</label> <span>Garber</span>
          </div>

          <div>
            <label>Correo:</label> <span>garbf@gamil.com</span>
          </div>
             
         <h4>Datos Usuario</h4>
         <div>
            <label>Rol:</label> <span>Admin</span>
          </div>

          <div>
            <label>Usuario:</label> <span>Garber</span>
          </div>
          <h4>Cambiar contraseña</h4>
          <form method="post" action="" name="frmChangepassword" id="frmChangepassword">
          <div>
           <input type="password" name="txtpasswordUser" id="txtpasswordUser" placeholder="Contraseña actual" value="" required>
            </div>
              <br>
            <div>
             <input type="password" name="txtpasswordnew" id="txtpasswordnew" placeholder="Nuevo contraseña" value="" required>
            </div>
            <br>
            <div>
              <button type="submit" name="tbn_save" id="tbn_save"><i class="fa fa-key"></i>Cambiar Contraseña</button>
             </div>

          </form>
         </div>
        </div>
        <div class="containerDataEmpresa">
          <div class="logoEmpresa">
          <img src="https://cdn-icons.flaticon.com/png/512/3328/premium/3328269.png?token=exp=1654212693~hmac=14ac051f08d644d252d15b7003759887" width = "100">
          </div>
          <h4>Datos del la empresa</h4>
          <form action="" method="post" name="frmEmpresa" id="frmEmpresa">
            <input type="hidden" name="action" value="updateDataEmpresa" />

            <div>
              <label>Nit:</label> <input type="text" name="txtNit" id="txtNit" placeholder="Nit de la empresa" value="" required>
            </div>

            <div>
              <label>Nombre:</label> <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la empresa" value="" required>
            </div>
               
            <div>
              <label>Razon social:</label> <input type="text" name="txtRazon" id="txtRazon" placeholder="Razon social" value="" required>
            </div>

            <div>
              <label>Telefono:</label> <input type="text" name="txtTelefono" id="txttelefono" placeholder="number de telefono" value="" required>
            </div>

            <div>
              <label>Correo electronico:</label> <input type="email" name="txtemail" id="txtemal" placeholder="Correo electronico" value="" required>
            </div>

            <div>
              <label>Dirrecion:</label> <input type="text" name="txtdirrecion" id="txtdirrecion" placeholder="Dirrecion" value="" required>
            </div>

            <div>
              <label>ITB%:</label> <input type="text" name="txtIBT" id="txtIBT" placeholder="ITB" value="" required>
            </div>

            <div class="alertFormEmrpresa" style="display: none"></div>
             
            <div>
              <button type="submit" class="btn_save btnChangepass">
                <i class="fa fa-save"></i>Guardar datos
              </button>
            </div>
          </form> 
        </div>
      </div>
    </div>
</div>

  </section> 


    <script type="text/javascript" src="funcio.js"></script> 
    <script src="jquery/jquery-3.6.0.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>