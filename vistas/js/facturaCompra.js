/*=============================================
CARGAR LA TABLA DINÁMICA DE FACTURAS
=============================================*/


$('.tablaFacturasCompra').DataTable( {
    "ajax": "ajax/datatable-facturas-compra.ajax.php",
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





/*=============================================
ELIMINAR 
=============================================*/

$(".tablaFacturasCompra tbody").on("click", "button.btnEliminarFacturaCompra", function(){

	var idFactura = $(this).attr("idFactura");

	swal({

		title: '¿Está seguro de borrar Factura Compra?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar factura!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=facturas-compra-equipos&idFactura="+idFactura;

        }


	})

})
	


$(".tablaFacturasCompra tbody").on("click", "button.btnDetalleFactura", function(){

	var idFactura = $(this).attr("idFactura");

	window.location = "index.php?ruta=factura-detalles&idFactura="+idFactura;

})

/*=============================================
EDITAR 
=============================================*/
$(".tablaFacturasCompra tbody").on("click", "button.btnEditarFacturaCompra", function(){

	var idFactura = $(this).attr("idFactura");

	var datos = new FormData();
	datos.append("idFactura", idFactura);

	$.ajax({
	    url:"ajax/facturas-compras.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		$("#editarProveFac").val(respuesta["id_proveedor"]);
     		$("#editarNumeroFacturaCompra").val(respuesta["numero_factura"]);
     		$("#idFacturaCompraEdita").val(respuesta["id"]);
     		$("#editarFechaFacturaCompra").val(respuesta["fecha_factura"]); 
     		$("#imagenAnteriorFactura").val(respuesta["imagen"]); 

     		$("#modalEditarFacturaCompra").modal("show");   		

     	}

	})


});



$("#nuevoArchivoPdf").change(function(){

	var imagen = this.files[0];
	
	if(imagen["type"] != "application/pdf"){

  		$("#nuevoArchivoPdf").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El adjunto debe estar en formato PDF!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  }else if(imagen["size"] > 2000000){

  		$("#nuevoArchivoPdf").val("");

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
})	 

   