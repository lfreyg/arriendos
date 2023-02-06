/*=============================================
CARGAR LA TABLA DINÁMICA DE PEDIDOS
=============================================*/

function pedidos(){
$('.tablaPedido').DataTable( {
    "ajax": "ajax/datatable-despachar-pedido-equipo.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[2,"asc"]],
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

}

function verDetalle(){

$('.tablaPedidoDetalle').DataTable( {
    "ajax": "ajax/datatable-ver-detalle-despachar-pedido-equipo.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[2,"asc"]],
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

}


$('#btnVerDetalleDespachoPedidos').click(function(){ 
        
        window.location = "index.php?ruta=ver-detalle-despachar-pedido-equipos";  

});


$('#btnDespachoPedidos').click(function(){ 
        
        window.location = "index.php?ruta=despachar-pedido-equipos";  

});


$(".tablaPedido").on("click", ".btnDetalleDespachoPedidoEquipo", function(){

	var idConstructora = $(this).attr("idConstructora");
	var idObra = $(this).attr("idObra");

	$("#nuevaGuiaConstructora").val(idConstructora);
	$("#comboObras").val(idObra);

	$("#modalAgregarGuiaDespachar").modal("show");



})

