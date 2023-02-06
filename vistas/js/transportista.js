/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarChofer", function(){

	var idChofer = $(this).attr("idChofer");

	var datos = new FormData();
	datos.append("idtransportista", idChofer);

	$.ajax({
		url: "ajax/transportista.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarRut").val(respuesta["rut"]);
     		$("#editarNombre").val(respuesta["nombre"]);
     		$("#idTransportista").val(respuesta["id"]);
     		$("#editarPatente").val(respuesta["patente"]);
     		$("#editarEmpresa").val(respuesta["rut_empresa_transporte"]);     		

     	}

	})


})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarChofer", function(){

	 	var idChofer = $(this).attr("idChofer");

	 swal({
	 	title: '¿Está seguro de borrar el transportista?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Transportista!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=transportista&idTransportista="+idChofer;

	 	}

	 })

})

/*=============================================
REVISAR SI EL RUT CHOFER YA ESTÁ REGISTRADO
=============================================*/

$("#nuevaRutChofer").change(function(){

	$(".alert").remove();

	var validarTransportista = $(this).val();

	var datos = new FormData();
	datos.append("validarTransportista", validarTransportista);

	 $.ajax({
	    url:"ajax/transportista.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

	    	if(respuesta == "error"){
	    		$("#nuevaRutChofer").parent().after('<div class="alert alert-warning">Este Rut no es valido</div>');
	    		$("#nuevaRutChofer").val("");
	    		$("nuevaRutChofer").focus();
	    		return;
	    	}else{
	    	
	    	if(respuesta){

	    		$("#nuevaRutChofer").parent().after('<div class="alert alert-warning">Este Rut ya existe para la tabla transportista</div>');
	    		$("#nuevaRutChofer").val("");
	    		$("nuevaRutChofer").focus();

	    	}
	    }

	    }

	})
})



$(".tablas").on("click", ".btnHoja", function(){

	 	var idChofer = $(this).attr("idChofer");

	 window.open("extensiones/pdf/TCPDF/hoja-ruta.php?id="+idChofer, "_blank");

})