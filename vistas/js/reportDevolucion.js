/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/


$('.tablaReportDevolucion').DataTable( {
    "ajax": "ajax/datatable-report-devolucion.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"order":[[0,"desc"]],
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


$('#btnNuevoReport').click(function() {  
   $('#nuevaConstructoraReport').val("");
   genera_combo_obras("");
});


/*=============================================
BUSCA LAS OBRAS DE LA CONSTRUCTORA QUE SOLO TENGA ARRIENDOS ACTIVOS 
=============================================*/

function genera_combo_obras(id) {

	id = id;


	datos = "id=" + id;


	$.ajax({


		url: "ajax/combo-obras-equipos-disponibles.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#nueva_obras_combo").html("");      
			$('#nueva_obras_combo').html(html);

		}
	});
}


/*=============================================
SELECCIONA LA OBRA AL CAMBIAR CONSTRUCTORA 
=============================================*/

$('#nuevaConstructoraReport').change(function() {
	   
	
		id = $('#nuevaConstructoraReport').val();		
		genera_combo_obras(id);
	

	});


/*=============================================
EDITAR 
=============================================*/
$(".tablaReportDevolucion tbody").on("click", "button.btnEditarReport", function(){

	var idReport = $(this).attr("idReport");
	var editable = $(this).attr("editable");

	var datos = new FormData();
	datos.append("idReport", idReport);

	$.ajax({
	    url:"ajax/report-devolucion.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		
         $("#editaIdReport").val(respuesta["id"]);
         $("#idReport").val(respuesta["id"]);                   
     		$("#editaConstructoraReport").val(respuesta["id_constructoras"]); 
     		$("#docAnteriorReport").val(respuesta["documento"]);     		
     		
     		 
            edita_combo_obras(respuesta["id_constructoras"],respuesta["id_obras"]);
         
          if(editable == 0){
          	$('#mostrarConstructora').css("display", "none"); 	
          	$('#mostrarObra').css("display", "none");
          }else{
          	$('#mostrarConstructora').css("display", "block");
          	$('#mostrarObra').css("display", "block");
          }
         
         


     		$("#modalEditarReport").modal("show"); 

     		   		

     	}

	})


});



/*=============================================
ELIMINAR 
=============================================*/

$(".tablaReportDevolucion tbody").on("click", "button.btnEliminarReport", function(){

	var idReport = $(this).attr("idReport");
	
 
	swal({

		title: '¿Está seguro de ANULAR el Report de Devolución?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ANULAR Report!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=devolucion-equipos-arriendos&idReport="+idReport;

        }


	})

})
	


$(".tablaReportDevolucion tbody").on("click", "button.btnDetalleReport", function(){

	var idReport = $(this).attr("idReport");

	window.location = "index.php?ruta=devolucion-equipos-arriendos-detalle&idReport="+idReport;

})

$(".tablaReportDevolucion tbody").on("click", "button.btnImprimeReport", function(){

	var idReport = $(this).attr("idReport");

	window.open("extensiones/pdf/TCPDF/report-retiro.php?id="+idReport, "_blank");

})



$("#editaReportDoc").change(function(){

	var imagen = this.files[0];
	
 if(imagen["type"] != "application/pdf"){

  		$("#editaReportDoc").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto debe estar en formato PDF!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  }else if(imagen["size"] > 2000000){

  		$("#editaReportDoc").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}
})	 




function genera_edita_combo_obras(id) {

	id = id;
   idObra = 0;  

	datos = "id=" + id +
	        "&idObra=" + idObra;
	        


	$.ajax({


		url: "ajax/edita-combo-obras-equipos-disponibles.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$('#edita_obras_combo').html(html);

		}
	});
}


function edita_combo_obras(id,idObra) {

	id = id;


	datos = "id=" + id +
	        "&idObra=" + idObra;
	        


	$.ajax({

		url: "ajax/edita-combo-obras-equipos-disponibles.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	
		   
			$('#edita_obras_combo').html(html);

		}
	});
}




$('#editaConstructoraReport').change(function() {	   
	
		id = $('#editaConstructoraReport').val();		
		genera_edita_combo_obras(id);
	

	});



   