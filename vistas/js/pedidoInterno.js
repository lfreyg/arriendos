validarNuevoPedido();


/*=============================================
CARGAR LA TABLA DINÁMICA DE PEDIDOS
=============================================*/


$('.tablaPedido').DataTable( {
    "ajax": "ajax/datatable-pedido-interno.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[0,"desc"]],
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );


//LISTA LOS PEDIDOS INTERNOS FINALIZADOS PARA REALIZAR VALIDACION

$('.tablaValidarPedido').DataTable( {
    "ajax": "ajax/datatable-pedido-interno-validar.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[0,"desc"]],
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );




/*=============================================
ELIMINAR 
=============================================*/

$(".tablaPedido tbody").on("click", "button.btnEliminarPedidoInterno", function(){

	var idPedido = $(this).attr("idPedido");

	swal({

		title: '¿Está seguro de borrar el Pedido Interno de equipos?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Pedido!'
        }).then(function(result) {
        if (result.value) {

	      
        	window.location = "index.php?ruta=pedido-interno&idPedido="+idPedido;

        }


	})

})
	


$(".tablaPedido tbody").on("click", "button.btnDetallePedidoInterno", function(){

	var idPedido = $(this).attr("idPedido");

	window.location = "index.php?ruta=pedido-interno-detalle&idPedido="+idPedido;

})


//BOTON VALIDAR PEDIDO CUANDO YA FUE GENERADO
$(".tablaValidarPedido tbody").on("click", "button.btnDetallePedidoInternoValidar", function(){

	var idPedido = $(this).attr("idPedido");

	window.location = "index.php?ruta=pedido-interno-despacho-detalle-vista-validar&idPedido="+idPedido;

})

//HABILITAR BOTON NUEVO PEDIDO, SOLO CUANDO NO HAYAN PEDIDOS ABIERTOS
function validarNuevoPedido(){
	var validarNuevo = "1";

	var datos = new FormData();
	datos.append("validarNuevo", validarNuevo);

	$.ajax({
	    url:"ajax/pedido-interno.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
            
            if(respuesta[0] > 0){
               $('#btnNuevoPedido').attr('disabled', 'disabled');   
            }else{
              $('#btnNuevoPedido').removeAttr('disabled'); 
            }
	

     	}

	})
}





   