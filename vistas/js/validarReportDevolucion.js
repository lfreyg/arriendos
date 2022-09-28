/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/


$('.tablaReportDevolucion').DataTable( {
    "ajax": "ajax/datatable-report-validacion-devolucion.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[0,"desc"]],
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "NO TIENES RETIROS QUE VALIDAR",
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



$(".tablaReportDevolucion tbody").on("click", "button.btnDetalleValidacionReport", function(){

	var idReport = $(this).attr("idReport");

	window.location = "index.php?ruta=validacion-equipos-retiro-detalles&idReport="+idReport;

})

$(".tablaReportDevolucion tbody").on("click", "button.btnImprimeReport", function(){

	var idReport = $(this).attr("idReport");

	window.open("extensiones/pdf/TCPDF/report-retiro.php?id="+idReport, "_blank");

})













   