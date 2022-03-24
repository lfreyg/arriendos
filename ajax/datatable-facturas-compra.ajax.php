<?php

require_once "../controladores/facturasCompra.controlador.php";
require_once "../modelos/facturasCompra.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";


class TablaFacturasCompra{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaFacturasCompra(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$facturasCompra = ControladorFacturasCompra::ctrMostrarFacturasCompra($item, $valor, $orden);	

  		if(count($facturasCompra) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($facturasCompra); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	if(!empty($facturasCompra[$i]["imagen"])){
		  	    $imagen = "<a href='".$facturasCompra[$i]["imagen"]."' target='_blank'>Descargar</a>";
		    }else{
		  	    $imagen = "";
		    }

		  	/*=============================================
 	 		TRAEMOS PROVEEDOR
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $facturasCompra[$i]["id_proveedor"];

		  	$proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		  	$date = date_create($facturasCompra[$i]["fecha_factura"]);
		  	$fechaFactura = date_format($date,"d-M-Y");

		  	$dateReg = date_create($facturasCompra[$i]["fecha_registro"]);
		  	$fechaReg = date_format($dateReg,"d-M-Y H:i:s");

		  	$valida = ModeloEquipos::mdlValidaEquipoBorrar($facturasCompra[$i]["id"]);

		  	if($valida == true){
		  		$disable = 'disabled';
		  	}else{
		  		$disable = '';
		  	}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarFacturaCompra' idFactura='".$facturasCompra[$i]["id"]."'><i class='fa fa-pencil'></i></button><button ".$disable." class='btn btn-danger btnEliminarFacturaCompra' idFactura='".$facturasCompra[$i]["id"]."'><i class='fa fa-times'></i></button><button class='btn btn-info btnDetalleFactura' title='Detalle' idFactura='".$facturasCompra[$i]["id"]."'><i class='fa fa-th'></i></button></div>";

  				  			
            $valor = $facturasCompra[$i]["id"];
            $totalFactura = ModeloEquipos::mdlSumaTotalFactura($valor);
		 
		  	$datosJson .='[
			      "'.($i+1).'",			      
			      "'.$proveedores["nombre"].'",
			      "'.$facturasCompra[$i]["numero_factura"].'",			      
			      "'.$fechaFactura.'",	
			      "'.$fechaReg.'",		     
			      "'."$ ".number_format($totalFactura["total"],0,"",".").'",	
			      "'.$imagen.'",	
			      "'.$facturasCompra[$i]["usuario_registro"].'",			     
			      "'.$botones.'"
			    ],';

		  }


		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarFacturasCompra = new TablaFacturasCompra();
$activarFacturasCompra -> mostrarTablaFacturasCompra();

