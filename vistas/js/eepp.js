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


$('#btnProcesaEEPP').click(function() {    
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

			$("#equipos_cobror").html("");      
			$('#equipos_cobror').html(html);

		}
	});
}