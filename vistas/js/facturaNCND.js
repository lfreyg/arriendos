/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/



function recargaTablaFacturaNCND(id) {

	var idEmpresa = id;

	$('.tablaFacturaNCND').DataTable({
		"ajax": {
			"url": "ajax/datatable-facturas-nc-nd-listado.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idEmpresa: idEmpresa
			}
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No Existen facturas disponibles",
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


function recargaTablaListadoNC() {

	var idFactura = $('#idFacturaGral').val();

	$('.tablaListaNC').DataTable({
		"ajax": {
			"url": "ajax/datatable-listado-nc.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idFactura: idFactura
			}
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No Existen NC disponibles",
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


$('#nuevaEmpresaOperativa').change(function() {
       
        id = $('#nuevaEmpresaOperativa').val();
        
      $('.tablaFacturaNCND').DataTable().destroy();

      recargaTablaFacturaNCND(id);
      $('.tablaFacturaNCND').DataTable().ajax.reload();
   

	});




$(".tablaFacturaNCND").on("click", ".btnNC", function(){

	var idFactura = $(this).attr("idFactura");


	window.location = "index.php?ruta=factura-nota-credito-listado&idFactura="+idFactura;

});



$(".tablaFacturaNCND").on("click", ".btnND", function(){

	var idFactura = $(this).attr("idFactura");


	window.location = "index.php?ruta=factura-nota-debito-listado&idFactura="+idFactura;

});






$('#btnListaNCVolver').click(function(){ 
        
       var idEmpresa = $('#idEmpresaGral').val();
        window.location = "index.php?ruta=facturas-nc-nd&idEmpresa=" + idEmpresa; 

}); 







$(".tablaListaNC").on("click", ".btnDetalleNC", function(){

	var idNC = $(this).attr("idNC");


	window.location = "index.php?ruta=factura-nc-detalle&idNC="+idNC;

});





$('#btnVolverNC').click(function(){ 
        
     
      window.location = "index.php?ruta=factura-nota-credito-listado";

}); 






$('#btnTimbrarNC').click(function() {
	
  
  if($('#idTipoNC').val() == 2){
	total = $('#netoNC').val();

	  if(total == 0){	  	
	  	alertify.error('Debe agregar al menos un item a la NC');
	  	return false;
	  }

  }

	id = $('#idNC').val();
	idEmpresa = $('#idEmpresaOperativa').val();
   
	alertify.confirm('GENERAR NOTA CRÉDITO', 'Esta seguro de Generar la Nota de Crédito y enviarla al SII?', function() {
		finalizaNC(id,idEmpresa)
	}, function() {});


	 

});



function finalizaNC(id,idEmpresa){


   descripcion = $('#detalleNC').val();
   neto = $('#netoNC').val();
   idFactura = $('#idFacturaNC').val();
   idTipoNC = $('#idTipoNC').val();
   idNC = id;
   rut = $('#rutConstructoraNC').val();
   razon = $('#constructoraNC').val();
   tele = $('#telefonoNC').val();
   contacto = $('#contactoNC').val();
   direccion = $('#direccionNC').val();
   comuna = $('#comunaNC').val();
   ciudad = $('#ciudadNC').val();
   codigo = $('#cmbActividadNC').val();

   datosNC = "descripcion=" + descripcion +
		"&neto=" + neto +		
		"&idFactura=" + idFactura + 
		"&idTipoNC=" + idTipoNC +
		"&idNC=" + idNC +
		"&rut=" + rut +
		"&razon=" + razon +
		"&tele=" + tele +
		"&contacto=" + contacto +
		"&direccion=" + direccion +
		"&comuna=" + comuna +
		"&ciudad=" + ciudad +
		"&codigo=" + codigo;
	
	$.ajax({

		type: "POST",
		url: "ajax/guarda-detalle-nc-sii.ajax.php",
		data: datosNC,



		success: function(res) {

			    	var datos = new FormData();
					datos.append("finalizaNC", id);
					datos.append("idEmpresa", idEmpresa);


					$.ajax({
						url: "ajax/nota-credito.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(r) {

						
					       window.location = "index.php?ruta=factura-nota-credito-listado";

						}
					});

		}
	});


	

}


$(".tablaListaNC").on("click", ".btnEliminarNC", function(){

	var idNC = $(this).attr("idNC");



         swal({

		title: '¿Está seguro de ELIMINAR borrador?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ELIMINAR BORRADOR NC!'
        }).then(function(result) {
        if (result.value) {

				var datos = new FormData();
				datos.append("idNC", idNC);

				$.ajax({
					 url:"ajax/nota-credito.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(r) {

						alertify.success("Borrador NC eliminada");
						window.location = "index.php?ruta=factura-nota-credito-listado";  

						


					}
				});   

        }


	})

});





//**************************NOTA DEBITO******************************//
//*******************************************************************//


function recargaTablaListadoND() {

	var idFactura = $('#idFacturaGral').val();

	$('.tablaListaND').DataTable({
		"ajax": {
			"url": "ajax/datatable-listado-nd.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idFactura: idFactura
			}
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No Existen ND disponibles",
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


$('#btnVolverND').click(function(){ 
        
     
      window.location = "index.php?ruta=factura-nota-debito-listado";

}); 


$(".tablaListaND").on("click", ".btnDetalleND", function(){

	var idND = $(this).attr("idND");


	window.location = "index.php?ruta=factura-nd-detalle&idND="+idND;

});


$('#btnListaNDVolver').click(function(){ 
        
       var idEmpresa = $('#idEmpresaGral').val();
        window.location = "index.php?ruta=facturas-nc-nd&idEmpresa=" + idEmpresa; 

}); 


$('#btnTimbrarND').click(function() {
	
	 if($('#idTipoND').val() == 1){
		total = $('#netoND').val();

		  if(total == 0){	  	
		  	alertify.error('Debe agregar al menos un item a la ND');
		  	return false;
		  }

  }

	id = $('#idND').val();
	idEmpresa = $('#idEmpresaOperativa').val();
   
	alertify.confirm('GENERAR NOTA DÉBITO', 'Esta seguro de Generar la Nota de Débito y enviarla al SII?', function() {
		finalizaND(id,idEmpresa)
	}, function() {});


	 

});


function finalizaND(id,idEmpresa){


   descripcion = $('#detalleND').val();
   neto = $('#netoND').val();
   idFactura = $('#idFacturaND').val();
   idTipoND = $('#idTipoND').val();
   idND = id;
   rut = $('#rutConstructoraND').val();
   razon = $('#constructoraND').val();
   tele = $('#telefonoND').val();
   contacto = $('#contactoND').val();
   direccion = $('#direccionND').val();
   comuna = $('#comunaND').val();
   ciudad = $('#ciudadND').val();
   codigo = $('#cmbActividadND').val();

   datosNC = "descripcion=" + descripcion +
		"&neto=" + neto +		
		"&idFactura=" + idFactura + 
		"&idTipoND=" + idTipoND +
		"&idND=" + idND +
		"&rut=" + rut +
		"&razon=" + razon +
		"&tele=" + tele +
		"&contacto=" + contacto +
		"&direccion=" + direccion +
		"&comuna=" + comuna +
		"&ciudad=" + ciudad +
		"&codigo=" + codigo;
	
	$.ajax({

		type: "POST",
		url: "ajax/guarda-detalle-nd-sii.ajax.php",
		data: datosNC,



		success: function(res) {

			    	var datos = new FormData();
					datos.append("finalizaND", id);
					datos.append("idEmpresa", idEmpresa);


					$.ajax({
						url: "ajax/nota-debito.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(r) {

						
					       window.location = "index.php?ruta=factura-nota-debito-listado";

						}
					});

		}
	});


	

}


$(".tablaListaND").on("click", ".btnEliminarND", function(){

	var idND = $(this).attr("idND");



         swal({

		title: '¿Está seguro de ELIMINAR borrador?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ELIMINAR BORRADOR ND!'
        }).then(function(result) {
        if (result.value) {

				var datos = new FormData();
				datos.append("idND", idND);

				$.ajax({
					 url:"ajax/nota-debito.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(r) {

						alertify.success("Borrador ND eliminada");
						window.location = "index.php?ruta=factura-nota-debito-listado";  

						


					}
				});   

        }


	})

});


function recargaFacturaSII() {

	idFactura = $('#idFacturaNC').val();   
	

	datos = "idFactura=" + idFactura;

	$.ajax({


		url: "ajax/tabla-factura-sii-notas.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#equipos_en_factura').html(html);

		}
	});

}


function recargaRegistrosNC() {

	idNC = $('#idNC').val();   
	

	datos = "idNC=" + idNC;

	$.ajax({


		url: "ajax/tabla-registros-nc.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#equipos_en_nc').html(html);

		}
	});

}


function agregaItemNCSII(idEEPP,idRegistroSII) {

	
	 idFactura = $('#idFacturaNC').val();
	 idNC = $('#idNC').val();
	 netoOriginal = $('#netoOriginal').val();

	 precio = prompt("Neto Item NC", '');
	 

	 if (precio == '') {
		alertify.error("Ingrese Valor Neto para Item, no se agrego el item");
		return false;
	}

	
	if (precio <= 0) {
		alertify.error("Ingrese Valor Neto para Item, no se agrego el item");
		return false;
	}

	if(precio >= netoOriginal){
		alertify.error("EL MONTO DE LA NC NO PUEDE SER MAYOR O IGUAL AL VALOR DE LA FACTURA, PARA ESO, PREFIERA EL PROCESO DE ANULAR FACTURA CON NC");
		return false;
	}

	

		
	datos = "idRegistroFacSII=" + idRegistroSII +		
		"&id_eepp=" + idEEPP +
		"&idFactura=" + idFactura +
		"&idNC=" + idNC +
		"&precio=" + precio;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-nc-sii-detalle.ajax.php",
		data: datos,

		success: function(res) {
      
           
			
			alertify.success("Registro agregado a NC");
			recargaRegistrosNC();
			totalNC();
			
		
		
						
			
		}
	});

	


}

function quitarRegistroNC(id){
	idRegistroNC = id;

	var datos = new FormData();
				datos.append("idRegistroNC", idRegistroNC);

				$.ajax({
					 url:"ajax/nota-credito.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(r) {

						alertify.success("Registro quitado de NC");
						recargaRegistrosNC();
						totalNC();
						  

						


					}
				});   



}

function totalNC(){
    idNC = $('#idNC').val();

   var datos = new FormData();
	datos.append("idNCTotal", idNC);


	$.ajax({
		url: "ajax/nota-credito.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {
           
           if(r["neto"] == null){
           	total = "0";
           }else{         
            total = r["neto"];
           }
			$("#netoNC").val(total);





		}
	});

}


//PROCESOS PARA NOTA DEBITO

function recargaFacturaSIIND() {

	idFactura = $('#idFacturaND').val();   
	

	datos = "idFactura=" + idFactura;

	$.ajax({


		url: "ajax/tabla-factura-sii-ND.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#equipos_en_factura').html(html);

		}
	});

}


function totalND(){
    idND = $('#idND').val();

   var datos = new FormData();
	datos.append("idNDTotal", idND);


	$.ajax({
		url: "ajax/nota-debito.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {
           
           if(r["neto"] == null){
           	total = "0";
           }else{         
            total = r["neto"];
           }
			$("#netoND").val(total);





		}
	});

}


function recargaRegistrosND() {

	idND = $('#idND').val(); 
	

	datos = "idND=" + idND;

	$.ajax({


		url: "ajax/tabla-registros-nd.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#equipos_en_nd').html(html);

		}
	});

}




function agregaItemNDSII(idEEPP,idRegistroSII) {

	
	 idFactura = $('#idFacturaND').val();
	 idND = $('#idND').val();

	 precio = prompt("Neto Item ND", '');
	 

	 if (precio == '') {
		alertify.error("Ingrese Valor Neto para Item, no se agrego el item");
		return false;
	}

	
	if (precio <= 0) {
		alertify.error("Ingrese Valor Neto para Item, no se agrego el item");
		return false;
	}

	

		
	datos = "idRegistroFacSII=" + idRegistroSII +		
		"&id_eepp=" + idEEPP +
		"&idFactura=" + idFactura +
		"&idND=" + idND +
		"&precio=" + precio;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-nd-sii-detalle.ajax.php",
		data: datos,

		success: function(res) {
      
           
			
			alertify.success("Registro agregado a ND");
			recargaRegistrosND();
			totalND();
			
		
		
						
			
		}
	});

	


}


function quitarRegistroND(id){
	idRegistroND = id;

	var datos = new FormData();
				datos.append("idRegistroND", idRegistroND);

				$.ajax({
					 url:"ajax/nota-debito.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(r) {

						alertify.success("Registro quitado de ND");
						recargaRegistrosND();
						totalND();
						  

						


					}
				});   



}