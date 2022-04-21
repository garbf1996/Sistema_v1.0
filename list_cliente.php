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
<?php
 include "nav.php";

?>

    <title>Sistemas</title>  
  </head>
  <body>
    <br>
       <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
            <div class="card-header text-center"> <h1>Lista de Cliente</h1></div>
            <div class="card-body col-md-12">
            <div class="container">

            <ul class="nav nav">
              <li class="nav-item com-md-12">
                <a class="nav-link active" href="registrar_cliente.php">Nuevo</a>
              </li>
            <form action="buscar_cliente.php" method="get">
            <div class="input-group">
            <div class="form-outline">
            <input type="search" id="form1" name="busqueda" class="form-control" />
            </div>
            </div>
            </form>
            </ul>
            </div>

            <br>
           <table class="table table-responsive table-hover">
            <thead class="thead-dark">
              <tr>
              <th scope="col">id</th>
                <th scope="col">Mombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Documentos</th>
                <th scope="col">Correo</th>
                <th scope="col">Dirreción</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Contactos</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
                 </thead>
                 <tbody>
                  <tr>
                  <?php
                   
                   // Total registro
                   $query_total = mysqli_query($conection,"SELECT COUNT(*) as Total_registro FROM cliente WHERE estatus = 1");
                   $result_total = mysqli_fetch_array($query_total);
                   //Ascendiendo en el campo Total_registro
                   $total_registro = $result_total ['Total_registro'];
                   $por_pagina = 6;

                   if(empty($_GET['pagina']))
                   {
                     $pagina = 1;
                   }else{
                    $pagina = $_GET['pagina'];
                   }

                   $desde = ($pagina -1) * $por_pagina;
                   $total_pagina = ceil($total_registro / $por_pagina);
                  // Mostrar datos 
                 $qury = mysqli_query($conection,"SELECT * FROM cliente  WHERE estatus = 1  ORDER BY idcliente 
                 LIMIT $desde,$por_pagina");
                $result = mysqli_num_rows($qury);
                mysqli_close($conection);
                 if($result>0){
                   while($data= mysqli_fetch_array($qury)){
                   ?>
                   <tr>
                    <td><?php echo $data["idcliente"]?></td>
                    <td><?php echo $data["nombre"];?></td>
                    <td><?php echo $data["apellido"];?></td>
                    <td><?php echo $data["documentos"];?></td>
                    <td><?php echo $data["correo"];?></td>
                    <td><?php echo $data["dirrecion"];?></td>
                    <td><?php echo $data["ciudad"];?></td>
                    <td><?php echo $data["movil"];?></td>
                    <td>
                     
                      <a href="edit_cliente.php?id=<?php echo $data["idcliente"];?>">Editar</a> 
                   </td>
                   <td>
                      <?php if($_SESSION['idrol'] ==1 || $_SESSION['idrol'] ==2){ ?>
                      <a href="eliminar_confimar_cliente.php?id=<?php echo $data["idcliente"];?>">Eliminar</a>
                      <?php }?>
                    </td>
                   </tr> 
                   <?php  
                   }

                 }
                 
                 ?>
                 </tbody>
                </table>
                </div>
                </div>
            </div>
           </div>
    </div>
    <script src="js/app.js"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>   	 	  	
  </body>
</html>