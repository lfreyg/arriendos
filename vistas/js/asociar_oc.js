recargaTablaOC();



function llenaConstrutoraOC() {
 

	$('.constructorasArriendosOC').DataTable({
		"ajax": {
			"url": "ajax/datatable-constructoras-oc.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
		},
		"deferRender": true,
		"order":[[1,"asc"]],
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


$(".constructorasArriendosOC").on("click", ".seleccionarConstructoraOC", function(){

	var idConstructora = $(this).attr("idConstructora");

	window.location = "index.php?ruta=obrasOC&idConstructora="+idConstructora;

});

$('#btnObraVolverOC').click(function(){ 
        
        window.location = "index.php?ruta=asociar-oc";  

}); 

$(".tablas").on("click", ".btnVerOC", function(){

	var idObra = $(this).attr("idObra");

	window.location = "index.php?ruta=obras-oc-detalle&idObra="+idObra;

}); 

$('#btnListaOCVolver').click(function(){ 
        
        window.location = "index.php?ruta=eeppProcesado";  

}); 


$('.tablaObraListaOC').DataTable( {
    "ajax": "ajax/datatable-oc-listado.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[1,"desc"]],
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


/*=============================================
EDITAR 
=============================================*/
$(".tablaObraListaOC tbody").on("click", "button.btnEditarOC", function(){

	var idOC = $(this).attr("idOC");

	var datos = new FormData();
	datos.append("idOC", idOC);

	$.ajax({
	    url:"ajax/orden-compra.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		$("#idRegistro").val(respuesta["id"]);
     		$("#nuevoNumeroOCE").val(respuesta["numero_oc"]);
     		$("#nuevoFechaOCE").val(respuesta["fecha_oc"]);


     		$("#modalEditarOC").modal("show"); 
     		   		

     	}

	})


});

/*=============================================
ELIMINAR 
=============================================*/

$(".tablaObraListaOC tbody").on("click", "button.btnEliminarOC", function(){

	var idOC = $(this).attr("idOC");
	
 
	swal({

		title: '¿Está seguro de ELIMINAR la OC?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ELIMINAR OC!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=obras-oc-detalle&idOC="+idOC;

        }


	})

});

$(".tablaObraListaOC tbody").on("click", "button.btnDetalleOC", function(){

	var idOC = $(this).attr("idOC");

	window.location = "index.php?ruta=orden-compra-detalle&idOC="+idOC;

});



//*********************************************************************************//
//****************************EQUIPOS EN EEPP**************************************//
//*********************************************************************************//

$(".tablaEquiposEEPP tbody").on("click", "button.agregarEquipo", function() {


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
					 
			              


                       

                     
		}

	});



});



function recargaTablaOC() {

	idEEPP = $('#id_eeppOCtxt').val();    

	datos = "id=" + idEEPP;

	$.ajax({


		url: "ajax/tabla-equipos-para-facturar.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#equipos_para_oc_eepp').html(html);

		}
	});

}


$('#btnAgregaOC').click(function() {

		
	if ($('#idEEPPDetalle').val() == '') {
		alertify.error("Seleccione un registro de la lista disponible para agregar a OC");
		return false;
	}


	if ($('#precioEEPP').val() == '') {
		alertify.error("Ingrese Precio para OC");
		return false;
	}

	if ($('#cantidadEEPP').val() == '') {
		alertify.error("Ingrese Cantidad para OC");
		return false;
	}

	if ($('#precioEEPP').val() <= 0) {
		alertify.error("Ingrese Precio para OC");
		return false;
	}

	if ($('#cantidadEEPP').val() <= 0) {
		alertify.error("Ingrese Cantidad para OC");
		return false;
	}
	

	idRegistroEEPPDetalle = $('#idEEPPDetalle').val();
	idConstructora = $('#idConstructora').val();
	idObra = $('#idObra').val();
	idOC = $('#idOC').val();
	numeroOC = $('#numeroOC').val();
	idEEPP = $('#id_eeppOCtxt').val();
	precio = $('#precioEEPP').val();
	cantidad = $('#cantidadEEPP').val();
	tabla = $('#tablaOrigen').val();


	
	datos = "id_oc_arriendo=" + idOC +
		"&numero_oc=" + numeroOC +
		"&id_constructora=" + idConstructora +		
		"&id_obra=" + idObra +
		"&id_eepp=" + idEEPP +		
		"&id_eepp_detalle=" + idRegistroEEPPDetalle + 
		"&precio_oc=" + precio + 
		"&cantidad_oc=" + cantidad +
		"&tabla=" + tabla;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-oc.ajax.php",
		data: datos,

		success: function(res) {
      
    
  
			genera_tabla_oc();
			recargaTablaOC();
			alertify.success("Registro de EEPP agregado a OC");			
			$('#codigoEquipo').val('');						
			$('#descripcionEquipo').val('');
			$('#precioEEPP').val('');
			$('#cantidadEEPP').val('');
			$('#idEEPPDetalle').val('');	
			$('#tablaOrigen').val('');
		
		
						
			
		}
	});

});

$('#btnVolverOC').click(function() {	
		
	       window.location = "index.php?ruta=obras-oc-detalle";	 

});

function genera_tabla_oc() {

	idOC = $('#idOC').val();    

	datos = "id=" + idOC;

	$.ajax({


		url: "ajax/tabla-equipos-en-oc.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}


function eliminarConsultaOC(idRegistro,idGuiaDetalle) {
	
	alertify.confirm('ELIMINAR REGISTRO DE OC', 'Esta seguro de ELIMINAR el registro?', function() {
		elimina_equipo_oc(idRegistro)
	}, function() {});
}

function elimina_equipo_oc(idRegistro) {
	
	var idRegistro = idRegistro
	


	var datos = new FormData();
	datos.append("idRegistro", idRegistro);
	


	$.ajax({
		 url:"ajax/orden-compra.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Registro eliminado");
			genera_tabla_oc();
			recargaTablaOC();

			


		}
	});
}

function SeleccionEquipoEEPPOC(idRegistroEquipo,codigo,descripcion,precio,saldo,tipoTabla) {

	$('#idEEPPDetalle').val(idRegistroEquipo);
	$('#codigoEquipo').val(codigo);
	$('#descripcionEquipo').val(descripcion);
	$('#precioEEPP').val(precio);
	$('#cantidadEEPP').val(saldo);
	$('#tablaOrigen').val(tipoTabla);
	$('#cantidadEEPP').focus();


}