recargaTablaPedido();
//validaFinalizado();

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

	id = $('#idGuiaGenerado').val();    

	datos = "id=" + id;

	$.ajax({


		url: "ajax/tabla-equipos-guia-traslado.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}

function genera_tabla_pedidos_validar() {

	id = $('#idGuiaGenerado').val();    

	datos = "id=" + id;

	$.ajax({


		url: "ajax/tabla-equipos-guia-traslado-validar.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles_validar').html(html);

		}
	});
}


$(".tablaCategoriasEquipos tbody").on("click", "button.agregarEquipoPedido", function() {



	var idCategoria = $(this).attr("idCategoria");
	var idPedidoDetalle = $(this).attr("idPedidoDetalle");
    
    $('#idCategoriaTxt').val(idCategoria);
    $('#idPedidoDetalle').val(idPedidoDetalle);


	
           $('.tablaEquiposGuia').DataTable().destroy();
	       recargaTablaEquiposDisponibles(idCategoria);
	        $('.tablaEquiposGuia').DataTable().ajax.reload();
	

});


function recargaTablaPedido() {
 if($('#estadoGuia').val() == 12){
	var id_pedido = $('#idPedidoGenerado').val();

	$('.tablaCategoriasEquipos').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-despacho-interno.ajax.php",
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

}

function recargaTablaEquiposDisponibles(id) {

	var idCategoria = id;
	var idPedidoInterno = $('#idPedidoDetalle').val();

	$('.tablaEquiposGuia').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-equipos-guia-traslado-pedido.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idCategoria: idCategoria,
				idPedidoInterno: idPedidoInterno
			}
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No Existen equipos disponibles para la categoria seleccionada",
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


$(".tablaEquiposGuia").on("click", ".agregarEquipoTraslado", function() {

   	var idEquipoParaTraslado = $(this).attr("idEquipoParaTraslado");

	idGuia = $('#idGuiaGenerado').val();
	idEquipo = idEquipoParaTraslado;	
	idPedidoInterno = $('#idPedidoDetalle').val();
	
	
	datos = "idGuia=" + idGuia +
		"&idEquipo=" + idEquipo +
		"&idPedidoInterno=" + idPedidoInterno;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-guia-traslado.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_pedidos();
			alertify.success("Equipo agregado a la Guía");			
			
			 idCategoria = $('#idCategoriaTxt').val();


			 $('.tablaCategoriasEquipos').DataTable().destroy();
			 recargaTablaPedido();
			 $('.tablaCategoriasEquipos').DataTable().ajax.reload();
            
	        $('.tablaEquiposGuia').DataTable().destroy();
			recargaTablaEquiposDisponibles(idCategoria);
			$('.tablaEquiposGuia').DataTable().ajax.reload();


			
			
			
		}
	});


});







$('#btnFinalizarGuia').click(function() {
	
	id = $('#idGuiaGenerado').val();
	idEmpresa = $('#idEmpresaOperativa').val();
   
	alertify.confirm('GENERAR GUIA DESPACHO', 'Esta seguro de Generar la Guía de despacho y enviarla al SII?', function() {
		finalizaGuiaDespachoArriendo(id,idEmpresa)
	}, function() {});


	 

});

function finalizaGuiaDespachoArriendo(id,idEmpresa){

	var datos = new FormData();
	datos.append("finalizaGuia", id);
	datos.append("idEmpresa", idEmpresa);


	$.ajax({
		url: "ajax/equipos-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

		
	       window.location = "index.php?ruta=pedido-interno-despacho-detalle-vista";



		}
	});

}

function eliminarConsulta(idRegistro,idEquipo) {
	
	alertify.confirm('ELIMINAR EQUIPO', 'Esta seguro de eliminar el equipo de la guía de despacho?', function() {
		elimina_equipo(idRegistro,idEquipo)
	}, function() {});
}

function elimina_equipo(idRegistro,idEquipo) {
	
	var idRegistroDetalle = idRegistro
	var idEquipo = idEquipo;
	var numeroGuiaDespacho;

	if($('#numeroGuia').val() == ''){
		numeroGuiaDespacho = 0;
	}else{
		numeroGuiaDespacho = 1;
	}

	
	var datos = new FormData();
	datos.append("idRegistroDetalle", idRegistroDetalle);
	datos.append("idEquipoDetalle", idEquipo);
	datos.append("numeroGuiaDespacho", numeroGuiaDespacho);


	$.ajax({
		url: "ajax/equipos-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			genera_tabla_pedidos();
			alertify.success("Equipo Eliminado de la guía de despacho");		
		
	   if($('#estadoGuia').val() == 12){	
			 idCategoria = $('#idCategoriaTxt').val();


			 $('.tablaCategoriasEquipos').DataTable().destroy();
			 recargaTablaPedido();
			 $('.tablaCategoriasEquipos').DataTable().ajax.reload();
            
	        $('.tablaEquiposGuia').DataTable().destroy();
			recargaTablaEquiposDisponibles(idCategoria);
			$('.tablaEquiposGuia').DataTable().ajax.reload();
		}		
			

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

		
	       window.location = "index.php?ruta=pedido-interno-despacho-detalle-vista";	 

});

$('#btnVolverValidar').click(function() {	

		
	       window.location = "index.php?ruta=pedido-interno-despacho-detalle-vista-validar";	 

});