<?php

require_once "conexion.php";

class ModeloTransporteGuia{

	
	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarTrasporteGuia($item){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM transporte_guia WHERE id = $item");
			
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM transporte_guia order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}	
	

}

