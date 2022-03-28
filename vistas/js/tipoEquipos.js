

/*=============================================
SUBIENDO LA FOTO 
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarTipoEquipo", function(){

	var idTipoEquipo = $(this).attr("idTipoEquipo");
	
	var datos = new FormData();
	datos.append("idTipoEquipo", idTipoEquipo);

	$.ajax({

		url:"ajax/tipoEquipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarMarcaEquipo").val(respuesta["id_marca"]);
			$("#editarNombre").val(respuesta["descripcion"]);				
			$("#editarModelo").val(respuesta["modelo"]);	
			$("#editarGarantia").val(respuesta["meses_garantia"]);
			$("#editarVida").val(respuesta["vida_util"]);	
			$("#editarPrecio").val(respuesta["precio"]);
			$("#fotoActual").val(respuesta["foto"]);
			$("#idTipo").val(respuesta["id"]);
			
			
			

				

			if(respuesta["foto"] != ""){

				$(".previsualizarEditar").attr("src", respuesta["foto"]);

			}else{

				$(".previsualizarEditar").attr("src", "vistas/img/productos/default/anonymous.png");

			}

		}

	});

})




/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarTipoEquipo", function(){

  var idTipoEquipo = $(this).attr("idTipoEquipo");
  var fotoEquipo = $(this).attr("fotoEquipo");
  

  swal({
    title: '¿Está seguro de borrar el tipo de equipo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar tipo de equipo!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=tipo-equipos&idTipoEquipo="+idTipoEquipo+"&fotoEquipo="+fotoEquipo;

    }

  })

})


/*=============================================
ACTIVAR 
=============================================*/
$(".tablas").on("click", ".btnActivarTipoEquipo", function(){

	var idTipoEquipo = $(this).attr("idTipoEquipo");
	var estadoTipo = $(this).attr("estadoTipo");

	var datos = new FormData();
 	  datos.append("activarId", idTipoEquipo);
  	datos.append("activarTipo", estadoTipo);

  	$.ajax({

	  url:"ajax/tipoEquipos.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      	

	      		 swal({
			      title: "Estado actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "tipo-equipos";

			        }


				});

	      	

      }

  	})

  	if(estadoTipo == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoTipo',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoTipo',0);

  	}

})

$('#btnTipoEquipoVolver').click(function(){ 
        
        window.location = "index.php?ruta=categorias";  

})