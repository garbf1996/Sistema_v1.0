$(document).ready(function() {

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change", function() {
        var uploadFoto = document.getElementById("foto").value;
        var foto = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');

        if (uploadFoto != '') {
            var type = foto[0].type;
            var name = foto[0].name;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                $("#img").remove();
                $(".delPhoto").addClass('notBlock');
                $('#foto').val('');
                return false;
            } else {
                contactAlert.innerHTML = '';
                $("#img").remove();
                $(".delPhoto").removeClass('notBlock');
                var objeto_url = nav.createObjectURL(this.files[0]);
                $(".prevPhoto").append("<img id='img' src=" + objeto_url + ">");
                $(".upimg label").remove();

            }
        } else {
            alert("No selecciono foto");
            $("#img").remove();
        }
    });

    $('.delPhoto').click(function() {
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();

    });
    
    //agregar cliente
    $('.nuevoCliente').click(function(e) {
        e.preventDefault();
        $('#nom_cliente').removeAttr('disabled');
        $('#nom_apellido').removeAttr('disabled');
        $('#nom_correo').removeAttr('disabled');
        $('#movil').removeAttr('disabled');
        $('#Ciudad_cliente').removeAttr('disabled');
        $('#Contactos_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');
    });


    //Buscar Cliente
    $('#nit_cliente').keyup(function(e) {
        e.preventDefault();
        var cli = $(this).val();
        var action = 'seracheCliente';


        $.ajax({
            type: "POST",
            assync: true,
            url: "ajax.php",
            data: { action: action, cliente: cli },
            success: function(response) {
                if (response == 0) {
                    $('#idcliente').val();
                    $('#nom_cliente').val();
                    $('#nom_apellido').val();
                    $('#nom_correo').val();
                    $('#movil').val();
                    $('#Ciudad').val();
                    $('#Contactos_cliente').val();
                    $('#Ciudad_cliente').val();
                } else {
                    var data = JSON.parse(response);
                    $('#idcliente').val(data.idcliente);
                    $('#nom_cliente').val(data.nombre);
                    $('#nom_apellido').val(data.apellido);
                    $('#nom_correo').val(data.correo);
                    $('#movil').val(data.movil);
                    $('#dir_cliente').val(data.dirrecion);
                    $('#Ciudad_cliente').val(data.ciudad);
                    $('.nuevoCliente').slideUp();



                    $('#idcliente').attr('disabled', 'disabled');
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#nom_apellido').attr('disabled', 'disabled');
                    $('#nom_correo').attr('disabled', 'disabled');
                    $('#Ciudad_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');
                    $('#movil').attr('disabled', 'disabled');
                    $('#Ciudad').attr('disabled', 'disabled');


                }
            }

        });

    });



    //Registrar Cliente
    $('#forCliente').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            assync: true,
            url: "ajax.php",
            data: $('#forCliente').serialize(),
            success: function(response) {

                if (response != 'error') {
                    $('#idcliente').val(response);
                    $('#idcliente').attr('disabled', 'disabled');
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#nom_apellido').attr('disabled', 'disabled');
                    $('#nom_correo').attr('disabled', 'disabled');
                    $('#Contactos_cliente').attr('disabled', 'disabled');
                    $('#Ciudad_cliente').attr('disabled', 'disabled');
                    $('#Contactos_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');
                    $('#movil').attr('disabled', 'disabled');

                    $('#nuevoCliente').slideUp();
                }



            }

        });

    });


    //Buscar Producto
    $('#cod_producto').keyup(function(e) {
        e.preventDefault();

        var producto = $(this).val();
        var action = 'detalleProducto';

        if (producto != '') {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: { action: action, producto: producto },
                assync: true,
                success: function(response) {

                    if (response != 'error') {

                        var info = JSON.parse(response);
                        $('#text_nombre').html(info.nombre);
                        $('#text_existencia').html(info.existencia);
                        $('#text_cant_producto').val('1');
                        $('#text_precio').html(info.precio);
                        $('#text_total').html(info.precio);


                        $('#text_cant_producto').removeAttr('disabled');



                    } else {
                        $('#text_nombre').html('-');
                        $('#text_existencia').html('_');
                        $('#text_cant_producto').val('0');
                        $('#text_precio').html('0.00');
                        $('#text_total').html('0.00');

                        $('#text_cant_producto').attr('disabled', 'disabled');



                    }




                },
                error: function(error) {

                }
            });
        }



    });

    //Validar cantidad del producto antes de agregar
    $('#text_cant_producto').keyup(function(e) {
        e.preventDefault();

        var precio_total = $(this).val() * $('#text_precio').html();
        var existencia = parseInt($('#text_existencia').html());
        $('#text_total').html(precio_total);



        if ($(this).val() < 1 || isNaN($(this).val()) || ($(this).val() > existencia)) {
            $('#add_product').slideUp();
        } else {
            $('#add_product').slideDown();
        }

    });


     //Cargar producto
    $('#nuevo_producto').click(function(e) {
        e.preventDefault();

        if ($('#text_cant_producto').val() > 0) {

            var codproducto = $('#cod_producto').val();
            var cantidad = $('#text_cant_producto').val();
            var action = 'addproductoDetalle';
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
                data: { action: action, producto: codproducto, cantidad: cantidad },
                success: function(response) {
                
                    if(response != 'error')
                    {
                     var info = JSON.parse(response);
                     $('#detalle_venta').html(info.detalle);
                     $('#detalle_totales').html(info.totales);

                      $('#cod_producto').val('');
                      $('#text_nombre').html('_');
                      $('#text_existencia').html('_');
                      $('#text_cant_producto').val('0');
                      $('#text_precio').html('0.00');
                      $('#text_total').html('0.00');

                      $('#text_cant_producto').attr('disabled', 'disabled');
                      //$('#nuevo_producto').slideUp();

                    }

                    viewprocesa();
                }
            });
        }

    });

     // Anular venta
    $('#btn_anular_venta').click(function (e) { 
    e.preventDefault();
    var rows = $('#detalle_venta tr').length;
    if(rows > 0){
       
        var action = 'anular_venta'; 
        
        $.ajax({
            type: "POST",
            url: "ajax.php",
            async: true,
            data: { action: action},
            success: function(response) {
             console.log(response)
            if( response != 'error')
            {
                location.reload();
            }

               
            }
        });
        
        
    }
    
     });




     //Facturar venta
    $('#btn_detalle').click(function (e) { 
        e.preventDefault();
        var rows = $('#detalle_venta tr').length;
        if(rows > 0){
           
            var action = 'procesarVenta'; 
            var codcliente = $('#idcliente').val();
            
            $.ajax({
                type: "POST",
                url: "ajax.php",
                async: true,
                data: { action: action, codcliente:codcliente},
                success: function(response) {
                  
                  if(response != 'error'){
                    var info = JSON.parse(response);  
                    generaPDF(info.codcliente,info.nofactura)
                    
                    location.reload();
                  }else{

                    console.log('no data');
                  }

                }
            });
            
            
        }
        
         });


         //Modal form Anular factura 
        // $('.btn_anular_factura').click(function (e) { 
          //  e.preventDefault();
          //  var nofactura = $(this).attr('f');
            //var action = 'infoFactura';    
              //  $.ajax({
                  //  type: "POST",
                  //  url: "ajax.php",
                   // async: true,
                   // data: { action: action, nofactura:nofactura},
                   // success: function(response) {
                       
                     //console.log(response)
                  //  }
               /// });
                
              
            
            
            // });
});
//end









//Mantener el detalle 
function serchforDetalle(id)
{
var action = 'serchforDetalle';
var user = id;

$.ajax({
    type: "POST",
    url: "ajax.php",
    async: true,
    data: { action: action, user: user },
    success: function(response) {
        if(response != 'error')
        {
         var info = JSON.parse(response);
         $('#detalle_venta').html(info.detalle);
         $('#detalle_totales').html(info.totales);
        }

    }
});



}

function del_product_detalle(corrativo)
{
var action = 'del_product_detalle';
var id_detalle = corrativo;

$.ajax({
    type: "POST",
    url: "ajax.php",
    async: true,
    data: { action: action, id_detalle: id_detalle },
    success: function(response) {
  if(response !='error'){
    var info = JSON.parse(response);
    $('#detalle_venta').html(info.detalle);
    $('#detalle_totales').html(info.totales);

     $('#cod_producto').val('');
     $('#text_nombre').html('_');
     $('#text_existencia').html('_');
     $('#text_cant_producto').val('0');
     $('#text_precio').html('0.00');
     $('#text_total').html('0.00');

     $('#text_cant_producto').attr('disabled', 'disabled');
     $('#nuevo_producto').slideUp();
  }else{
      
    $('#detalle_venta').html('');
    $('#detalle_totales').html('');
  }

viewprocesa();
    }
   
});


}

// Mostrar/Ocultar boton procesar venta
function viewprocesa(){
    if($('#detalle_venta tr').length > 0)
    {
        $('#btn_detalle').show();
    }else{
        $('#btn_detalle').hide(); 
    }
}

//Cuerpo de PDF
function generaPDF(cliente,factura){
var ancho = 1000;
var alto = 800;

var x = parseInt((window.screen.width/2)- (ancho/2));
var y = parseInt((window.screen.width/2)- (alto/2));

$url = 'factura/generaFactura.php?cl='+cliente+'&f='+factura;
window.open($url,"Factura","left="+x+",top="+y+",hide="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}