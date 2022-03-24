/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarMarca", function(){

	var idMarca = $(this).attr("idMarca");

	var datos = new FormData();
	datos.append("idMarca", idMarca);

	$.ajax({
		url: "ajax/marcas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarMarca").val(respuesta["descripcion"]);
     		$("#idMarca").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarMarca", function(){

	 var idMarca = $(this).attr("idMarca");

	 swal({
	 	title: '¿Está seguro de borrar la Marca?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar marca!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=marcas&idMarca="+idMarca;

	 	}

	 })

})

/*=============================================
REVISAR SI EL NOMBRE YA ESTÁ REGISTRADO
=============================================*/

$("#nuevaMarcaEquipo").change(function(){

	$(".alert").remove();

	var validarMarca = $(this).val();	

	var datos = new FormData();
	datos.append("validarMarca", validarMarca);
	

	 $.ajax({
	    url:"ajax/marcas.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevaMarcaEquipo").parent().after('<div class="alert alert-warning">Nombre Marca ya existe en la base de datos</div>');

	    		$("#nuevaMarcaEquipo").val("");

	    	}

	    }

	})
})
