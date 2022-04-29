/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/


$('.tablaGuiaDespacho').DataTable( {
    "ajax": "ajax/datatable-guia-despacho.ajax.php",
    "deferRender": true,
	"retrieve": true,
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


$('#btnNuevaGuia').click(function() {  
   $('#nuevaGuiaConstructora').val("");
   genera_combo_obras("");
});


/*=============================================
ELIMINAR 
=============================================*/

$(".tablaGuiaDespacho tbody").on("click", "button.btnEliminarGuiaDespacho", function(){

	var idGuia = $(this).attr("idGuia");
	var idEstado = $(this).attr("idEstado");


  if(idEstado == 13){
	swal({

		title: '¿Está seguro de ANULAR la Guía de despacho?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ANULAR Guía!'
        }).then(function(result) {
        if (result.value) {        

        	window.location = "index.php?ruta=guia-despacho-arriendos&idGuia="+idGuia+"&idEstado="+idEstado;

        }


	})
 }


 if(idEstado == 12){
	swal({

		title: '¿Está seguro de ELIMINAR la Guía de despacho sin enviar a SII?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, ELIMINAR Guía!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=guia-despacho-arriendos&idGuia="+idGuia+"&idEstado="+idEstado;

        }


	})
 }





})
	


$(".tablaGuiaDespacho tbody").on("click", "button.btnDetalleGuiaDespacho", function(){

	var idGuia = $(this).attr("idGuia");

	window.location = "index.php?ruta=guia-despacho-arriendos-detalle&idGuia="+idGuia;

})

/*=============================================
EDITAR 
=============================================*/
$(".tablaGuiaDespacho tbody").on("click", "button.btnEditarGuiaDespacho", function(){

	var idGuia = $(this).attr("idGuia");

	var datos = new FormData();
	datos.append("idGuia", idGuia);

	$.ajax({
	    url:"ajax/guia-despacho.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		
         $("#editaEmpresaOperativa").val(respuesta["id_empresa"]);
         $("#editaNumGuia").val(respuesta["numero_guia"]);
         $("#idGuiaEdita").val(respuesta["id"]); 
         $("#docAnteriorGuia").val(respuesta["adjunto"]);
     		$("#editaGuiaConstructora").val(respuesta["id_constructoras"]); 
     		$("#editaFechaGuia").val(respuesta["fecha_guia"]); 
     		$("#editaGuiaOC").val(respuesta["oc"]);
     		$("#editaFechaTermino").val(respuesta["fecha_termino"]);
     		$("#editaTransporte").val(respuesta["id_transporte_guia"]);
     		
     		 
            edita_combo_obras(respuesta["id_constructoras"],respuesta["id_obras"]);
         
            


     		$("#modalEditarGuiaDespacho").modal("show"); 
     		   		

     	}

	})


});



$("#editaGuiaDoc").change(function(){

	var imagen = this.files[0];
	
 if(imagen["type"] != "application/pdf"){

  		$("#editaGuiaDoc").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto debe estar en formato PDF!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  }else if(imagen["size"] > 2000000){

  		$("#editaGuiaDoc").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}
})	 


function genera_combo_obras(id) {

	id = id;


	datos = "id=" + id;


	$.ajax({


		url: "ajax/combo-obras.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#nueva_obras_combo").html("");      
			$('#nueva_obras_combo').html(html);

		}
	});
}

function genera_edita_combo_obras(id) {

	id = id;
   idObra = 0;

	datos = "id=" + id +
	        "&idObra=" + idObra;


	$.ajax({


		url: "ajax/edita-combo-obras.ajax.php",
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


		url: "ajax/edita-combo-obras.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	
		   
			$('#edita_obras_combo').html(html);

		}
	});
}


$('#nuevaGuiaConstructora').change(function() {
	   
	
		id = $('#nuevaGuiaConstructora').val();		
		genera_combo_obras(id);
	

	});

$('#editaGuiaConstructora').change(function() {	   
	
		id = $('#editaGuiaConstructora').val();		
		genera_edita_combo_obras(id);
	

	});



   