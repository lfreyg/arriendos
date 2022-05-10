recargaTabla();


function genera_tabla_arriendos() {

	id = $('#idGuiaGenerado').val();    

	datos = "id=" + id;

	$.ajax({


		url: "ajax/tabla-equipos-guia.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}



$(".tablaEquiposGuia tbody").on("click", "button.agregarEquipoArriendo", function() {


	var idEquipoParaArriendo = $(this).attr("idEquipoParaArriendo");

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

			               precio = formatterPeso.format(respuesta["precio"])

			                $('#idEquipoDetalle').val(respuesta["idEquipo"]);
							$('#codigoEquipo').val(respuesta["codigo"]);
							$('#serieEquipo').val(respuesta["serie"]);
							$('#descripcionEquipo').val(descripcion);
							$('#modeloEquipo').val(respuesta["modelo"]);
							$('#precioEquipo').val(precio);
							$('#precioEquipoSinFormato').val(respuesta["precio"]);
							$('#detalleEquipo').val('');	
			                //$('#guiaTipoMovimiento').val(10);


                        var datos2 = new FormData();
                        datos2.append("idTipoEquipo", idTipoEquipo);
	                    datos2.append("idObra", idObra);

	                    //alert(idTipoEquipo);
	                  //  alert(idObra);

                     $.ajax({  
			            url: "ajax/equipos-guia-arriendo.ajax.php",
						method: "POST",
						data: datos2,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(convenio) {					
						
						  if(convenio["precio"] > 0){	
								
							precio = formatterPeso.format(convenio["precio"]);
							$('#precioEquipo').val(precio);
							$('#precioEquipoSinFormato').val(convenio["precio"]);	
						  }				

		                }
		             });



			
		}

	});



});


$('#btnAgregarEquipo').click(function() {

		
	if ($('#idEquipoDetalle').val() == '') {
		alertify.error("Seleccione un equipo de la lista disponible para arriendos");
		return false;
	}

	idGuia = $('#idGuiaGenerado').val();
	idEquipo = $('#idEquipoDetalle').val();
	precio = $('#precioEquipoSinFormato').val();
	fechaArriendo = $('#fechaArriendo').val();
	detalle = $('#detalleEquipo').val();
	fechaDevolucion = $('#fechaTerminoGuia').val();	
	movimiento = $('#guiaTipoMovimiento').val();
	idEmpresa = $('#idEmpresaOperativa').val();
	
	
	datos = "idGuia=" + idGuia +
		"&idEquipo=" + idEquipo +
		"&precio=" + precio +
		"&fechaArriendo=" + fechaArriendo +
		"&detalle=" + detalle +
		"&fechaDevolucion=" + fechaDevolucion +
		"&contrato=" + idGuia +
		"&movimiento=" + movimiento +
		"&idEmpresa=" + idEmpresa;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-guia.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_arriendos();
			alertify.success("Arriendo agregado a la Guía");			
			$('#idEquipoDetalle').val('');
			$('#codigoEquipo').val('');
			$('#serieEquipo').val('');
			$('#descripcionEquipo').val('');
			$('#modeloEquipo').val('');
			$('#precioEquipo').val('');
			$('#detalleEquipo').val('');	
			$('#guiaTipoMovimiento').val(10);
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
	$('#precioEquipo').val('');
	$('#detalleEquipo').val('');	
	//$('#guiaTipoMovimiento').val(10);


	var idTipoEquipo = $('#seleccionaTipoEquipo').val();
	$('.tablaEquiposGuia').DataTable().destroy();

	recargaTabla(idTipoEquipo);
	$('.tablaEquiposGuia').DataTable().ajax.reload();


});


function recargaTabla(id) {

	var idTipoEquipo = id;

	$('.tablaEquiposGuia').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-equipos-guia.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idTipoEquipo: idTipoEquipo
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

		url: "ajax/equipos-guia-arriendo.ajax.php",
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
				$("#efechaArriendo").val(fecha);
				$("#eidArriendo").val(idRegistroDetalle);
				$('#eguiaTipoMovimiento').val(movimiento);
				$('#edetalleEquipo').val(detalle);			
				

					

		}

	});



	$("#modalEditarEquipo").modal("show");
}




$('#btnGuardarEdita').click(function() {

	

	idArriendo = $('#eidArriendo').val();
	fechaArriendo = $('#efechaArriendo').val();
	movimiento = $("#eguiaTipoMovimiento").val();
	detalle = $('#edetalleEquipo').val();
			
				

	datos = "idArriendo=" + idArriendo +
		"&fechaArriendo=" + fechaArriendo +		
		"&movimiento=" + movimiento + 
		"&detalle=" + detalle;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-detalle-guia-arriendo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Equipo actualizado");
			genera_tabla_arriendos();


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

		
	       window.location = "index.php?ruta=guia-despacho-arriendos";	 

});



function eliminarConsulta(idRegistro,idEquipo) {
	
	alertify.confirm('ELIMINAR EQUIPO', 'Esta seguro de eliminar el equipo de la guía de despacho?', function() {
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
		url: "ajax/equipos-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Equipo Eliminado de la guía de despacho");
			genera_tabla_arriendos();

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
