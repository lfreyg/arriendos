recargaTabla();


function genera_tabla_retiro() {

	id = $('#idReport').val();    

	datos = "id=" + id;

	$.ajax({


		url: "ajax/tabla-equipos-retirados.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}



$(".tablaEquiposGuia tbody").on("click", "button.agregarEquipo", function() {


	var idEquipoParaArriendo = $(this).attr("idEquipoParaRetiro");
	var idGuiaDetalle = $(this).attr("idGuiaDetalle");

	var datos = new FormData();
	datos.append("idEquipoParaArriendo", idEquipoParaArriendo);

	$.ajax({

		url: "ajax/equipos-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			var descripcion = respuesta["descripcion"] + ' ' + respuesta["marca"];
			var idTipoEquipo = respuesta["idTipoEquipo"];
			var idObra = $('#idObra').val();			              

			                $('#idGuiaDetalle').val(idGuiaDetalle);
			                $('#idEquipoDetalle').val(respuesta["idEquipo"]);
					  $('#codigoEquipo').val(respuesta["codigo"]);
					  $('#serieEquipo').val(respuesta["serie"]);
					  $('#descripcionEquipo').val(descripcion);
					  $('#modeloEquipo').val(respuesta["modelo"]);	
					  $('#detalleEquipo').val('');
					  $('#detalleEquipo').focus();	
			               // $('#reportTipoMovimiento').val(15);


                       

                     
		}

	});



});


$('#btnRetirarEquipo').click(function() {

		
	if ($('#idEquipoDetalle').val() == '') {
		alertify.error("Seleccione un equipo de la lista disponible para retiro");
		return false;
	}

	idRegistroGuiaDetalle = $('#idGuiaDetalle').val();
	idEquipo = $('#idEquipoDetalle').val();	
	fechaRetiro = $('#fechaRetiro').val();
	detalle = $('#detalleEquipo').val();		
	movimiento = $('#reportTipoMovimiento').val();	
	idReportDevolucion = $('#idReport').val();
	
	datos = "idRegistroGuiaDetalle=" + idRegistroGuiaDetalle +
		"&idEquipo=" + idEquipo +		
		"&fechaRetiro=" + fechaRetiro +
		"&detalle=" + detalle +		
		"&movimiento=" + movimiento + 
		"&idReportDevolucion=" + idReportDevolucion;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-report.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_retiro();
			alertify.success("Retiro realizado");			
			$('#codigoEquipo').val('');
			$('#serieEquipo').val('');			
			$('#descripcionEquipo').val('');
			$('#modeloEquipo').val('');			
			$('#detalleEquipo').val('');	
			$('#reportTipoMovimiento').val(15);
			var idTipoEquipo = $('#seleccionaTipoEquipo').val();
	        $('.tablaEquiposGuia').DataTable().destroy();

			recargaTabla(idTipoEquipo);
			$('.tablaEquiposGuia').DataTable().ajax.reload();
			
			
		}
	});

});



$('#seleccionaTipoEquipo').change(function() {

	$('#idEquipoDetalle').val('');
	$('#codigoEquipo').val('');
	$('#serieEquipo').val('');
	$('#descripcionEquipo').val('');
	$('#modeloEquipo').val('');	
	$('#detalleEquipo').val('');	
	//$('#guiaTipoMovimiento').val(10);


	var idTipoEquipo = $('#seleccionaTipoEquipo').val();
	$('.tablaEquiposGuia').DataTable().destroy();

	recargaTabla(idTipoEquipo);
	$('.tablaEquiposGuia').DataTable().ajax.reload();


});


function recargaTabla(id) {

	var idTipoEquipo = id;
	var idObra =  $('#idObra').val();

	$('.tablaEquiposGuia').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-equipos-report.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idTipoEquipo: idTipoEquipo,
				idObra: idObra
			}
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No Existen equipos disponibles",
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

	var idArriendo = id;

	var datos = new FormData();
	datos.append("idArriendo", idArriendo);

	$.ajax({

		url: "ajax/equipos-report-retiro.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(equipo) {
            

			var idRegistroDetalle = equipo["idRegistro"];
			var codigo = equipo["codigo"];
			var descripcion = equipo["equipo"] + " " + equipo["modelo"] + " " + equipo["marca"];			
			var fecha = equipo["fecha"];
			var movimiento = equipo["movimiento"];
			var detalle = equipo["detalle"];


			

			       $("#ecodigoEquipo").val(codigo);
				$("#edescripcionEquipo").val(descripcion);
				$("#efechaTermino").val(fecha);
				$("#eidArriendo").val(idRegistroDetalle);
				$('#eReportTipoMovimiento').val(movimiento);
				$('#edetalleEquipo').val(detalle);			
				

					

		}

	});



	$("#modalEditarEquipo").modal("show");
}




$('#btnGuardarEdita').click(function() {

	

	idArriendo = $('#eidArriendo').val();
	fechaTermino = $('#efechaTermino').val();
	movimiento = $("#eReportTipoMovimiento").val();
	detalle = $('#edetalleEquipo').val();
			
				

	datos = "idArriendo=" + idArriendo +
		"&fechaTermino=" + fechaTermino +		
		"&movimiento=" + movimiento + 
		"&detalle=" + detalle;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-detalle-report-devolucion.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Retiro actualizado");
			genera_tabla_retiro();


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

		
	       window.location = "index.php?ruta=guia-despacho-arriendos";



		}
	});

}


$('#btnVolver').click(function() {	

		
	       window.location = "index.php?ruta=devolucion-equipos-arriendos";	 

});



function eliminarConsulta(idRegistro,idEquipo) {
	
	alertify.confirm('ANULAR RETIRO', 'Esta seguro de ANULAR el retiro de este equipo?', function() {
		elimina_equipo(idRegistro,idEquipo)
	}, function() {});
}

function elimina_equipo(idRegistro,idEquipo) {
	
	var idRegistroDetalle = idRegistro
	var idEquipo = idEquipo;


	var datos = new FormData();
	datos.append("idRegistroDetalle", idRegistroDetalle);
	datos.append("idEquipoDetalle", idEquipo);


	$.ajax({
		url: "ajax/equipos-report-retiro.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Retiro anulado para este equipo");
			genera_tabla_retiro();

			var idTipoEquipo = $('#seleccionaTipoEquipo').val();
	        $('.tablaEquiposGuia').DataTable().destroy();

			recargaTabla(idTipoEquipo);
			$('.tablaEquiposGuia').DataTable().ajax.reload();



		}
	});
}



const formatterPeso = new Intl.NumberFormat('es-CO', {
       style: 'currency',
       currency: 'COP',
       minimumFractionDigits: 0
     })
