function genera_tabla_obras(id) {

	id = id;


	datos = "id=" + id;


	$.ajax({


		url: "ajax/tabla-obras.ajax.php",
		method: "GET",
		data: datos,
		async: true, 

		success: function(html) {	

			$("#obras_seleccionar").html("");      
			$('#obras_seleccionar').html(html);

		}
	});
}

$('#cmbconstructoraID').change(function() {
	   
	if($('#cmbconstructoraID').val() != ''){
		id = $('#cmbconstructoraID').val();		
		genera_tabla_obras(id);
	}else{
		$('#obras_seleccionar').html('');
	}
	

	});

function seleccionaTodosCheck(source) {
  checkboxes = document.getElementsByName('idObrabox[]');
  
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

$('#btnDescargaPlantilla').click(function() {

	window.open("ajax/excelPreciosConvenios.php");

	});

function descargaConveniosRealizados(idConstructora){

		window.open("ajax/excelConsultaPreciosConvenios.ajax.php?idConstructora="+idConstructora);

	}



$("#archivoCarga").change(function(){

	var imagen = this.files[0];

	
	if(imagen["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){

  		$("#archivoCarga").val("");

  		 swal({
		      title: "Error al adjuntar",
		      text: "¡El archivo debe estar en formato EXCEL, descargue planilla para correcta función!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  }
});	 



$('#btnRealizaCarga').click(function() {

	if($('#archivoCarga').val() == ''){
		swal({
		      title: "Error al adjuntar",
		      text: "¡Debe seleccionar un archivo a cargar!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
		return false;
	}

	if($('#cmbconstructoraID').val() == ''){
		swal({
		      title: "Error",
		      text: "¡Debe seleccionar una constructora!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
		return false;
	}



        var fo = ($("#archivoCarga"))[0].files[0]; 
	     

      var data = new FormData();
      data.append("archivo", fo);
    
        
				$.ajax({
				  url: "ajax/valida-archivo-carga-precios.php",
	      	method: "POST",
	      	data: data,
	      	cache: false,
	     	  contentType: false,
	     	  processData: false,
	     	  dataType:"json",	
	     	  success: function(r){              
            if(r == 1){
					             $.post("ajax/guarda-obras-seleccionadas.ajax.php",$("#formdata").serialize(),function(res){               
					              if(res == 1){
					              	procesa_carga_precios();
					              }					              
					        });
            }else{
            	swal({
							      title: "Error",
							      text: "¡El archivo a procesar, no contiene la información requerida!",
							      type: "error",
							      confirmButtonText: "¡Cerrar!"
							    });
							return false;
            }

	     	  }

			    })

	

	

	

	                

});

function procesa_carga_precios(){
	var fo = ($("#archivoCarga"))[0].files[0]; 
	var idCon = $('#cmbconstructoraID').val(); 

      var data = new FormData();
      data.append("archivo", fo);
      data.append("idCon", idCon);

				$.ajax({
				  url: "ajax/procesa-carga-precios.ajax.php",
				  method: "POST",
	      	data: data,
	      	cache: false,
	     	  contentType: false,
	     	  processData: false,
	     	  dataType:"json",
	     	  success: function(respuesta){            


	     	  }

			    })

				 setTimeout(5000);

				 recarga_todo();			
                        

           
}

function recarga_todo(){
	//alertify.success("Carga masiva realizada con éxito");
	
  swal({
		      title: "Proceso Finalizado",
		      text: "¡El proceso de carga masiva, finalizó con éxito!",
		      type: "success",
		      confirmButtonText: "¡Cerrar!"
		    }); 

  $('#tablasObrasExiste').DataTable().destroy();
	$("#archivoCarga").val("");
  id = $('#cmbconstructoraID').val(); 
  $("#cmbconstructoraID").val('').trigger('change'); 
  //$("#cmbconstructoraID").val(id).trigger('change');
}

function ValidaeliminarPrecios(id) {
	id = id;
	alertify.confirm('ELIMINAR CONVENIO DE PRECIOS', 'Esta seguro de eliminar el convenio de precios?', function() {
		elimina_convenio_precios(id)
	}, function() {});
}

function elimina_convenio_precios(id){
	var idObra = id;

	var datos = new FormData();
	datos.append("eliminarConvenio", idObra);


	$.ajax({
		url: "ajax/carga-precios-convenio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {



			alertify.success("Convenio de precios, eliminado con éxito");
			$('#tablasObrasExiste').DataTable().destroy();
      id = $('#cmbconstructoraID').val();  
      $("#cmbconstructoraID").val(id).trigger('change');



		}
	});
}