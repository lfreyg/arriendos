<?php

class ControladorDetalleFacturas{


	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarDetalleCodigo($item, $valor){

		$tabla = "equipos";

		$respuesta = ModeloFacturasDetalles::mdlMostrarCodigos($tabla, $item, $valor);

		return $respuesta;
	
	}

	
}
