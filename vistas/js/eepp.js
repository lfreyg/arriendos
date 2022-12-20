/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/

function llenaClientesEEPP(fecha) {
  var fecha = fecha;

	$('.constructorasDisponibles').DataTable({
		"ajax": {
			"url": "ajax/datatable-clientes-disponibles-eepp.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				fecha: fecha
			}
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

$('#fechaCorte').change(function() {

	fecha = $('#fechaCorte').val(); 
         $('.constructorasDisponibles').DataTable().destroy();

			llenaClientesEEPP(fecha);
			$('.constructorasDisponibles').DataTable().ajax.reload(); 
   

	});



$(".constructorasDisponibles").on("click", ".seleccionarCliente", function(){

	var idConstructora = $(this).attr("idConstructora");

	window.location = "index.php?ruta=obrasEEPP&idConstructora="+idConstructora;

});

$('#btnObraVolverEEPP').click(function(){ 
        
        window.location = "index.php?ruta=eepp";  

});  



$(".tablas").on("click", ".btnProcesaEEPP", function(){

	var idObra = $(this).attr("idObra");

	window.location = "index.php?ruta=equiposEEPP&idObra="+idObra;

}); 

$('#btnEquiposVolverEEPP').click(function(){ 
        
        window.location = "index.php?ruta=obrasEEPP";  

}); 


function genera_tabla_cobro(idObra, fecha) {

	idObra = idObra;
	fecha = fecha;


	datos = "idObra=" + idObra +
	        "&fecha=" + fecha;


	$.ajax({


		url: "ajax/tabla-equipos-cobro-eepp.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#equipos_cobro").html("");      
			$('#equipos_cobro').html(html);

		}
	});
}

$('#btnEquiposProcesarEEPP').click(function(){ 
        
  idConstructora = $('#idConstructora').val();
	idObra = $('#idObra').val();
	fecha = $('#fecha').val();
	
	
	
	datos = "idConstructora=" + idConstructora +
		"&idObra=" + idObra +
		"&fecha=" + fecha;
		
	
	$.ajax({

		type: "POST",
		url: "ajax/generarEEPP.ajax.php",
		data: datos,
		

		success: function(res) {

				
	               window.location = "index.php?ruta=eeppProcesado"; 
	              		

					
			
		}
	});	 

});  


function llenaEquiposProcesados(idEEPP) {
  
  var idEEPP = idEEPP;
  idObra = $('#idObraEEPP').val();


	datos = "idEEPP=" + idEEPP +
	         "&idObra=" + idObra;


	$.ajax({


		url: "ajax/tabla-equipos-procesados-eepp.ajax.php",
		method: "POST",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#equipos_cobrados_eepp").html("");      
			$('#equipos_cobrados_eepp').html(html);

		}
	});

	


} 

function llenaMaterialesProcesados(idEEPP) {
  
  var idEEPP = idEEPP;


	datos = "idEEPP=" + idEEPP;


	$.ajax({


		url: "ajax/tabla-materiales-procesados-eepp.ajax.php",
		method: "POST",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#materiales_cobrados_eepp").html("");      
			$('#materiales_cobrados_eepp').html(html);

		}
	});
}

	function llenaDescuentosExtras(idEEPP) {
  
  var idEEPP = idEEPP;


	datos = "idEEPP=" + idEEPP;


	$.ajax({


		url: "ajax/tabla-descuentos-extras-eepp.ajax.php",
		method: "POST",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#descuentos_extras_eepp").html("");      
			$('#descuentos_extras_eepp').html(html);

		}
	});
} 

$('#btnEEPPGeneradoVolver').click(function(){ 

	var esEditar = $('#esEditar').val()

	if(esEditar == 0){
				var idConstructora = $(this).attr("idConstructora");
				window.location = "index.php?ruta=obrasEEPP";
	}else{
		   window.location = "index.php?ruta=eeppEdita";
	}

});



$('#btnGuardarDescuentoEEPP').click(function(){ 

	   if($('#motivoDescuentoEEPP_Txt').val() == ''){
	   	alertify.error('Debe ingresar la descripción del descuento');
	   	$('#motivoDescuentoEEPP_Txt').focus();
	   	return false;
	   }

	   if($('#montoDescuentoEEPP_Txt').val() == '' || $('#montoDescuentoEEPP_Txt').val() <= 0 ){
	   	alertify.error('El monto del descuento debe ser mayor a cero');
	   	$('#montoDescuentoEEPP_Txt').focus();
	   	return false;
	   }

	   motivo = $('#motivoDescuentoEEPP_Txt').val();
	   monto = $('#montoDescuentoEEPP_Txt').val();
	   id = $('#idDescuento').val();
	   tipo = $('#tipoDescuento').val();
	   idEEPP = $('#idEEPPCobro').val();

	   datos = "motivo=" + motivo +
						"&monto=" + monto +
						"&id=" + id + 
						"&tipo=" + tipo +
						"&idEEPP=" + idEEPP;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-descuento-extra-eepp.ajax.php",
		data: datos,

		success: function(res) {

			var idEEPP = $('#idEEPPCobro').val();     
      llenaDescuentosExtras(idEEPP);

						
		}
	});
});



$('#btnGuardarExtraEEPP').click(function(){ 

	   if($('#motivoExtraEEPP_Txt').val() == ''){
	   	alertify.error('Debe ingresar la descripción del cobro extra');
	   	$('#motivoExtraEEPP_Txt').focus();
	   	return false;
	   }

	   if($('#montoExtraEEPP_Txt').val() == '' || $('#montoExtraEEPP_Txt').val() <= 0 ){
	   	alertify.error('El monto del cobro extra debe ser mayor a cero');
	   	$('#montoExtraEEPP_Txt').focus();
	   	return false;
	   }

	   motivo = $('#motivoExtraEEPP_Txt').val();
	   monto = $('#montoExtraEEPP_Txt').val();
	   id = $('#idExtra').val();
	   tipo = $('#tipoExtra').val();
	   idEEPP = $('#idEEPPCobro').val();

	   datos = "motivo=" + motivo +
						"&monto=" + monto +
						"&id=" + id + 
						"&tipo=" + tipo +
						"&idEEPP=" + idEEPP;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-descuento-extra-eepp.ajax.php",
		data: datos,

		success: function(res) {

			var idEEPP = $('#idEEPPCobro').val();     
      llenaDescuentosExtras(idEEPP);

						
		}
	});
});




$('#btnEEPPGeneradoAnular').click(function(){ 
    idEEPP = $('#idEEPPCobro').val();
	  alertify.confirm('ANULAR EEPP', 'Esta seguro de Anular el presente EEPP?', function() {
		anula_eepp(idEEPP)
	}, function() {});
});





function anula_eepp(idEEPP){
	
	datos = "idEEPP=" + idEEPP; 

	$.ajax({

		type: "POST",
		url: "ajax/anularEEPP.ajax.php",
		data: datos,
		

		success: function(res) {

			      var esEditar = $('#esEditar').val()

								if(esEditar == 0){
											var idConstructora = $(this).attr("idConstructora");
											window.location = "index.php?ruta=equiposEEPP";
								}else{
									   window.location = "index.php?ruta=eeppEdita";
								}

			
		}
	});	 


}

$('#btnEEPP_PDF').click(function(){ 

	idEEPP = $('#idEEPPCobro').val();
	idObra = $('#idObraEEPP').val();

	window.open("extensiones/pdf/TCPDF/eepp.php?id="+idEEPP+"&idObra="+idObra, "_blank");

});


$('#btnEEPP_Excel').click(function(){ 

	idEEPP = $('#idEEPPCobro').val();


	window.open("ajax/excelEEPP_procesado.php?idEEPP="+idEEPP);

});

function editarEquipoEEPP(idRegistro, idEEPP, idGuiaDetalle){

	var idRegistro = idRegistro;

       
	var datos = new FormData();
	datos.append("idRegistro", idRegistro);

	$.ajax({

		url: "ajax/mantenedor-eepp-procesado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(eepp) {
            
                 			
			var descripcion = eepp["descripcion"] + " " + eepp["modelo"] + " " + eepp["marca"];			
			
			

			  
			  $("#idRegitroEdita").val(idRegistro);
			  $("#idEEPPEdita").val(idEEPP);
			  $("#idGuiaEEPPEdita").val(idGuiaDetalle);

			  $("#codigoEquipoEEPPtxt").val(eepp["codigo"]);
			  $("#equipoEEPPtxt").val(descripcion);

			  $("#precioEquiposEEPP").val(eepp["precio"]);
			  $("#fechaDesdeEditaEquipo").val(eepp["cobro_desde"]);
			  $("#fechaHastaEditaEquipo").val(eepp["cobro_hasta"]);
			  		
				

		}

	});


  
  $("#modalEditarEquipos").modal("show"); 

}	


$('#btnGuardarEditaEquipoEEPP').click(function(){ 

	idRegistro = $('#idRegitroEdita').val();
	idEEPP = $('#idEEPPEdita').val();
	idGuia = $('#idGuiaEEPPEdita').val();
	ultimo = $('#ultimoEEPP').val();
	precio = $('#precioEquiposEEPP').val();
	desde = $('#fechaDesdeEditaEquipo').val();
	hasta = $('#fechaHastaEditaEquipo').val();
	cierre = $('#fechaEEPPEdita').val();

	if(hasta > cierre){
		alertify.error("La Fecha final, no puede ser mayor a la fecha de cierre");
		return false;
	}

	if(desde > hasta){
		alertify.error("La Fecha final, no puede ser menor a la fecha inicial");
		return false;
	}
  

  datos = "idRegistro=" + idRegistro +
		"&idEEPP=" + idEEPP +		
		"&idGuia=" + idGuia + 
		"&ultimo=" + ultimo +
		"&precio=" + precio +
		"&desde=" + desde + 
		"&hasta=" + hasta ;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-eepp-procesado.ajax.php",
		data: datos,

		success: function(res) {
     
     if(ultimo == 1){
			  alertify.success("Equipo actualizado en el EEPP y en Guia de despacho");
			}else{
				alertify.success("Equipo actualizado");
			}
			

			llenaEquiposProcesados(idEEPP);

		}

	});



});


function eliminarConsulta(idRegistro, idEEPP, idGuiaDetalle){

	alertify.confirm('ELIMINAR EQUIPO EEPP', 'Esta seguro de eliminar el equipo del EEPP?', function() {
		elimina_equipo_eepp(idRegistro,idEEPP,idGuiaDetalle)
	}, function() {});
}

function elimina_equipo_eepp(idRegistro, idEEPP, idGuiaDetalle) {
	
	var idRegistro = idRegistro
	var idEEPP = idEEPP;
	var idGuiaDetalle = idGuiaDetalle;
	var ultimo = $('#ultimoEEPP').val();

		
	var datos = new FormData();
	datos.append("idRegistroElimina", idRegistro);
	datos.append("idEEPPElimina", idEEPP);
	datos.append("idGuiaDetalleElimina", idGuiaDetalle);
	datos.append("ultimoElimina", ultimo);


	$.ajax({
		url: "ajax/mantenedor-eepp-procesado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			if(ultimo == 1){
			  alertify.success("Equipo Eliminado del EEPP y reestablecido el último cobro en la Guía de despacho");		
			}else{
				alertify.success("Equipo Eliminado del EEPP");
		
			}
				
				llenaEquiposProcesados(idEEPP);



		}
	});
}


function eliminarConsultaExtra(idRegistro){

	alertify.confirm('ELIMINAR COBROS ADICIONALES', 'Esta seguro de eliminar el registro del EEPP?', function() {
		elimina_extra_eepp(idRegistro)
	}, function() {});
}

function elimina_extra_eepp(idRegistro) {
	
	var idRegistroExtra = idRegistro
	
   var idEEPP = $('#idEEPPCobro').val(); 
		
	var datos = new FormData();
	datos.append("idRegistroExtra", idRegistroExtra);
	

	$.ajax({
		url: "ajax/mantenedor-eepp-procesado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Registro Extra Eliminado del EEPP");
			llenaDescuentosExtras(idEEPP);



		}
	});
}


function editarMaterialesEEPP(idRegistro, idEEPP, idGuiaDetalle){

	var idRegEEPP = idRegistro
	var idEEPPMaterial = idEEPP;
	var idGuiaMaterial = idGuiaDetalle;
	

       
	var datos = new FormData();
	datos.append("idEEPPMaterial", idRegEEPP);
	

	$.ajax({

		url: "ajax/mantenedor-eepp-procesado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(eepp) {
			  
			  $("#idRegitroEditaMaterial").val(idRegEEPP);
			  $("#idEEPPEditaMaterial").val(idEEPPMaterial);
			  $("#idGuiaEEPPEditaMaterial").val(idGuiaMaterial);

			  $("#codigoMaterialEEPPtxt").val(eepp["codigo"]);
			  $("#materialEEPPtxt").val(eepp["material"]);

			  $("#precioMaterialEEPP_Txt").val(eepp["precio"]);

		}

	});


  
  $("#modalEditarMaterialesEEPP").modal("show"); 

}	


$('#btnGuardarEditaMaterialEEPP').click(function(){ 

	idRegistro = $('#idRegitroEditaMaterial').val();
	idEEPP = $('#idEEPPEditaMaterial').val();
	idGuia = $('#idGuiaEEPPEditaMaterial').val();
	precio = $('#precioMaterialEEPP_Txt').val();
	


	if(precio <= 0){
		alertify.error("El precio, no puede ser menor o igual a cero");
		return false;
	}

	 

  datos = "idRegistro=" + idRegistro +
		"&idEEPP=" + idEEPP +		
		"&idGuia=" + idGuia + 
		"&precio=" + precio;
		

	$.ajax({

		type: "POST",
		url: "ajax/edita-material-eepp-procesado.ajax.php",
		data: datos,

		success: function(res) {
     
    
			  alertify.success("Precio actualizado en el EEPP y en Guia de despacho");
		
			
			 llenaMaterialesProcesados(idEEPP);

		}

	});



});

function eliminarConsultaMaterialEEPP(idRegistro, idEEPP, idGuiaDetalle){

	alertify.confirm('ELIMINAR INSUMO / MATERIAL', 'Esta seguro de eliminar cobro del insumo o material del EEPP?', function() {
		elimina_material_eepp(idRegistro, idEEPP, idGuiaDetalle)
	}, function() {});
}


function elimina_material_eepp(idRegistro, idEEPP, idGuiaDetalle) {
	
	var idRegistroEliMaterial = idRegistro;	  
	var idGuiaEliMaterial = idGuiaDetalle;

  		
	var datos = new FormData();
	datos.append("idRegistroEliMaterial", idRegistroEliMaterial);	
	datos.append("idGuiaEliMaterial", idGuiaEliMaterial);
	


	$.ajax({
		url: "ajax/mantenedor-eepp-procesado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

		
			  alertify.success("Cobro de insumo o material Eliminado del EEPP y reestablecido para ser cobrado en otra ocasión");		
		
				
				 llenaMaterialesProcesados(idEEPP);



		}
	});
}

$('#btnGuardarDiaDescuento').click(function(){ 

	   idEEPP = $('#idEEPPCobro').val();
	   desde =  $('#diaDescuentoDesde').val();
	   hasta = $('#diaDescuentoHasta').val();
	   tipoCobro = $('#tipoCobroTxt').val();



			 
			if(desde > hasta){
				alertify.error("La Fecha final, no puede ser menor a la fecha inicial");
				return false;
			}

	   
	   datos = "idEEPP=" + idEEPP +
						"&desde=" + desde +
						"&hasta=" + hasta +
						"&tipoCobro=" + tipoCobro;



	$.ajax({

		type: "POST",
		url: "ajax/guarda-dias-descuento-eepp.ajax.php",
		data: datos,

		success: function(res) {

		   alertify.success("Se agregaron días de descuentos");	
		    llenaEquiposProcesados(idEEPP);	
			  llenaDiasDescuentos(idEEPP);
		
    

						
		}
	});
});


function llenaDiasDescuentos(idEEPP) {
  
  var idEEPP = idEEPP;


	datos = "idEEPP=" + idEEPP;


	$.ajax({


		url: "ajax/tabla-dias-descuentos-eepp.ajax.php",
		method: "POST",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#dias_descuento_eepp").html("");      
			$('#dias_descuento_eepp').html(html);

		}
	});
} 

function eliminarConsultaDiaDescuento(idRegistro){

	alertify.confirm('ELIMINAR DÍA DESCUENTO', 'Esta seguro de eliminar el día de descuento?', function() {
		elimina_dia_descuento(idRegistro)
	}, function() {});
}

function elimina_dia_descuento(idRegistro) {
	
	var idDiaDescuento = idRegistro;	  
	idEEPP = $('#idEEPPCobro').val();

  		
	var datos = new FormData();
	datos.append("idDiaDescuento", idDiaDescuento);	
	
	

	$.ajax({
		url: "ajax/mantenedor-eepp-procesado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

		
			  alertify.success("Día de descuento eliminado");		
		
				 llenaEquiposProcesados(idEEPP);	
				 llenaDiasDescuentos(idEEPP);



		}
	});
}


function EEPPGenerados() {
  
   var mes = $('#cmbMesEEPP').val();
   var anno = $('#CmbAnnoEEPP').val();

   var datos = new FormData();
	datos.append("mes", mes);	
	datos.append("anno", anno);	


	$('.tablaEEPPGenerados').DataTable({
		"ajax": {
			"url": "ajax/datatable-eepp-generados.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				mes: mes,	anno: anno
			}
		},
		"deferRender": true,
		"order":[[1,"asc"]],
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "NO SE ENCONTRARON EEPP PARA EDITAR",
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


$(".tablaEEPPGenerados").on("click", ".seleccionaEEPP", function(){

	var idEEPP = $(this).attr("idEEPP");
	var idObra = $(this).attr("idObra");
	var fechaEEPP = $(this).attr("fechaEEPP");
	var edita = 1;
	var mes = $('#cmbMesEEPP').val();
  var anno = $('#CmbAnnoEEPP').val();

	datos = "idEEPP=" + idEEPP +
		"&idObra=" + idObra +
		"&fechaEEPP=" + fechaEEPP +
		"&mes=" + mes + 
		"&anno=" + anno;
	
	$.ajax({

		type: "POST",
		url: "ajax/editarEEPP.ajax.php",
		data: datos,
		

		success: function(res) {
				
	               window.location = "index.php?ruta=eeppProcesado"; 
	   	
		}
	});	 

	

});

$(".tablaEEPPGenerados").on("click", ".verEEPP", function(){

	var idEEPP = $(this).attr("idEEPP");
	var idObra = $(this).attr("idObra");

	window.open("extensiones/pdf/TCPDF/eepp.php?id="+idEEPP+"&idObra="+idObra, "_blank");

});

$('#cmbMesEEPP').change(function() {

	    $('.tablaEEPPGenerados').DataTable().destroy();

      EEPPGenerados();
      $('.tablaEEPPGenerados').DataTable().ajax.reload();
   

	});

$('#CmbAnnoEEPP').change(function() {

	    $('.tablaEEPPGenerados').DataTable().destroy();

      EEPPGenerados();
      $('.tablaEEPPGenerados').DataTable().ajax.reload();
   

	});


//*********************************************************************//
//************PROCESO ASIGNAR ORDEN DE COMPRA**************************//
//*********************************************************************//

$('#btnEEPP_OC').click(function(){ 
        
        window.location = "index.php?ruta=obras-oc-detalle";  

});  
