

/*=============================================
CARGAR LA TABLA DINÁMICA DE PEDIDOS
=============================================*/


$('.tablaDespachoPedido').DataTable( {
    "ajax": "ajax/datatable-pedido-interno-despacho.ajax.php",
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



$(".tablaDespachoPedido tbody").on("click", "button.btnDetallePedidoInternoDespacho", function(){

	var idPedido = $(this).attr("idPedido");

	window.location = "index.php?ruta=pedido-interno-despacho-detalle-vista&idPedido="+idPedido;

})
   