

function genera_tabla_validacion() {

	idReport = $('#idReport').val();    

	datos = "id=" + idReport;

	$.ajax({


		url: "ajax/tabla-equipos-retirados-valida.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);

		}
	});
}





function validarRetiro(idRegistro) {

	
	var idRegistro = idRegistro;
	

	datos = "idRegistro=" + idRegistro +
	         "&tipo=V";

	
	$.ajax({

        type: "POST",
		url: "ajax/guarda-validacion-retiro.ajax.php",
		data: datos,

		success: function(res) {
                      
			  alertify.success("Validación realizada");
			  genera_tabla_validacion();	
			

		}

	});



	
}

function quitarValidarRetiro(idRegistro) {

	

	var idRegistro = idRegistro;
	

	datos = "idRegistro=" + idRegistro +
	         "&tipo=Q";

	
	$.ajax({

        type: "POST",
		url: "ajax/guarda-validacion-retiro.ajax.php",
		data: datos,

		success: function(res) {
                      
			  alertify.success("Validación anulada");
			  genera_tabla_validacion();	
			

		}

	});



	
}



$('#btnFinalizarReport').click(function() {
	
	id = $('#idReport').val();
	
   	
		finalizaReport(id);
	
	 

});

function finalizaReport(id){

	var id = id;

	window.open("extensiones/pdf/TCPDF/report-retiro.php?id="+id, "_blank");

}


$('#btnVolver').click(function() {	

		
	       window.location = "index.php?ruta=validacion-equipos-retiro";	 

});



const formatterPeso = new Intl.NumberFormat('es-CO', {
       style: 'currency',
       currency: 'COP',
       minimumFractionDigits: 0
     })
