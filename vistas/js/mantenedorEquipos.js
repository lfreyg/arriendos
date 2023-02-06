


$('#seleccionaTipoEquipo').change(function() {

	var idTipoEquipo = $('#seleccionaTipoEquipo').val();
	$('.tablaEquiposMantenedor').DataTable().destroy();

	recargaTablaMantenedor(idTipoEquipo);
	$('.tablaEquiposMantenedor').DataTable().ajax.reload();


});


function recargaTablaMantenedor(id) {

	var idTipoEquipo = id;

	$('.tablaEquiposMantenedor').DataTable({
		"ajax": {
			"url": "ajax/datatable-mantenedor-equipos.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idTipoEquipo: idTipoEquipo
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
				$("#ePrecioEquipo").val(equipo["precio"]);
				$("#sucursalCompra").val(equipo["idSucursal"]);
				$('#idTipoEquipo').val(equipo["idNombreEquipo"]);
				$('#idEquipo').val(equipo["idEquipo"]);			
				

					

		}

	});



	$("#modalEditarEquipo").modal("show");
});




$('#btnGuardarEdita').click(function() {

	
      
	idEquipo = $('#idEquipo').val();
	codigoEquipo = $('#eCodigoEquipo').val();
	serieEquipo = $("#eSerieEquipo").val();
	precioCompra = $('#ePrecioEquipo').val();
	sucursal = $('#sucursalCompra').val();
	idUsuario = $('#idUsuarioMan').val();
			
				

	datos = "idEquipo=" + idEquipo +
		"&codigoEquipo=" + codigoEquipo +		
		"&serieEquipo=" + serieEquipo + 
		"&precioCompra=" + precioCompra +
		"&sucursal=" + sucursal +
		"&idUsuario=" + idUsuario;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-mantenedor.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Equipo actualizado");
			var idTipoEquipo = $('#seleccionaTipoEquipo').val();
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


		url: "ajax/tabla-equipos-mantenedor-origen.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_equipos_inicio').html(html);

		}
	});


       $("#modalHistorico").modal("show");
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
