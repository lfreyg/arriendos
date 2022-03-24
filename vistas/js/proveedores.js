/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");

	var datos = new FormData();
	datos.append("idProveedor", idProveedor);

	$.ajax({
	    url:"ajax/proveedores.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

     		$("#rutEditarProveedor").val(respuesta["rut"]);
     		$("#nombreEditarProveedor").val(respuesta["nombre"]);
     		$("#idProveedores").val(respuesta["id"]);
     		$("#contactoEditarProveedor").val(respuesta["contacto"]);
     		$("#direccionEditarProveedor").val(respuesta["direccion"]);
     		$("#telefonoEditarProveedor").val(respuesta["telefono"]);
     		$("#correoEditarProveedor").val(respuesta["email"]);

     	}

	})


})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function(){

	 	var idProveedor = $(this).attr("idProveedor");

	 swal({
	 	title: '¿Está seguro de borrar el proveedor?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar proveedor!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;

	 	}

	 })

})


/*=============================================
REVISAR SI EL RUT PROVEEDOR YA ESTÁ REGISTRADO
=============================================*/

$("#rutNuevaProveedor").change(function(){

	$(".alert").remove();

	var validarProveedor = $(this).val();

	var datos = new FormData();
	datos.append("validarProveedor", validarProveedor);

	 $.ajax({
	    url:"ajax/proveedores.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

	    	if(respuesta == "error"){
	    		$("#rutNuevaProveedor").parent().after('<div class="alert alert-warning">Este Rut no es valido</div>');
	    		$("#rutNuevaProveedor").val("");
	    		return;
	    	}else{
	    	
	    	if(respuesta){

	    		$("#rutNuevaProveedor").parent().after('<div class="alert alert-warning">Este Rut ya existe en la base de datos</div>');

	    		$("#rutNuevaProveedor").val("");

	    	}
	    }

	    }

	})
})