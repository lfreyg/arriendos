<?php

class ControladorEquipos{

	

	/*=============================================
	MOSTRAR TIPO EQUIPOS
	=============================================*/

	static public function ctrMostrarEquipo($item, $valor){

		$tabla = "equipos";

		$respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrValidarEquipos($valor){

		
		$respuesta = ModeloEquipos::mdlValidarEquipos($valor);

		return $respuesta;
	}

	static public function ctrMostrarEquipoDiez($item, $valor){

		$tabla = "equipos";

		$respuesta = ModeloEquipos::mdlMostrarEquiposDiez($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrBorrarEquipo($item, $valor){

		$tabla = "equipos";

		$respuesta = ModeloEquipos::mdlBorrarEquipos($tabla, $item, $valor);

		return $respuesta;
	}


}
	


