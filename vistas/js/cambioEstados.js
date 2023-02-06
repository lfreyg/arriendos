


$('#seleccionaTipoEquipoCambio').change(function() {

	$('#codigotxt').val('');
	var idTipoEquipo = $('#seleccionaTipoEquipoCambio').val();
	$('.tablaEquiposMantenedor').DataTable().destroy();

	recargaTablaMantenedor(idTipoEquipo);
	$('.tablaEquiposMantenedor').DataTable().ajax.reload();


});


function recargaTablaMantenedor(id) {

	var idTipoEquipo = id;
	var idSucursal = $('#idSucursalActual').val();
	var codigo = '';

	$('.tablaEquiposMantenedor').DataTable({
		"ajax": {
			"url": "ajax/datatable-estado-equipos.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idTipoEquipo: idTipoEquipo,
				idSucursal: idSucursal,
				codigo: codigo
			}
		},
		"deferRender": true,
		"retrieve": true,
		"order":[[2,"asc"]],
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



function recargaTablaMantenedorCodigo(id) {

	var idTipoEquipo = id;
	var idSucursal = $('#idSucursalActual').val();
	var codigo = $('#codigotxt').val();

	$('.tablaEquiposMantenedor').DataTable({
		"ajax": {
			"url": "ajax/datatable-estado-equipos.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idTipoEquipo: idTipoEquipo,
				idSucursal: idSucursal,
				codigo: codigo
			}
		},
		"deferRender": true,
		"retrieve": true,
		"order":[[2,"asc"]],
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



$(".tablaEquiposMantenedor").on("click", ".btnEditarEquipo", function() {

	var idEquipo = $(this).attr("idEquipo");
	var idGuiaDetalle = $(this).attr("idGuiaDetalle");


	var datos = new FormData();
	datos.append("idEquipo", idEquipo);


	$.ajax({

		url: "ajax/mantenedor-equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(equipo) {
            
                 			
			var descripcion = equipo["descripcion"] + " " + equipo["modelo"] + " " + equipo["marca"];			
			
			

			       $("#eCodigoEquipo").val(equipo["codigo"]);
			       $("#eSerieEquipo").val(equipo["serie"]);
				$("#edescripcionEquipo").val(descripcion);
				$("#estado").val(equipo["estadoEquipo"]);
				$("#idEstadoActual").val(equipo["idEstado"]);
				$("#nuevoEstado").val('');
				$('#idTipoEquipo').val(equipo["idNombreEquipo"]);
				$('#idEquipo').val(equipo["idEquipo"]);	
				$('#idGuiaDetalleTxt').val(idGuiaDetalle);
				$("#motivo").val('');

				if(equipo["idEstado"] == 2){
		                 $('#divArrendado').css("display", "block");			
				}else{
				  $('#divArrendado').css("display", "none");	
				}		
				

					

		}

	});



	$("#modalCambioEstadoEquipo").modal("show");
});




$('#btnGuardarEdita').click(function() {

	
      
	idEquipo = $('#idEquipo').val();	
	idUsuario = $('#idUsuarioMan').val();
	idEstado = $('#idEstadoActual').val();
	nuevoEstado = $('#nuevoEstado').val();
	motivo = $('#motivo').val();
	fecha = $('#fecha').val();
	estadoTransitorio = 32;
	idGuiaDetalle = $('#idGuiaDetalleTxt').val();	

	if(nuevoEstado == ''){
	   alertify.error('Debe seleccionar el nuevo estado del equipo');
	   return false;	
	}

	if(motivo == ''){
	   alertify.error('Debe ingresar el motivo por el cambio de estado');
	   return false;	
	}
			
				

	datos = "idEquipo=" + idEquipo +		
		"&idUsuario=" + idUsuario +
		"&idEstado=" + idEstado +
		"&nuevoEstado=" + nuevoEstado +
		"&estadoTransitorio=" + estadoTransitorio +
		"&fechaCambio=" + fecha + 
		"&motivo=" + motivo +
		"&idGuiaDetalle=" + idGuiaDetalle;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-cambio-estado-equipo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("El cambio de estado queda en espera de aprobación");


			
			     idTipoEquipo = $('#seleccionaTipoEquipoCambio').val();
			     $('.tablaEquiposMantenedor').DataTable().destroy();
			     recargaTablaMantenedor(idTipoEquipo);
			    $('.tablaEquiposMantenedor').DataTable().ajax.reload();	

		}
	});
});



$(".tablaEquiposMantenedor").on("click", ".btnHistoria", function() {
        
       idEquipo = $(this).attr("idEquipo");   

	
	datos = "idEquipo=" + idEquipo;

	$.ajax({


		url: "ajax/tabla-historia-estados-equipos.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_historica').html(html);

		}
	});


       $("#modalHistoricoCambio").modal("show");
});





$('#btnBuscarCodigo').click(function() {

	if($('#codigotxt').val() == ''){
	     idTipoEquipo = $('#seleccionaTipoEquipoCambio').val();
	     $('.tablaEquiposMantenedor').DataTable().destroy();
	     recargaTablaMantenedor(idTipoEquipo);
	    $('.tablaEquiposMantenedor').DataTable().ajax.reload();	
           return false;		
	}
       
       
	$('.tablaEquiposMantenedor').DataTable().destroy();

	recargaTablaMantenedorCodigo('');
	$('.tablaEquiposMantenedor').DataTable().ajax.reload();


});





function tablaAprobarEstados(){	

       var idEstado = 32;
	
	$('.tablaAprobarEstados').DataTable({
		"ajax": {
			"url": "ajax/datatable-aprobar-estados.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idEstado: idEstado
				
			}
		},
		"deferRender": true,
		"retrieve": true,
		"order":[[1,"asc"]],
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No Existen Estados para Aprobar",
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



$(".tablaAprobarEstados").on("click", ".btnAprobar", function() {
       
       id = $(this).attr("id");   
       idEstado = $(this).attr("idEstado");   
       idEquipo = $(this).attr("idEquipo");
       idEstadoAnterior = $(this).attr("idEstadoAnterior");


      
	alertify.confirm('APROBAR CAMBIO ESTADO', 'Esta seguro de APROBAR el cambio de estado del equipo?', function() {
		aprobarSolicitud(id, idEstado, idEquipo, idEstadoAnterior)
	}, function() {});

       
});


function aprobarSolicitud(id,idEstado,idEquipo, idEstadoAnterior){

	 datos = "id=" + id +
	         "&idEstado=" + idEstado +
	         "&idEquipo=" + idEquipo +
	         "&idEstadoAnterior=" + idEstadoAnterior;

	$.ajax({


		url: "ajax/aprobar-nuevo-estado-equipo.ajax.php",
		method: "POST",
		data: datos,

		success: function(res) {

			alertify.success('Equipo ha quedado con nuevo Estado')

			$('.tablaAprobarEstados').DataTable().destroy();

	              tablaAprobarEstados();
	              $('.tablaAprobarEstados').DataTable().ajax.reload();

	              window.open("extensiones/pdf/TCPDF/comprobante-cambio-estado-equipo.php?id="+id, "_blank");

			

		}
	});
}






$(".tablaAprobarEstados").on("click", ".btnRechazar", function() {


	id = $(this).attr("id");   
       idEstado = $(this).attr("idEstado");   
       idEquipo = $(this).attr("idEquipo");

	alertify.confirm('RECHAZAR CAMBIO ESTADO', 'Esta seguro de RECHAZAR el cambio de estado del equipo?', function() {
		rechazarSolicitud(id,idEstado,idEquipo)
	}, function() {});


      
});

function rechazarSolicitud(id,idEstado,idEquipo){

        datos = "id=" + id +
	         "&idEstado=" + idEstado +
	         "&idEquipo=" + idEquipo;

	$.ajax({


		url: "ajax/rechazar-nuevo-estado-equipo.ajax.php",
		method: "POST",
		data: datos,

		success: function(res) {

			$('.tablaAprobarEstados').DataTable().destroy();

	              tablaAprobarEstados();
	              $('.tablaAprobarEstados').DataTable().ajax.reload();

		}
	});


}

function verComprobanteCambioEstado(id){
	 window.open("extensiones/pdf/TCPDF/comprobante-cambio-estado-equipo.php?id="+id, "_blank");
}