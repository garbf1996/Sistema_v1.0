<?php
session_start();
include "conexion.php";

if(!empty($_POST)){



    //Buscar Cliente
if($_POST['action']== 'seracheCliente'){
if(!empty($_POST['cliente'])){
$nit= $_POST['cliente'];

$query = mysqli_query($conection,"SELECT * FROM cliente WHERE documentos LIKE '$nit' and estatus = 1");
$result = mysqli_num_rows($query);
mysqli_close($conection);
$data = '0';
if($result > 0){
$data = mysqli_fetch_assoc($query);
}else{
    $data = 0;
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
exit;
}
if($_POST['action'] == 'addCliente'){
   
    $nombre = $_POST['nom_cliente'];
    $apellido = $_POST['nom_apellido'];
    $documentos = $_POST['nit_cliente'];
    $correo = $_POST['nom_correo'];
    $dirrecion = $_POST['dir_cliente'];
    $ciudad = $_POST['Ciudad_cliente'];
    $movil = $_POST['movil'];
    $idusuario = $_SESSION['idusuario'];
    
  


    $query_insert = mysqli_query($conection,"INSERT INTO cliente(nombre,apellido,documentos,correo,dirrecion,ciudad,movil,idusuario )
    VALUES('$nombre','$apellido','$documentos','$correo','$dirrecion','$ciudad','$movil','$idusuario')");


if($query_insert){

    $codCliente = mysqli_insert_id($conection);
    $msg = $codCliente;
}else{
    $msg = 'error';
}
echo $msg;
exit;

}

if($_POST['action'] == 'detalleProducto'){

    $producto_id = $_POST['producto'];

    $query = mysqli_query($conection,"SELECT  codproducto,nombre,existencia,precio FROM producto WHERE codproducto = '$producto_id' AND estatus = 1 ");
    mysqli_close($conection);
    $result = mysqli_num_rows($query);
    if($result > 0){
        $data = mysqli_fetch_assoc($query);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo 'error';
    exit;
    }

     //Agregar producto 
    if($_POST['action'] == 'addproductoDetalle'){
        if(empty($_POST['producto']) || empty($_POST['cantidad'])){
            echo 'error';
        }else{
            $codproducto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $token = md5($_SESSION['idusuario']);


            $query_iva = mysqli_query($conection,"SELECT iva FROM configuracion");
            $result_iva = mysqli_num_rows($query_iva);

            $query_detalle_temp = mysqli_query($conection,"CALL add_detalle_temp($codproducto,$cantidad,'$token')");
            $result = mysqli_num_rows($query_detalle_temp);


            $detalleTable = '';
            $sub_total = 0;
            $iva = 0;
            $total = 0;
            $arrayDato = array();

            if($result > 0){
                if($result_iva > 0){
                $info_iva =   mysqli_fetch_assoc($query_iva);
                $iva = $info_iva['iva'];

            }
            while ($data =  mysqli_fetch_assoc($query_detalle_temp)) {
            $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
            $sub_total = round($sub_total + $precioTotal, 2);
            $total = round($total + $precioTotal, 2);

            $detalleTable .='
            <tr>
            <th>'.$data['codproducto'].'</th>
              <th colspan="2">'.$data['nombre'].'</th>
              <th class="textcenter">'.$data['cantidad'].'</th>
               <th class="textringht">'.$data['precio_venta'].'</th>
              <th class="textringht">'.$precioTotal.'</th>
              <th><a href="#" onclick = "event.preventDefault(); del_product_detalle('.$data['correlativo'].');" class= "link_delete"><img src="icono/carrito-de-compras.PNG">
              </a></th>
             
              </tr>
            ';
            }

            $ITB = round($sub_total * ($iva / 100), 2);
            $tl_sniva = round($sub_total - $ITB, 2);
            $total = round($tl_sniva + $ITB, 2);


            $detalleTotales = '
           <tr>
            <td colspan="5" class="textringht">SUBTOTAL RD$.</td>
            <td  class="textringht">'.$tl_sniva.'</td>
            </tr>
      
            <tr>
          <td colspan="5" class="textringht">ITB ('.$iva.')</td>
            <td  class="textringht">'.$ITB.'</td>
            </tr>
      
            <tr>
          <td colspan="5" class="textringht">Total</td>
            <td  class="textringht">'.$total.'</td>
         </tr>
            ';

            $arrayDato['detalle'] = $detalleTable;
            $arrayDato['totales'] =  $detalleTotales;

            echo json_encode($arrayDato,JSON_UNESCAPED_UNICODE);
            
            }else{
                echo 'error'; 
            }
    
        }
        exit;
  }
  
    // Extrae datos del detalle 
  
    if($_POST['action'] == 'serchforDetalle'){
        if(empty($_POST['user'])){
         
            echo 'error';

        }else{
            $token = md5($_SESSION['idusuario']);
            

            $query = mysqli_query($conection," SELECT 
            tmp.correlativo,
            tmp.token_user,
            tmp.cantidad,
            tmp.precio_venta,
            p.codproducto,
            p.nombre FROM
            detalle tmp INNER JOIN producto p
            on tmp.codproducto = p.codproducto WHERE token_user = '$token';");

           $result = mysqli_num_rows($query);

            $query_iva = mysqli_query($conection,"SELECT iva FROM configuracion");
            $result_iva = mysqli_num_rows($query_iva);

            $detalleTable = '';
            $sub_total = 0;
            $iva = 0;
            $total = 0;
            $arrayDato = array();

            if($result > 0){
                if($result_iva > 0){
                $info_iva =   mysqli_fetch_assoc($query_iva);
                $iva = $info_iva['iva'];

            }
            while ($data =  mysqli_fetch_assoc($query)) {
            $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
            $sub_total = round($sub_total + $precioTotal, 2);
            $total = round($total + $precioTotal, 2);

            $detalleTable .='
            <tr>
            <th>'.$data['codproducto'].'</th>
              <th colspan="2">'.$data['nombre'].'</th>
              <th class="textcenter">'.$data['cantidad'].'</th>
               <th class="textringht">'.$data['precio_venta'].'</th>
              <th class="textringht">'.$precioTotal.'</th>
              <th><a href="#" onclick = "event.preventDefault(); del_product_detalle('.$data['correlativo'].')" class= "link_delete"><img src="icono/carrito-de-compras.PNG"></a></th>
              </tr>
            ';
            }

            $ITB = round($sub_total * ($iva / 100), 2);
            $tl_sniva = round($sub_total - $ITB, 2);
            $total = round($tl_sniva + $ITB, 2);


            $detalleTotales = '
           <tr>

           <tr>
           <th colspan="5" class="textringht">SUBTOTAL RD$.</th>
           <td  class="textringht">'.$tl_sniva.'</td>
         </tr>

         <tr>
         <th colspan="5" class="textringht">ITB ('.$iva.')</th>
           <td  class="textringht">'.$ITB.'</td>
           </tr>
     
           <tr>
         <th colspan="5" class="textringht">Total</th>
           <td  class="textringht">'.$total.'</td>
        </tr>
         </tr>
            ';

            $arrayDato['detalle'] = $detalleTable;
            $arrayDato['totales'] =  $detalleTotales;

            echo json_encode($arrayDato,JSON_UNESCAPED_UNICODE);
            
            }else{
                echo 'error'; 
            }
    
       
        }
        exit;
  }

    //Eliminar de talles
  if($_POST['action'] == 'del_product_detalle'){
    if(empty($_POST['id_detalle'])){
         
        echo 'error';

    }else{
        $id_detalle = $_POST['id_detalle'];
        $token = md5($_SESSION['idusuario']);

        $query_iva = mysqli_query($conection,"SELECT iva FROM configuracion");
        $result_iva = mysqli_num_rows($query_iva);


        $query_detalle_temp = mysqli_query($conection,"CALL del_detalle_temp( $id_detalle,' $token')");
        $result = mysqli_num_rows($query_detalle_temp);

        $detalleTable = '';
        $sub_total = 0;
        $iva = 0;
        $total = 0;
        $arrayDato = array();

        if($result > 0){
            if($result_iva > 0){
            $info_iva =   mysqli_fetch_assoc($query_iva);
            $iva = $info_iva['iva'];

        }
        while ($data =  mysqli_fetch_assoc($query_detalle_temp)) {
        $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
        $sub_total = round($sub_total + $precioTotal, 2);
        $total = round($total + $precioTotal, 2);

        $detalleTable .='
        <tr>
        <th>'.$data['codproducto'].'</th>
          <th colspan="2">'.$data['nombre'].'</th>
          <th class="textcenter">'.$data['cantidad'].'</th>
           <th class="textringht">'.$data['precio_venta'].'</th>
          <th class="textringht">'.$precioTotal.'</th>
          <th><a href="#" onclick = "event.preventDefault(); del_product_detalle('.$data['correlativo'].');" class= "link_delete"><img src="icono/carrito-de-compras.PNG"></a></th>
          </tr>
        ';
        }

        $ITB = round($sub_total * ($iva / 100), 2);
        $tl_sniva = round($sub_total - $ITB, 2);
        $total = round($tl_sniva + $ITB, 2);


        $detalleTotales = '
       <tr>
        <th colspan="5" class="textringht">SUBTOTAL Q.</th>
        <td  class="textringht">'.$tl_sniva.'</td>
        </tr>
  
        <tr>
      <th colspan="5" class="textringht">ITB ('.$iva.')</th>
        <td  class="textringht">'.$ITB.'</td>
        </tr>
  
        <tr>
      <th colspan="5" class="textringht">Total</th>
        <td  class="textringht">'.$total.'</td>
     </tr>
        ';

        $arrayDato['detalle'] = $detalleTable;
        $arrayDato['totales'] =  $detalleTotales;

        echo json_encode($arrayDato,JSON_UNESCAPED_UNICODE);
        
        }else{
            echo 'error'; 
        }
      }  exit;
  }

  //Anular venta
  if($_POST['action'] == 'anular_venta'){
    $token = md5($_SESSION['idusuario']);
    $query_del = mysqli_query($conection,"DELETE FROM detalle WHERE token_user = '$token'");
    mysqli_close($conection);
    if($query_del){
      echo 'ok';
    }else{
      echo 'error';
    }
    exit;

  }
  //procesar venta
  if($_POST['action'] == 'procesarVenta'){

   if(empty($_POST['codcliente'])){
    $codcliente = 1;

    }else{

    $codcliente = $_POST['codcliente'];
     }

     $toke = md5($_SESSION['idusuario']);
     $usuario = $_SESSION['idusuario'];


     $query = mysqli_query($conection,"SELECT * FROM detalle WHERE  token_user = '$toke' ");
     $result = mysqli_num_rows($query);


     if($result > 0){

      $query_procesar = mysqli_query($conection,"CALL procesar_venta($usuario,$codcliente,'$toke')");
      $result_detalle = mysqli_num_rows($query_procesar);


      if($result_detalle > 0){
       $data = mysqli_fetch_assoc($query_procesar);
       echo json_encode($data,JSON_UNESCAPED_UNICODE);

      }else{
        echo "error";
      }

     }else{
      echo "error";
     }
      mysqli_close($conection);
      exit;
  }
  //
  if($_POST['action'] == 'infoFactura'){
    
    print_r($_POST);
    exit;
  }
}
exit;
?>