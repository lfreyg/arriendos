/*=============================================
CARGAR LA TABLA DINÁMICA DE PEDIDOS
=============================================*/


$('.tablaPedido').DataTable( {
    "ajax": "ajax/datatable-pedido-equipo.ajax.php",
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


$('#btnNuevoPedido').click(function() {  
   $('#nuevaPedidoConstructora').val("");
   genera_combo_obras("");
});


/*=============================================
ELIMINAR 
=============================================*/

$(".tablaPedido tbody").on("click", "button.btnEliminarPedidoEquipo", function(){

	var idPedido = $(this).attr("idPedido");

	swal({

		title: '¿Está seguro de borrar el Pedido de Equipos?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Pedido!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=pedido-equipos&idPedido="+idPedido;

        }


	})

})
	


$(".tablaPedido tbody").on("click", "button.btnDetallePedidoEquipo", function(){

	var idPedido = $(this).attr("idPedido");

	window.location = "index.php?ruta=pedido-equipos-detalle&idPedido="+idPedido;

})

/*=============================================
EDITAR 
=============================================*/
$(".tablaPedido tbody").on("click", "button.btnEditarPedidoEquipo", function(){

	var idPedido = $(this).attr("idPedido");

	var datos = new FormData();
	datos.append("idPedido", idPedido);

	$.ajax({
	    url:"ajax/pedido-equipo.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		$("#editaPedidoConstructora").val(respuesta["id_constructoras"]);
     		$("#editaSucursalPedido").val(respuesta["id_sucursal"]);
     		$("#editaPedidoOC").val(respuesta["orden_compra"]);
     		$("#idPedidoEquipoEdita").val(respuesta["id"]); 
     		$("#docAnteriorPedido").val(respuesta["documento"]); 
            edita_combo_obras(respuesta["id_constructoras"],respuesta["id_obras"]);
         
            


     		$("#modalEditarPedidoEquipo").modal("show"); 
     		   		

     	}

	})


});



$("#nuevoPedidoDoc").change(function(){

	var imagen = this.files[0];
	
 if(imagen["type"] != "application/pdf"){

  		$("#nuevoPedidoDoc").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto debe estar en formato PDF!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  }else if(imagen["size"] > 2000000){

  		$("#nuevoPedidoDoc").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}
})	 

$("#editarArchivoPdf").change(function(){

	var imagen = this.files[0];
		
	if(imagen["type"] != "application/pdf"){

  		$("#editarArchivoPdf").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto debe estar en formato PDF!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  }else if(imagen["size"] > 2000000){

  		$("#editarArchivoPdf").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}
});	 

function genera_combo_obras(id) {

	id = id;


	datos = "id=" + id;


	$.ajax({


		url: "ajax/combo-obras.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#nueva_obras_combo_pedido").html("");      
			$('#nueva_obras_combo_pedido').html(html);

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

			$('#edita_obras_combo_pedido').html(html);

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
		   
			$('#edita_obras_combo_pedido').html(html);

		}
	});
}


$('#nuevaPedidoConstructora').change(function() {
	   
	
		id = $('#nuevaPedidoConstructora').val();		
		genera_combo_obras(id);
	

	});

$('#editaPedidoConstructora').change(function() {	   
	
		id = $('#editaPedidoConstructora').val();		
		genera_edita_combo_obras(id);
	

	});



   