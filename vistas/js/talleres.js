/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarTaller", function(){

	var idTaller = $(this).attr("idTaller");

	var datos = new FormData();
	datos.append("idTaller", idTaller);

	$.ajax({
	    url:"ajax/talleres.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

	    	
     		$("#rutTallerE").val(respuesta["rut"]);
     		$("#idTallerTxt").val(respuesta["id"]);
     		$("#nombreTallerE").val(respuesta["nombre"]);  
     		$("#direccionTallerE").val(respuesta["direccion"]); 
     		$("#telefonoTallerE").val(respuesta["telefono"]);  
     		$("#correoTallerE").val(respuesta["correo"]);  
     		$("#contactoTallerE").val(respuesta["contacto"]); 
     		$("#comunaTallerE").val(respuesta["comuna"]); 
     		$("#ciudadTallerE").val(respuesta["ciudad"]); 	    		 	
    	  	

     	}

	})


})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarTaller", function(){

	 	var idTaller = $(this).attr("idTaller");

	 swal({
	 	title: '¿Está seguro de borrar Taller Externo?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Taller!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=talleres&idTaller="+idTaller;

	 	}

	 })

})


/*=============================================
REVISAR SI EL RUT PROVEEDOR YA ESTÁ REGISTRADO
=============================================*/

$("#rutTaller").change(function(){


	$(".alert").remove();

	var validartaller = $(this).val();

	var datos = new FormData();
	datos.append("validartaller", validartaller);

	 $.ajax({
	    url:"ajax/talleres.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){


	    	if(respuesta == "error"){
	    		$("#rutTaller").parent().after('<div class="alert alert-warning">Este Rut no es valido</div>');
	    		$("#rutTaller").val("");
	    		return;
	    	}else{

	    	if(respuesta){

	    		$("#rutTaller").parent().after('<div class="alert alert-warning">Este Rut para taller externo ya existe en la base de datos</div>');

	    		$("#rutTaller").val("");

	    	  }
	    	}

	    }

	})
})



/*=============================================
ACTIVAR 
=============================================*/
$(".tablas").on("click", ".btnActivarTaller", function(){

	var idTaller = $(this).attr("idTaller");
	var estadoTaller = $(this).attr("estadoTaller");

	var datos = new FormData();
 	  datos.append("activarId", idTaller);
  	datos.append("activarEstado", estadoTaller);

  	$.ajax({

	  url:"ajax/talleres.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      		

	      		 swal({
			      title: "Estado ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "talleres";

			        }


				});

	      	

      }

  	})

  	if(estadoTaller == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estado',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estado',0);

  	}

})


 $(".tablas").on("click", ".btnDetalleConstructora", function(){

	var idConstructora = $(this).attr("idConstructora");

	window.location = "index.php?ruta=obras&idConstructora="+idConstructora;

})
      
      
