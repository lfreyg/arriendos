

$('#btnDescargaPlantilla').click(function() {

	window.open("ajax/excelPreciosLista.php");

	});




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

	

        var fo = ($("#archivoCarga"))[0].files[0]; 
	     

      var data = new FormData();
      data.append("archivo", fo);
    
        
				$.ajax({
				  url: "ajax/valida-archivo-carga-precios-lista.php",
	      	method: "POST",
	      	data: data,
	      	cache: false,
	     	  contentType: false,
	     	  processData: false,
	     	  dataType:"json",	
	     	  success: function(r){              
            if(r == 1){
					             
					              	procesa_carga_precios();
					              					              
					        
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
	
      var data = new FormData();
      data.append("archivo", fo);
    
				$.ajax({
				  url: "ajax/procesa-carga-precios-lista.ajax.php",
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
		      text: "¡El proceso de actualización de precios, finalizó con éxito!",
		      type: "success",
		      confirmButtonText: "¡Cerrar!"
		    }); 

  
	$("#archivoCarga").val("");
  
}


