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

			alertify.success("Equipo Eliminado de la guía de despacho");
			genera_tabla_arriendos();

			var idTipoEquipo = $('#seleccionaTipoEquipo').val();
	        $('.tablaEquiposGuia').DataTable().destroy();

			recargaTabla(idTipoEquipo);
			$('.tablaEquiposGuia').DataTable().ajax.reload();



		}
	});
}

function validarEquipoRecepcionado(idRegistro, idEquipo){

	

	var idRegistro = idRegistro;
	var idEquipo = idEquipo;		

	datos = "idRegistro=" + idRegistro +
	        "&idEquipo=" + idEquipo;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-validacion-equipo-guia-arriendo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Entrega VALIDADA por bodega");
			genera_tabla_arriendos();


		}
	});
}

function quitarvalidarEquipoRecepcionado(idRegistro, idEquipo){

	

	var idRegistro = idRegistro;
	var idEquipo = idEquipo;		

	datos = "idRegistro=" + idRegistro +
	        "&idEquipo=" + idEquipo;


	$.ajax({

		type: "POST",
		url: "ajax/quitar-validacion-equipo-guia-arriendo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Validación de entrega ANULADA");
			genera_tabla_arriendos();


		}
	});
}



const formatterPeso = new Intl.NumberFormat('es-CO', {
       style: 'currency',
       currency: 'COP',
       minimumFractionDigits: 0
     })






//***********************************************
//DESDE AQUI METODOS Y FUNCIONES PARA MANEJO DE CLASE MATERIALES
//************************************************


//ACTIVA TABLA E INPUT MATERIALES
$('#verMateriales').click(function() {

     	     // $('#divEquipos').css("display", "block");
     	       $('#divEquipos').css("display", "none");
     	       $('#divTablaEquipos').css("display", "none");
     	       
     	       
     	       $('#divTablaMateriales').css("display", "block");
              $('#divMateriales').css("display", "block");

              $('#idMaterial').val('');
		$('#codigoMaterial').val('');
		$('#descripcionMaterial').val('');
		$('#precioMaterial').val('');
		$('#precioMaterialSinFormato').val('');
		$('#cantidadMaterial').val('');
		$('#chkCobraMaterial').prop("checked", false);
		
		$('.tablaMaterialesGuia').DataTable().destroy();

		recargaMateriales();
		$('.tablaMaterialesGuia').DataTable().ajax.reload();
            
            
});


//ACTIVA TABLA E INPUT EQUIPOS
$('#verEquipos').click(function() {

     	     // $('#divEquipos').css("display", "block");
     	      $('#divTablaMateriales').css("display", "none");
             $('#divMateriales').css("display", "none");

     	      $('#divEquipos').css("display", "block");
     	      $('#divTablaEquipos').css("display", "block");

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



//TABLA DE MATERIALES

function recargaMateriales() {

	idTipoEquipo = '';

	$('.tablaMaterialesGuia').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-materiales-guia.ajax.php",
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
			"sEmptyTable": "No Existen materiales disponibles",
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

//BOTON SELECCION EQUIPO PARA AGREGAR CANTIDADES

$(".tablaMaterialesGuia").on("click", ".agregarMaterial", function() {
       
           
	var idMaterialArriendo = $(this).attr("idMaterial");
	
	var datos = new FormData();
	datos.append("idMaterialArriendo", idMaterialArriendo);

	$.ajax({

		url: "ajax/materiales-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			var id = respuesta["id"];
			var codigo = respuesta["codigo"];
			var descripcion = respuesta["descripcion"];
			var detalle = respuesta["detalle"];
			var precio = formatterPeso.format(respuesta["precio"]);
			var precioSF = respuesta["precio"];
			var stock = respuesta["stock"];

			$('#idMaterial').val(id);
		       $('#codigoMaterial').val(codigo);
			$('#descripcionMaterial').val(descripcion);
			$('#precioMaterial').val(precio);
			$('#precioMaterialSinFormato').val(precioSF);
			$('#stock').val(stock);
			$('#cantidadMaterial').val('');
			$('#chkCobraMaterial').prop("checked", false);
			$('#cantidadMaterial').focus();

			               

	                  


			
		}

	});



});


//BOTON PARA AGREGAR MATERIAL A LA GUIA

$('#btnAgregarMaterial').click(function() {

     	     if ($('#idMaterial').val() == '') {
		alertify.error("Seleccione un Insumo o material de la lista disponible");
		return false;
	     }

	     if ($('#cantidadMaterial').val() == '') {
		alertify.error("Ingrese cantidad a despachar");		
		$('#cantidadMaterial').focus();
		return false;
	     }

     	     var stock = $('#stock').val();
     	     var cantidad = $('#cantidadMaterial').val();

     	     if (parseInt(cantidad) <= 0) {
		alertify.error("La cantidad no puede ser igual o menor a cero");
		$('#cantidadMaterial').val('');
		$('#cantidadMaterial').focus();
		return false;
	     }

            if(parseInt(cantidad) > parseInt(stock)){
            	alertify.error('Stock insufiente');
            	$('#cantidadMaterial').val('');
            	$('#cantidadMaterial').focus();
            	return false;
            }

     	     cobra = 0;

     	     if ($('#chkCobraMaterial').prop('checked'))
		{
		cobra = 1;
		}

	idGuia = $('#idGuiaGenerado').val();
	idMaterial = $('#idMaterial').val();
	cantidad = $('#cantidadMaterial').val();
	precio = $('#precioMaterialSinFormato').val();
	fecha = $('#fechaGuia').val();
	seCobra = cobra;	
	idEmpresa = $('#idEmpresaOperativa').val();
	
	
	datos = "idGuia=" + idGuia +
		"&idMaterial=" + idMaterial +
		"&cantidad=" + cantidad +
		"&precio=" + precio +
		"&fecha=" + fecha +
		"&seCobra=" + seCobra +		
		"&idEmpresa=" + idEmpresa;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-material-detalle-guia.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_arriendos();
			alertify.success("Insumo agregado a la Guía");			
			$('#idMaterial').val('');
			$('#codigoMaterial').val('');
			$('#descripcionMaterial').val('');
			$('#precioMaterial').val('');
			$('#precioMaterialSinFormato').val('');
			$('#cantidadMaterial').val('');
			$('#chkCobraMaterial').prop("checked", false);
			
			$('.tablaMaterialesGuia').DataTable().destroy();

			recargaMateriales();
			$('.tablaMaterialesGuia').DataTable().ajax.reload();
			
			
		}
	});	

     	                
            
});

function editarMaterialGuia(id) {

	var idRegistroMaterialGuia = id;

	var datos = new FormData();
	datos.append("idRegistroMaterialGuia", idRegistroMaterialGuia);

	$.ajax({

		url: "ajax/materiales-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(material) {
            

			var idRegistroDetalle = material["idRegistro"];
			var idMaterial = material["idMaterial"];

			var codigo = material["codigo"];
			var descripcion = material["material"];			
			var stock = material["stock"];
			var precio = material["precio"];
			var cantidad = material["cantidad"];
			var seCobra = material["cobra"];


			       $("#eidMaterial").val(idMaterial);
			       $("#eidRegistro").val(idRegistroDetalle);

			       $("#ecodigoMaterial").val(codigo);
				$("#edescripcionMaterial").val(descripcion);
				$("#eprecioMaterial").val(precio);				
				$('#estock').val(stock);
				$('#ecantidadMaterial').val(cantidad);
				$('#ecantidadActual').val(cantidad);

			      if(seCobra == 1){
			      	 $('#echkCobraMaterial').prop("checked", true);
			      }else{
			      	$('#echkCobraMaterial').prop("checked", false);
			      }			
				

					

		}

	});



	$("#modalEditarMaterial").modal("show");
}

$('#btnGuardarEditaMaterial').click(function() {
       
           if ($('#ecantidadMaterial').val() == '') {
		alertify.error("Ingrese cantidad a despachar");		
		$('#ecantidadMaterial').focus();
		return false;
	     }

     	     var stock = $('#estock').val();
     	     var cantidad = $('#ecantidadMaterial').val();
     	     var cantidadActual = $('#ecantidadActual').val();

     	     if (parseInt($('#ecantidadMaterial').val()) <= 0) {
		alertify.error("La cantidad no puede ser igual o menor a cero");
		$('#ecantidadMaterial').val(cantidadActual);
		$('#ecantidadMaterial').focus();
		return false;
	     }

	       
            if(parseInt(cantidad) > (parseInt(stock) + parseInt(cantidadActual))){
            	alertify.error('Stock insufiente');
            	$('#ecantidadMaterial').val(cantidadActual);
            	$('#ecantidadMaterial').focus();
            	return false;
            }
	
	

	idMaterial = $('#eidMaterial').val();
	idRegistro = $('#eidRegistro').val();
	precio = $('#eprecioMaterial').val();
	cantidad = $("#ecantidadMaterial").val();
	cantidadActual = $('#ecantidadActual').val();

	 cobra = 0;

     	     if ($('#echkCobraMaterial').prop('checked'))
		{
		cobra = 1;
		}
			
				

	datos = "idMaterial=" + idMaterial +
		"&idRegistro=" + idRegistro +		
		"&precio=" + precio + 
		"&cantidad=" + cantidad +
		"&cantidadActual=" + cantidadActual +
		"&cobra=" + cobra;


	$.ajax({

		type: "POST",
		url: "ajax/edita-material-detalle-guia-arriendo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Registro actualizado");
			genera_tabla_arriendos();
			$('.tablaMaterialesGuia').DataTable().destroy();

			recargaMateriales();
			$('.tablaMaterialesGuia').DataTable().ajax.reload();


		}
	});
});

function eliminarConsultaMaterial(idRegistro,idMaterial) {
	
	alertify.confirm('ELIMINAR INSUMO', 'Esta seguro de eliminar el Registro de la guía de despacho?', function() {
		elimina_material(idRegistro,idMaterial)
	}, function() {});
}

function elimina_material(idRegistro,idMaterial) {
	
	var idRegistroGuia = idRegistro
	var idMaterial = idMaterial;
	var numeroGuiaDespacho;

	if($('#numeroGuia').val() == ''){
		numeroGuiaDespacho = 0;
	}else{
		numeroGuiaDespacho = 1;
	}

	
	var datos = new FormData();
	datos.append("idRegistroGuia", idRegistroGuia);
	datos.append("idMaterial", idMaterial);
	datos.append("numeroGuiaDespacho", numeroGuiaDespacho);


	$.ajax({
		url: "ajax/materiales-guia-arriendo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Insumo Eliminado de la guía de despacho");
			genera_tabla_arriendos();
			$('.tablaMaterialesGuia').DataTable().destroy();

			recargaMateriales();
			$('.tablaMaterialesGuia').DataTable().ajax.reload();



		}
	});
}

function validarMaterialRecepcionado(idRegistro){

	

	var idRegistro = idRegistro;
			

	datos = "idRegistro=" + idRegistro;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-validacion-material-guia-arriendo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Entrega VALIDADA por bodega");
			genera_tabla_arriendos();


		}
	});
}

function quitarvalidarMaterialRecepcionado(idRegistro){

	

	var idRegistro = idRegistro;
	

	datos = "idRegistro=" + idRegistro;


	$.ajax({

		type: "POST",
		url: "ajax/quitar-validacion-material-guia-arriendo.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Validación de entrega ANULADA");
			genera_tabla_arriendos();


		}
	});
}