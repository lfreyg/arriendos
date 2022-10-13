recargaTabla();
validaFinalizado();

function validaFinalizado(){
	if($('#estadoPedido').val() == 0){
       $('#btnFinalizarPedido').removeAttr('disabled');  
       $('#btnAgregarDetalle').removeAttr('disabled');
       
	}else{
      $('#btnFinalizarPedido').attr('disabled', 'disabled');
       $('#btnAgregarDetalle').attr('disabled', 'disabled');
	}
}

function genera_tabla_pedidos() {

	id = $('#idPedidoGenerado').val();
    idSucursal = $('#idSucursaltxt').val();
    estado = $('#estadoPedido').val(); 

	datos = "id=" + id +
	        "&idSucursal=" + idSucursal +
	        "&estado=" + estado;


	$.ajax({


		url: "ajax/tabla-equipos-pedidos-interno.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}



$(".tablaCategoriasEquipos tbody").on("click", "button.agregarEquipoPedido", function() {


	var idCategoria = $(this).attr("idCategoria");
	var idSucursal = $("#idSucursaltxt").val();

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url: "ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {


			

			var datos = new FormData();
			datos.append("categoriaStock", idCategoria);
			datos.append("idSucursal", idSucursal);

			$.ajax({
				url: "ajax/categorias.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(disponible) {


                   if(disponible[0] == null){
					stock = 0;
				   }else{
				   	stock = disponible[0];
				   }	

				   if(disponible[1] == null){
					repara = 0;
				   }else{
				   	repara = disponible[1];
				   }	

				   if(disponible[2] == null){
					tengo = 0;
				   }else{
				   	tengo = disponible[2];
				   }	


					$("#idCategoria").val(respuesta["id"]);	
					$("#DetalleDescripcion").val(respuesta["categoria"]);
					$("#tengo").val(tengo);
					$("#stockDisponible").val(stock);
					$("#enRevision").val(repara);
					$("#cantidad").focus();			
					

				}

			})
		}

	});



});


$('#btnAgregarDetalle').click(function() {

		
	if ($('#idCategoria').val() == '') {
		alertify.error("Seleccione un equipo de la lista");
		return false;
	}

	if ($('#cantidad').val() == '' || $('#cantidad').val() == 0) {
		alertify.error("Ingrese cantidad a solicitar");
		$('#cantidad').focus();
		return false;
	}

	idCategoria = $('#idCategoria').val();
	id_pedido = $('#idPedidoGenerado').val();
	cantidad = 	$('#cantidad').val();
	detalle = $('#detalles').val();
	tengo = $('#tengo').val();
	disponible = $('#stockDisponible').val();
	revision = $('#enRevision').val();

	
	datos = "idCategoria=" + idCategoria +
		"&id_pedido=" + id_pedido +
		"&cantidad=" + cantidad +
		"&detalle=" + detalle +
		"&tengo=" + tengo +
		"&disponible=" + disponible +
		"&revision=" + revision;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-pedido-interno.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_pedidos();
			alertify.success("Equipo agregado al pedido");
			$('#DetalleDescripcion').val('');	
			$('#tengo').val('');	
			$('#stockDisponible').val('');	
			$('#enRevision').val('');	
			$('#cantidad').val('');	
			$('#detalles').val('');		
			$('#idCategoria').val('');			
		    $('.tablaCategoriasEquipos').DataTable().destroy();

	        recargaTabla();
	        $('.tablaCategoriasEquipos').DataTable().ajax.reload();
			
			
		}
	});

});





function recargaTabla() {

	var id_pedido = $('#idPedidoGenerado').val();

	$('.tablaCategoriasEquipos').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-interno.ajax.php",
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



function editar(id) {

	var idEquipo = id;

	var datos = new FormData();
	datos.append("idEquipo", idEquipo);

	$.ajax({

		url: "ajax/equipos-pedido-interno.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(equipo) {
            

			
			var id = equipo["id"];
			var equipoPedido = equipo["categoria"];
			var cantidad = equipo["cantidad"];
			var detalle = equipo["detalle"];
			

			    $("#idCategoriaEdita").val(id);
				$("#DetalleDescripcionEdita").val(equipoPedido);
				$("#cantidadEdita").val(cantidad);				
				$('#detallesEdita').val(detalle);	

		}

	});



	$("#modalEditarEquipo").modal("show");
}




$('#btnGuardarEdita').click(function() {

	if ($('#cantidadEdita').val() == '' || $('#cantidadEdita').val() == 0) {
		alertify.error("Ingrese cantidad a solicitar");
		$('#cantidadEdita').focus();
		return false;
	}

	idEquipo = $('#idCategoriaEdita').val();
	cantidad = $('#cantidadEdita').val();
	detalle = $('#detallesEdita').val();
			
				

	datos = "idEquipo=" + idEquipo +
		"&cantidad=" + cantidad +		
		"&detalle=" + detalle;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-detalle-pedido-interno.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Equipo actualizado");
			genera_tabla_pedidos();


		}
	});
});

$('#btnFinalizarPedido').click(function() {
	
	id = $('#idPedidoGenerado').val();

	var datos = new FormData();
	datos.append("finalizaPedido", id);


	$.ajax({
		url: "ajax/equipos-pedido-interno.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Pedido finalizado y correo enviado");
		//	envia_correo();
	       



		}
	});


	 window.location = "index.php?ruta=pedido-interno";

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
		url: "ajax/equipos-pedido-interno.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Equipo Eliminado");
			$('#DetalleDescripcion').val('');	
			$('#tengo').val('');	
			$('#stockDisponible').val('');	
			$('#enRevision').val('');	
			$('#cantidad').val('');	
			$('#detalles').val('');		
			$('#idCategoria').val('');			
		    $('.tablaCategoriasEquipos').DataTable().destroy();

	        recargaTabla();
	        $('.tablaCategoriasEquipos').DataTable().ajax.reload();
			genera_tabla_pedidos();



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

			alertify('correo enviado');
		}
	});

}

$('#btnVolver').click(function() {	

		
	       window.location = "index.php?ruta=pedido-interno";	 

});