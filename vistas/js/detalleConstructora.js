/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarDetalle", function(){

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

     		$("#editarConstructora").val(respuesta["id_constructoras"]);
     		$("#nombreEditarObra").val(respuesta["nombre"]);
     		$("#idObras").val(respuesta["id"]);
     		$("#contactoEditarObra").val(respuesta["contacto"]);
     		$("#direccionEditarObra").val(respuesta["direccion"]);
     		$("#telefonoEditarObra").val(respuesta["telefono"]);
     		$("#correoEditarObra").val(respuesta["email"]);

     	}

	})


})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarDetalle", function(){

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

	 		window.location = "index.php?ruta=detalleConstructora&idObra="+idObra;

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
