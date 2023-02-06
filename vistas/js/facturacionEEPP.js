/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/

function llenaConstructoraFacturacionEEPP() {
  
	$('.constructorasFacturacion').DataTable({
		"ajax": {
			"url": "ajax/datatable-constructora-factura-eepp.ajax.php",
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



$(".constructorasFacturacion").on("click", ".seleccionarObraFacturacion", function(){

	var idConstructora = $(this).attr("idConstructora");

	window.location = "index.php?ruta=obrasFacturacionEEPP&idConstructora="+idConstructora;

});



$('#btnObraVolverFacturacion').click(function(){ 
        
        window.location = "index.php?ruta=factura-eepp-constructora";  

});  



$(".tablas").on("click", ".btnVerEEPPFacturar", function(){

	var idObra = $(this).attr("idObra");

	window.location = "index.php?ruta=obras-factura-detalle&idObra="+idObra;

}); 

$('#btnListaFacVolver').click(function(){ 
        
       var idConstructora = $('#idConstructora_global').val();
        window.location = "index.php?ruta=obrasFacturacionEEPP&idConstructora=" + idConstructora; 

}); 



$('#btnEEPPFacturarVolver').click(function(){ 
        
        window.location = "index.php?ruta=obras-factura-detalle";  

}); 




function genera_tabla_eepp_facturar() {

	 
	idObra = $('#idObra').val(); 
	idFactura = $('#idFacturaEEPP').val();
	
	datos = "idObra=" + idObra +
	        "&idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-previa-facturar-eepp.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_para_facturar").html("");      
			$('#eepp_para_facturar').html(html);

		}
	});
}

function genera_tabla_oc_facturar() {

	 $('#eepp_para_facturar').css("display", "none");
	 $('#tbl_oc_facturar').css("display", "block");


	idObra = $('#idObra').val(); 
	idFactura = $('#idFacturaEEPP').val();
	
	datos = "idObra=" + idObra +
	        "&idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-oc-para-facturar.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#tbl_oc_facturar").html("");      
			$('#tbl_oc_facturar').html(html);

		}
	});
}





function verEEPP(idEEPP, idObra){

	window.open("extensiones/pdf/TCPDF/eepp.php?id="+idEEPP+"&idObra="+idObra, "_blank");
}


function genera_tabla_eepp_facturar_detalle() {

	idFactura = $('#idFactura').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-previa-facturar-eepp-seleccion.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_para_facturar").html("");      
			$('#eepp_para_facturar').html(html);

		}
	});
}







//MUESTRA EL LISTADO DE FACTURAS DE LA OBRA

 $('.tablaObraListaFac').DataTable( {
    "ajax": "ajax/datatable-facturas-listado.ajax.php",
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


$(".tablaObraListaFac tbody").on("click", "button.btnDetalleFac", function(){

	var idFactura = $(this).attr("idFactura");

	window.location = "index.php?ruta=EEPPFacturar&idFactura="+idFactura;

});


$(".tablaObraListaFac tbody").on("click", "button.btnEditarFac", function(){

	var idFactura = $(this).attr("idFactura");

	var datos = new FormData();
	datos.append("idFactura", idFactura);

	$.ajax({
	    url:"ajax/facturacion-detalle.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		$("#idRegistro").val(idFactura);     		
     		$("#fechaFacEdita").val(respuesta["fecha_factura"]);

     		
     		$("#modalEditarFac").modal("show"); 
     		   		

     	}

	})


});



$(".tablaObraListaFac tbody").on("click", "button.btnEliminarFac", function(){

	var idFactura = $(this).attr("idFactura");


         swal({

		title: '¿Está seguro de ELIMINAR Factura?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ELIMINAR FACTURA!'
        }).then(function(result) {
        if (result.value) {

        			var idFacturaEliminar = idFactura;
	

				var datos = new FormData();
				datos.append("idFacturaEliminar", idFacturaEliminar);

				$.ajax({
					 url:"ajax/facturacion-detalle.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(r) {

						alertify.success("Factura eliminada");
						window.location = "index.php?ruta=obras-factura-detalle";  

						


					}
				});   

        }


	})




	

});



function SeleccionaEEPP(idEEPP) {
	
	var idEEPP = idEEPP;
	var idFactura = $('#idFacturaEEPP').val();



	datos = "idEEPP=" + idEEPP +
		"&idFactura=" + idFactura;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-eepp-factura.ajax.php",
		data: datos,

		success: function(res) {

                       alertify.success("EEPP Agregado a Facturación");
			genera_tabla_eepp_facturar();
    			genera_tabla_EEPP_Seleccionado();
                     			
			
		}
	});
}




function genera_tabla_EEPP_Seleccionado() {

	idFactura = $('#idFacturaEEPP').val();    

	datos = "idFactura=" + idFactura;

	$.ajax({


		url: "ajax/tabla-eepp-seleccionados-factura.ajax.php",
		method: "GET",
		data: datos,

		success: function(html) {

			$('#eepp_seleccionados').html(html);

			if(html == ''){
			   $('#btnContinuarFactura').attr('disabled', 'disabled'); 
			   return false; 	
			}

			 $('#btnContinuarFactura').removeAttr('disabled'); 

			

		}
	});
}




function eliminarEEPPSeleccionado(idRegistro,idEEPP) {
	
	var idRegistro = idRegistro;
	var idEEPPElimina = idEEPP;
	var idFacturaQuitar = $('#idFacturaEEPP').val(); 
	


	var datos = new FormData();
	datos.append("idRegistro", idRegistro);
	datos.append("idEEPPElimina", idEEPPElimina);
	datos.append("idFacturaQuitar", idFacturaQuitar);
	
	
	$.ajax({
		 url:"ajax/facturacion-detalle.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Registro eliminado");
			genera_tabla_eepp_facturar();
    			genera_tabla_EEPP_Seleccionado();

			


		}
	});
}





//PROCESOS CUANDO SE SELECCIONARON LOS EEPP A FACTURAR

function genera_tabla_eepp_facturar_seleccion() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-previa-facturar-eepp-seleccion.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_para_facturar_sel").html("");      
			$('#eepp_para_facturar_sel').html(html);
			genera_tabla_detalle_facturacion();
			obtenerTotalesFacturacion();
			genera_tabla_referencia_factura();

		}
	});
}

$('#btnEEPPFacturarSelVolver').click(function(){ 
        
        window.location = "index.php?ruta=EEPPFacturar";  

}); 

$('#btnContinuarFactura').click(function(){ 
        
        window.location = "index.php?ruta=EEPPFacturarSeleccion";  

}); 

function verEEPPSel(idEEPP, idObra){

	window.open("extensiones/pdf/TCPDF/eepp.php?id="+idEEPP+"&idObra="+idObra, "_blank");
}




//GENERACION TIPOS DE FACTURACION

//EEPP NORMAL




//EQUIPOS AGRUPADOS

function genera_tabla_eepp_agrupado() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-previa-facturar-agrupa-equipos.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_para_facturar_sel").html("");      
			$('#eepp_para_facturar_sel').html(html);
			genera_tabla_detalle_facturacion();
			obtenerTotalesFacturacion();

		}
	});
}

function genera_tabla_eepp_detalle() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-previa-facturar-detalle-equipos.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_para_facturar_sel").html("");      
			$('#eepp_para_facturar_sel').html(html);
			genera_tabla_detalle_facturacion();
			obtenerTotalesFacturacion();

		}
	});
}

function genera_tabla_eepp_consolidado() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-previa-facturar-eepp-consolidado.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_para_facturar_sel").html("");      
			$('#eepp_para_facturar_sel').html(html);
			genera_tabla_detalle_facturacion();
			obtenerTotalesFacturacion();

		}
	});
}



$('#btnVisualizarFactura').click(function(){ 

	idFactura = $('#idFacturaEEPPSel').val(); 
        
       window.open("extensiones/pdf/TCPDF/factura.php?idFactura="+idFactura, "_blank"); 

});


function genera_tabla_factura_sii() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-factura-sii.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#eepp_facturado").html("");      
			$('#eepp_facturado').html(html);

		}
	});
}


function genera_tabla_detalle_facturacion() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-detalle-facturacion.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#detalle_facturado").html("");      
			$('#detalle_facturado').html(html);

		}
	});
}



$('#btnConfirmaFormaFactura').click(function(){ 

	  $('#contenedorEEPP').css("display", "none");
	  $('#contenedorCheck').css("display", "none");


	  $('#contenedorFactura').css("display", "block");
	  $('#contenedorText').css("display", "block");
          $('#btnTimbrarFactura').css("display", "block");

	  genera_tabla_factura_sii();
	  obtenerTotalesFacturacion();
	  genera_tabla_detalle_facturacion();
        
      

});


$('#btnAnularFormaFactura').click(function(){ 

	 $('#contenedorEEPP').css("display", "block");
         $('#contenedorCheck').css("display", "block");

         $('#contenedorFactura').css("display", "none");
         $('#contenedorText').css("display", "none");
         $('#btnTimbrarFactura').css("display", "none");
         $('#mostrarEEPP1').prop("checked", true);


          genera_tabla_eepp_facturar_seleccion();
        
      

});


function editarRegistroSII(idFacturaSII) {
	
	var id = idFacturaSII;

	var datos = new FormData();
	datos.append("idRegistroSII", id);
		


	$.ajax({

		url: "ajax/facturacion-detalle.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(equipo) {

                        var id = equipo["id"];
			var codigo = equipo["codigo"];
			var descripcion = equipo["descripcion"];			
			var glosa = equipo["glosa"];
			var cantidad = equipo["cantidad"];
			var precio = equipo["precio"];
			


			
                            $("#idRegistroSII").val(id);
			    $("#codigoSII").val(codigo);
			    $("#descripcionSII").val(descripcion);
			    $("#glosaSII").val(glosa);
			    $("#cantidadSII").val(cantidad);
			    $('#precioSII').val(precio);
			    	
			
		}
	});

	$("#modalEditarSII").modal("show");
}


$('#btnGuardarRegistroSII').click(function() {

	

	      idRegistroSII = $("#idRegistroSII").val();
	      codigoSII = $("#codigoSII").val();
	      descripcionSII = $("#descripcionSII").val();
	      glosaSII = $("#glosaSII").val();
	      cantidadSII = $("#cantidadSII").val();
	      precioSII = $('#precioSII').val();

	      if(descripcionSII == ''){
	      	alertify.error('Descripción del item es obligatorio');
	      	return false;
	      }

	      if(cantidadSII == '' || cantidadSII <= 0){
	      	alertify.error('Cantidad del item es obligatorio');
	      	return false;
	      }

	      if(precioSII == '' || precioSII <= 0){
	      	alertify.error('Precio del item es obligatorio');
	      	return false;
	      }
			
				

	datos = "idRegistroSII=" + idRegistroSII +
		"&codigoSII=" + codigoSII +		
		"&descripcionSII=" + descripcionSII + 
		"&glosaSII=" + glosaSII + 
		"&cantidadSII=" + cantidadSII + 
		"&precioSII=" + precioSII;


	$.ajax({

		type: "POST",
		url: "ajax/edita-registro-factura-sii.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Registro en Factura fue actualizado");
			genera_tabla_factura_sii();
			obtenerTotalesFacturacion();
			genera_tabla_detalle_facturacion();

		}
	});
});


function obtenerTotalesFacturacion(){

      
	var idFacturaObtener = $("#idFacturaEEPPSel").val();

	var datos = new FormData();
	datos.append("idFacturaObtener", idFacturaObtener);

	$.ajax({

		url: "ajax/facturacion-detalle.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {		
                    

                      montoFactura = formatNumber.new(respuesta["totalFactura"], "$ ");


                      $("#montoOCFactura").val(respuesta["totalFactura"]);
		     $("#montoOCFacturaFormato").val(montoFactura);	
							
		
			
		}

	});
}




$('#btnAgregaReferencia').click(function() {
	   	      
	      idFactura = $('#idFacturaEEPPSel').val(); 
	      idOC = $('#idOrdenCompra').val();
	      idReferencia = $("#cmbReferencias").val();
	      numero = $("#numeroRef").val();
	      fechaRef = $("#fechaRef").val();
	     

	      if(numero == ''){
	      	alertify.error('Número de documento es obligatorio');
	      	return false;
	      }

	      if(fechaRef == ''){
	      	alertify.error('Fecha Documento es obligatorio');
	      	return false;
	      }

	      			
				

	datos = "idFactura=" + idFactura +
		"&idOC=" + idOC +		
		"&idReferencia=" + idReferencia + 
		"&numero=" + numero + 
		"&fechaRef=" + fechaRef;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-registro-referencia-factura.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Referecnia agregada a Factura");
			 $("#cmbReferencias").val(1);
	                 $("#numeroRef").val('');
	                 $("#fechaRef").val('');
			genera_tabla_referencia_factura();
			

		}
	});
});



function genera_tabla_referencia_factura() {

	idFactura = $('#idFacturaEEPPSel').val(); 
	
	datos = "idFactura=" + idFactura;


	$.ajax({


		url: "ajax/tabla-detalle-referencia-factura.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#referencia_factura").html("");      
			$('#referencia_factura').html(html);

		}
	});
}





$('#btnTimbrarFactura').click(function() {
	
	id = $('#idFacturaEEPPSel').val();
	idEmpresa = $('#idEmpresaOperativa').val();
   
	alertify.confirm('GENERAR FACTURA', 'Esta seguro de Generar la Factura y enviarla al SII?', function() {
		finalizaFacturaEEPP(id,idEmpresa)
	}, function() {});


	 

});

function finalizaFacturaEEPP(id,idEmpresa){

	var datos = new FormData();
	datos.append("finalizaFactura", id);
	datos.append("idEmpresa", idEmpresa);


	$.ajax({
		url: "ajax/facturacion-detalle.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

		
	       window.location = "index.php?ruta=obras-factura-detalle";



		}
	});

}











var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}