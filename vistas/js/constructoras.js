/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarConstructora", function(){

	var idConstructora = $(this).attr("idConstructora");

	var datos = new FormData();
	datos.append("idConstructora", idConstructora);

	$.ajax({
	    url:"ajax/constructoras.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		$("#rutEditarConstructora").val(respuesta["rut"]);
     		$("#nombreEditarConstructora").val(respuesta["nombre"]);
     		$("#idConstructoras").val(respuesta["id"]);  
     		$("#direccionEditarConstructora").val(respuesta["direccion"]); 
     		$("#telefonoEditarConstructora").val(respuesta["telefono"]);  
     		$("#contactoEditarConstructora").val(respuesta["contacto_cobranza"]);  
     		$("#cobraTeleEditarConstructora").val(respuesta["telefono_cobranza"]); 
     		$("#cobraMailEditarConstructora").val(respuesta["email_cobranza"]); 
     		$("#formaPagoEditarConstructora").val(respuesta["forma_pago_id"]); 	
     		$("#codigoEditarConstructora").val(respuesta["codigo_actividad"]); 	

           if(respuesta["forma_pago_id"] == 7 || respuesta["forma_pago_id"] == 8){
     		 $('#mostrarBancoEditar').css("display", "block");
             $('#bancoEditarConstructora').val(respuesta["banco"]);
            }else{
		     $('#mostrarBancoEditar').css("display", "none"); 	
		    }

     	  	

     	}

	})


})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarConstructora", function(){

	 	var idConstructora = $(this).attr("idConstructora");

	 swal({
	 	title: '¿Está seguro de borrar Constructora?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Constructora!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=constructoras&idConstructora="+idConstructora;

	 	}

	 })

})


/*=============================================
REVISAR SI EL RUT PROVEEDOR YA ESTÁ REGISTRADO
=============================================*/

$("#rutNuevaConstructora").change(function(){

	$(".alert").remove();

	var validarConstructora = $(this).val();

	var datos = new FormData();
	datos.append("validarConstructora", validarConstructora);

	 $.ajax({
	    url:"ajax/constructoras.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){
	    		$("#rutNuevaConstructora").parent().after('<div class="alert alert-warning">Este Rut no es valido</div>');
	    		$("#rutNuevaConstructora").val("");
	    		return;
	    	}else{

	    	if(respuesta){

	    		$("#rutNuevaConstructora").parent().after('<div class="alert alert-warning">Este Rut ya existe en la base de datos</div>');

	    		$("#rutNuevaConstructora").val("");

	    	  }
	    	}

	    }

	})
})

/*=============================================
ACTIVAR 
=============================================*/
$(".tablas").on("click", ".btnActivarConstructora", function(){

	var idConstructora = $(this).attr("idConstructora");
	var estadoConstructora = $(this).attr("estadoConstructora");

	var datos = new FormData();
 	  datos.append("activarId", idConstructora);
  	datos.append("activarEstado", estadoConstructora);

  	$.ajax({

	  url:"ajax/constructoras.ajax.php",
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

			        	window.location = "constructoras";

			        }


				});

	      	

      }

  	})

  	if(estadoConstructora == 0){

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
      
      
$('#btnNuevaConstructora').click(function(){ 
        
        $('#mostrarBanco').css("display", "none");        

})

$("#formaPagoNuevaConstructora").change(function(){ 
     forma = $('#formaPagoNuevaConstructora').val();

        if(forma == 7 || forma == 8){
           $('#mostrarBanco').css("display", "block");
             $('#bancoNuevaConstructora').val('');
             
        }else{
          $('#mostrarBanco').css("display", "none"); 
        }

})

$("#formaPagoEditarConstructora").change(function(){ 
     forma = $('#formaPagoEditarConstructora').val();

        if(forma == 7 || forma == 8){
           $('#mostrarBancoEditar').css("display", "block");
             $('#bancoEditarConstructora').val('');
             
        }else{
          $('#mostrarBancoEditar').css("display", "none"); 
        }

})