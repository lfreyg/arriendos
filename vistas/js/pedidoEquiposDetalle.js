recargaTabla();


function genera_tabla_compras() {

	id = $('#idPedidoGenerado').val();
    

	datos = "id=" + id;


	$.ajax({


		url: "ajax/tabla-equipos-pedidos.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}



$(".tablaEquiposFactura tbody").on("click", "button.agregarEquipoArriendo", function() {


	var idTipoEquipo = $(this).attr("idTipoEquipo");

	var datos = new FormData();
	datos.append("idTipoEquipo", idTipoEquipo);

	$.ajax({

		url: "ajax/tipoEquipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {


			var idMarca = respuesta["id_marca"];

			var datos = new FormData();
			datos.append("idMarca", idMarca);
			$.ajax({
				url: "ajax/marcas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(marca) {

					$("#compraDetalleMarca").val(marca["descripcion"]);
					$("#compraDetalleDescripcion").val(respuesta["descripcion"]);
					$("#compraDetalleModelo").val(respuesta["modelo"]);
					$("#idEquipoDetalle").val(respuesta["id"]);	
					$("#pedidoDetalle").focus();			
					

				}

			})
		}

	});



});


$('#btnAgregarDetalle').click(function() {

		
	if ($('#idEquipoDetalle').val() == '') {
		alertify.error("Seleccione un equipo de la lista");
		return false;
	}

	id_nombre_equipos = $('#idEquipoDetalle').val();
	id_pedido = $('#idPedidoGenerado').val();
	tipo = $('#pedidoTipo').val();
	detalle = $('#pedidoDetalle').val();
	
	datos = "id_nombre_equipos=" + id_nombre_equipos +
		"&id_pedido=" + id_pedido +
		"&tipo=" + tipo +
		"&detalle=" + detalle;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-pedido.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_compras();
			alertify.success("Equipo agregado al pedido");			
			$('#pedidoTipo').val(10);
			
			
		}
	});

});



$('#seleccionaMarcaEquipo').change(function() {

	$('#idEquipoDetalle').val('');
	$('#compraDetalleMarca').val('');
	$('#compraDetalleDescripcion').val('');
	$('#compraDetalleModelo').val('');
	$('#pedidoDetalle').val('');
	$('#pedidoTipo').val(10);


	var idMarca = $('#seleccionaMarcaEquipo').val();
	$('.tablaEquiposFactura').DataTable().destroy();

	recargaTabla(idMarca);
	$('.tablaEquiposFactura').DataTable().ajax.reload();


});


function recargaTabla(id) {

	var idMarca = id;

	$('.tablaEquiposFactura').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-compra.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idMarca: idMarca
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



function editar(id) {

	var idEquipo = id;

	var datos = new FormData();
	datos.append("idEquipo", idEquipo);

	$.ajax({

		url: "ajax/equipos-pedido.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(equipo) {
            

			var marca = equipo["marca"];
			var tipoEquipo = equipo["tipo_equipo"];
			var modelo = equipo["modelo"];
			var id = equipo["id"];
			var idTipo = equipo["idTipo"];
			var detalle = equipo["detalle"];
			

			    $("#compraDetalleMarcaEdita").val(marca);
				$("#compraDescripcionEdita").val(tipoEquipo);
				$("#compraModeloEdita").val(modelo);
				$("#idEquipoDetalleEdita").val(id);
				$('#pedidoTipoEdita').val(idTipo);
				$('#editaDetalles').val(detalle);				
				$('#editaDetalles').focus();

					

		}

	});



	$("#modalEditarEquipo").modal("show");
}




$('#btnGuardarEdita').click(function() {

	

	idEquipo = $('#idEquipoDetalleEdita').val();
	tipo = $('#pedidoTipoEdita').val();
	detalle = $('#editaDetalles').val();
			
				

	datos = "idEquipo=" + idEquipo +
		"&tipo=" + tipo +		
		"&detalle=" + detalle;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-detalle-pedido.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Equipo actualizado");
			genera_tabla_compras();


		}
	});
});

$('#btnFinalizarPedido').click(function() {
	
	id = $('#idPedidoGenerado').val();

	var datos = new FormData();
	datos.append("finalizaPedido", id);


	$.ajax({
		url: "ajax/equipos-pedido.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			envia_correo();
	       



		}
	});


	 window.location = "index.php?ruta=pedido-equipos";

});

function eliminarConsulta(id) {
	id = id;
	alertify.confirm('ELIMINAR EQUIPO', 'Esta seguro de eliminar el equipo?', function() {
		elimina_equipo(id)
	}, function() {});
}

function elimina_equipo(id) {
	var idEquipo = id;

	var datos = new FormData();
	datos.append("eliminarEquipo", idEquipo);


	$.ajax({
		url: "ajax/equipos-pedido.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Equipo Eliminado");
			genera_tabla_compras();



		}
	});
}

function envia_correo(){
	$.ajax({
		url: "ajax/envia-correo.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			
		}
	});

}