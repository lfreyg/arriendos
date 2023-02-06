<?php

require_once "../modelos/facturacionNCND.modelo.php";


class TablaListadoFacturaNCND{

 	public $idEmpresa;

	public function mostrarTablaListadoFacNCND(){

		
         $idEmpresa = $this->idEmpresa;    

  		$facturas = ModeloFacturacionNCND::mdlMostrarFacturasNCND($idEmpresa);


  		if(count($facturas) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($facturas); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ADJUNTO
  			=============================================*/ 
             
            $idFactura = $facturas[$i]["idFactura"]; 
            $empresa = $facturas[$i]["empresa"];
            $numFactura = $facturas[$i]["numFactura"];
            $fecha = $facturas[$i]["fecha"];
            $rutCliente = $facturas[$i]["rutCliente"];
            $cliente = $facturas[$i]["cliente"];
            $obra = $facturas[$i]["obra"];
            $estadoFac = $facturas[$i]["estado"];            
            $neto = $facturas[$i]['neto'];
           


            
		  		  			  			  	
		  	$dateReg = date_create($facturas[$i]["fecha"]);
		  	$fecha = date_format($dateReg,"d-m-Y");

		  	if($obra == null){
		  		$obra = '';
		  	}

		  	$nc = ModeloFacturacionNCND::mdlContarNC($idFactura);
		  	$sonNC = $nc["sonNC"];

		  	$nc = ModeloFacturacionNCND::mdlContarND($idFactura);
		  	$sonND = $nc["sonND"];


		  
		  	   $btnNC = "<div class='btn-group'><button class='btn btn-warning btnNC' title='Nota Crédito' idFactura='".$idFactura."'>".$sonNC."</button></div>";

		  	   $btnND = "<div class='btn-group'><button class='btn btn-success btnND' title='Nota Débito' idFactura='".$idFactura."'>".$sonND."</button></div>";

		  	//  $link = "<a href='https://example.com'>Website</a>";
  			
              $link = "<a href='extensiones/pdf/TCPDF/factura.php?idFactura=".$idFactura."' target='_blank'>".$numFactura."</a>";
  				  				  	       
		 
		  	$datosJson .='[
			      "'.$empresa.'",	
			      "'.$link.'",
			      "'.$fecha.'",			     	
			      "'.'$ '.number_format($neto,0,'','.').'",	     
			      "'.$rutCliente.'",
			      "'.$cliente.'",
			      "'.$obra.'",
			      "'.$estadoFac.'",			      		     
			      "'.$btnNC.'",
			      "'.$btnND.'"
			    ],';

		  }


		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA REPORT DEVOLUCION
=============================================*/ 
$mostrar = new TablaListadoFacturaNCND();
$mostrar -> idEmpresa = $_POST["idEmpresa"];
$mostrar -> mostrarTablaListadoFacNCND();

