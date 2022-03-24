<?php

class ControladorPerfiles{


	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarPerfiles($item, $valor){

		$tabla = "roles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarFormaPago(){

		

		$respuesta = ModeloPerfiles::mdlMostrarFormasPago();

		return $respuesta;
	
	}

	static public function ctrMostrarFormaPagoId($item, $valor){

		$tabla = "forma_pago";

		$respuesta = ModeloPerfiles::mdlMostrarFormasPagoId($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarFormaCobro(){

		

		$respuesta = ModeloPerfiles::mdlMostrarFormasCobro();

		return $respuesta;
	
	}

	static public function ctrMostrarFormaCobroId($item, $valor){

		$tabla = "tipo_cobro";

		$respuesta = ModeloPerfiles::mdlMostrarFormasCobroId($tabla, $item, $valor);

		return $respuesta;
	
	}

	
	static public function ctrMostrarBancos(){

		
		$respuesta = ModeloPerfiles::mdlMostrarBancos();

		return $respuesta;
	
	}

	static public function ctrMostrarBancosId($item, $valor){

		$tabla = "bancos";

		$respuesta = ModeloPerfiles::mdlMostrarBancosId($tabla, $item, $valor);

		return $respuesta;
	
	}
	
		
	}

