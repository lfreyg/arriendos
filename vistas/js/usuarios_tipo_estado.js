$('#cmbUsuarios').change(function() {

	tablaEstados();
	tablaEstadosSeleccionados();


});


function tablaEstados(){

	var idUsuario = $('#cmbUsuarios').val();

    datos = "idUsuario=" + idUsuario;

	$.ajax({


		url: "ajax/tabla-listado-estados.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#lista_estados').html(html);

		}
	});

}

function tablaEstadosSeleccionados(){

	var idUsuario = $('#cmbUsuarios').val();

    datos = "idUsuario=" + idUsuario;

	$.ajax({


		url: "ajax/tabla-listado-estados-seleccionado.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#estados_seleccionado').html(html);

		}
	});

}

function agregarEstado(id){
	idEstado = id;
	idUsuario = $('#cmbUsuarios').val();

	datos = "idEstado=" + idEstado +		
		"&idUsuario=" + idUsuario;
		


	$.ajax({

		type: "POST",
		url: "ajax/guarda-permiso-estado-usuario.ajax.php",
		data: datos,

		success: function(res) {
      
           
			
			alertify.success("Estado autorizado");
			tablaEstados();
	        tablaEstadosSeleccionados();
			
		
		
						
			
		}
	});
}


function quitarEstado(id){
	idRegistro = id;
	

	datos = "idRegistro=" + idRegistro;
		


	$.ajax({

		type: "POST",
		url: "ajax/quitar-permiso-estado-usuario.ajax.php",
		data: datos,

		success: function(res) {
      
           
			
			alertify.success("Se ha quitado el permiso");
			tablaEstados();
	        tablaEstadosSeleccionados();
			
		
		
						
			
		}
	});
}