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
            <div class="card-header text-center"> <h1>Lista de producto</h1></div>
            <div class="card-body col-md-12">
            <div class="container">

            <ul class="nav nav">
              <li class="nav-item com-md-12">
                <a class="nav-link active" href="registro_productophp">Nuevo</a>
              </li>
            <form action="buscar_producto.php" method="get">
            <div class="input-group">
            <div class="form-outline">
            <input type="text" id="form1" name="busqueda" class="form-control" placeholder="Buscar producto" />
            </div>
            </div>
            </form>
            </ul>
            </div>

            <br>
           <table class="table table-responsive table-hover ">
            <thead class="thead-dark">
              <tr>
              <th scope="col">id</th>
                <th scope="col ">Producto</th>
                <th scope="col">Modelos</th>
                <th scope="col">S/N</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Existencia</th>
                <th scope="col">Imágenes</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
                 </thead>
                 <tbody>
                  <tr>
                  <?php
                   
                   // Total registro
                   $query_total = mysqli_query($conection,"SELECT COUNT(*) as Total_registro FROM producto WHERE estatus = 1");
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
                  $qury = mysqli_query($conection,"SELECT p.codproducto ,p.nombre,p.modelos,p.ser_no,p.categoria,pro.proveedor,p.precio,p.existencia,p.foto
                   FROM producto p INNER JOIN proveedor pro
                    on p.proveedor = pro.idproveedor WHERE p.estatus = 1 ORDER BY p.codproducto
                  LIMIT $desde,$por_pagina");
                $result = mysqli_num_rows($qury);
                mysqli_close($conection);
                 if($result>0){
                   while($data= mysqli_fetch_array($qury)){
                     if($data['foto'] != 'img_producto.jpg'){
                       $foto = 'img/uploads/'.$data['foto'];
                     }else{
                       $foto = 'img/' .$data['foto'];
                     }

                   ?>
                   <tr>
                    <td><?php echo $data["codproducto"]?></td>
                    <td><?php echo $data["nombre"];?></td>
                    <td><?php echo $data["modelos"];?></td>
                    <td><?php echo $data["ser_no"];?></td>
                    <td><?php echo $data["proveedor"];?></td>
                    <td><?php echo $data["categoria"];?></td>
                    <td><?php echo $data["precio"];?></td>
                    <td><?php echo $data["existencia"];?></td>
                    <td><img src="<?php echo $foto;?>" width="100" height="100"></td>
                    <td>
                    <a href="edit_producto.php?id=<?php echo $data["codproducto"];?>">Editar</a> 
                   </td>
                   <td>
                      <?php if($_SESSION['idrol'] ==1 || $_SESSION['idrol'] ==3){ ?>
                      <a href="eliminar_producto.php?id=<?php echo $data["codproducto"];?>">Eliminar</a>
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
       
</nav>
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