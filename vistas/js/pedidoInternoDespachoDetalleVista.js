//recargaTabla();
//validaFinalizado();



function genera_tabla_guia_traslado() {

	id = $('#idPedido').val();
   
   

	datos = "id=" + id;


	$.ajax({


		url: "ajax/tabla-guias-despacho-interno.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_guias_generadas').html(html);

		}
	});
}

function genera_tabla_guia_traslado_validar() {

	id = $('#idPedido').val();
   
   

	datos = "id=" + id;


	$.ajax({


		url: "ajax/tabla-guias-despacho-interno-validar.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_guias_generadas_valida').html(html);

		}
	});
}

function vistaTablaPedido() {

	var id_pedido = $('#idPedido').val();

	$('.tablaVistaPedido').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-despacho-interno-vista.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				id_pedido: id_pedido
			}		
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}

	});

}



function verGuia(id) {	

	var idGuia = id;

	window.location = "index.php?ruta=pedido-interno-despacho-detalle&idGuia="+idGuia;
}

function verGuiaValidar(id) {	

	var idGuia = id;

	window.location = "index.php?ruta=pedido-interno-despacho-detalle-validar&idGuia="+idGuia;
}


$('#btnVolverPedido').click(function() {	

		
	       window.location = "index.php?ruta=pedido-interno-despacho";	 

});

$('#btnVolverPedidoValidar').click(function() {	

		
	       window.location = "index.php?ruta=pedido-interno-validar";	 

});