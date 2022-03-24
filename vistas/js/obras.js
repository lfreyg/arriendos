/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarObra", function(){

	var idObra = $(this).attr("idObra");

	var datos = new FormData();
	datos.append("idObra", idObra);

	$.ajax({
	    url:"ajax/obras.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
     		
     		$("#nombreEditarObra").val(respuesta["nombre"]);
     		$("#idObras").val(respuesta["id"]);
     		$("#contactoEditarObra").val(respuesta["contacto"]);
     		$("#direccionEditarObra").val(respuesta["direccion"]);
     		$("#telefonoEditarObra").val(respuesta["telefono"]);
     		$("#correoEditarObra").val(respuesta["email"]);
     		$("#formaCobroEditarObra").val(respuesta["forma_cobro_id"]);

     	}

	})


})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarObra", function(){

	 	var idObra = $(this).attr("idObra");

	 swal({
	 	title: '¿Está seguro de borrar la Obra?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Obra!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=obras&idObra="+idObra;

	 	}

	 })

})

/*=============================================
REVISAR SI EL NOMBRE OBRA YA ESTÁ REGISTRADO
=============================================*/

$("#nombreNuevaObra").change(function(){

	$(".alert").remove();

	var validarObra = $(this).val();	

	var datos = new FormData();
	datos.append("validarObra", validarObra);
	

	 $.ajax({
	    url:"ajax/obras.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nombreNuevaObra").parent().after('<div class="alert alert-warning">Nombre Obra ya existe en la base de datos</div>');

	    		$("#nombreNuevaObra").val("");

	    	}

	    }

	})
})

$('#btnObraVolver').click(function(){ 
        
        window.location = "index.php?ruta=constructoras";  

})

/*=============================================
ACTIVAR 
=============================================*/
$(".tablas").on("click", ".btnActivarObra", function(){

	var idObra = $(this).attr("idObra");
	var estadoObra = $(this).attr("estadoObra");

	var datos = new FormData();
 	  datos.append("activarId", idObra);
  	datos.append("activarEstado", estadoObra);

  	$.ajax({

	  url:"ajax/obras.ajax.php",
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

			        	window.location = "obras";

			        }


				});

	      	

      }

  	})

  	if(estadoObra == 0){

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