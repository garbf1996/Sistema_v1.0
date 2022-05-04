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

    <title>Lista de ventas</title>  
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  </head>
  <body>
    <br>
       <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6">
            <div class="card shadow-lg p-3 mb-5 bg-white ">
            <div class="card-header text-center"> <h1>Lista de ventas</h1></div>
            <div class="card-body col-md-12">
            <div class="container">

       <ul class="nav nav">
       <div class="container">
       <div class="row">
      <div class="col-sm-3">
      <form action="buscar_venta.php" method="get">
        <div class="input-group">
        <div class="form-outline">
        <input type="search" id="form1" name="busqueda" class="form-control" placeholder="No.factura" />
        </div>
        </div>
        </form>
      </div>
    </div>
    <br>
  <form action="buscar_venta.php" method="get">
  <div class="row">
    <div class="col-md-3">
     <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Desde</span>
  </div>
  <input type="date" class="form-control"  name="fecha_desde" id="fecha_desde"aria-label="Amount (to the nearest dollar)">
</div>
    </div>
   <div class="col-md-3">
     <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Hasta</span>
  </div>
  <input type="date" class="form-control"  name="fecha_hasta" id="fecha_haasta"aria-label="Amount (to the nearest dollar)">
</div>
    </div>
     <div class="col-md-2">
    <button type="button" class="btn btn-primary form-control">Buscar</button>
    </div>
  </div>
</form>
        
           </div>
           
        </ul>
            <br>
           <table class="table ">
            <thead class="thead-dark">
              <tr>
              <th scope="col">NO.</th>
                <th scope="col">fecha</th>
                <th scope="col">Cliente</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Estado</th>
                <th scope="col">Total factura </th>
                <th scope="col">Ver</th>
                <th scope="col">Anular</th>
                 </thead>
                 <tbody>
                  <tr>
                  <?php
                   
                   // Total registro
                   $query_total = mysqli_query($conection,"SELECT COUNT(*) as factura FROM cliente WHERE estatus != 10");
                   $result_total = mysqli_fetch_array($query_total);
                   //Ascendiendo en el campo Total_registro
                   //$total_registro = $result_total ['Total_registro'];
                   $por_pagina = 10;

                   if(empty($_GET['pagina']))
                   {
                     $pagina = 1;
                   }else{
                    $pagina = $_GET['pagina'];
                   }

                   $desde = ($pagina -1) * $por_pagina;
                  // $total_pagina = ceil($total_registro / $por_pagina);
                  // Mostrar datos 
                 $qury = mysqli_query($conection,"SELECT f.nofactura,f.fecha,f.totalfactura,f.codcliente,f.estatus,u.nombre as vendedor, cl.nombre 
                  FROM factura f inner join usuario u on f.usuario = u.idusuario inner join cliente cl on f.codcliente = cl.idcliente
                  where f.estatus !=10 order by f.fecha DESC
                 LIMIT $desde,$por_pagina");
                       mysqli_close($conection);

                $result = mysqli_num_rows($qury);

                 if($result>0){
                   while($data= mysqli_fetch_array($qury)){

            
                      

                     if($data ["estatus"] ==1){
                       $estado = '<div class="p-1 mb-1 bg-success text-white rounded text-center"> pagada</div>';
                     }else{
                      $estado = '<div class="p-1 mb-1 bg-danger text-white rounded text-center"> Anulada</div>';
                     }
                   ?>
                   <tr id="row_<?php echo $data["nofactura"];?>">
                    <td><?php echo $data["nofactura"]?></td>
                    <td><?php echo $data["fecha"];?></td>
                    <td><?php echo $data["nombre"];?></td>
                    <td><?php echo $data["vendedor"];?></td>
                    <td><?php  echo  $estado;?></td>
                    <td><span>RD</span> <?php echo $data["totalfactura"];?></td>
                    <td> <a href="#" class="btn btn-primary"  cl="<?php echo $data["codcliente"];?>" fa="<?php echo $data["nofactura"];?>"><img src="https://cdn-icons-png.flaticon.com/512/2489/2489292.png"width="32" height="32" ></a> </td>
                    <td> <a href="#"  fa="<?php echo $data["nofactura"];?>"><img src="https://cdn-icons-png.flaticon.com/512/782/782747.png"width="32" height="32" ></a> </td>
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
    </div>

      
    <script type="text/javascript" src="app.js"></script> 
    <script src="popper/popper.min.js"></script>	 	 	
    <script src="js/bootstrap.min.js"></script>  	 	 	  	
  </body>
</html>