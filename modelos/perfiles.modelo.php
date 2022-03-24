<?php

require_once "conexion.php";

class ModeloPerfiles{

	

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarPerfiles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarFormasPago(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM forma_pago");

			$stmt -> execute();

			return $stmt -> fetchAll();

			$stmt -> close();

		    $stmt = null;
	}

	static public function mdlMostrarFormasPagoId($tabla, $item, $valor){
		   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

		    $stmt = null;
	}

	static public function mdlMostrarFormasCobro(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tipo_cobro");

			$stmt -> execute();

			return $stmt -> fetchAll();

			$stmt -> close();

		    $stmt = null;
	}

	static public function mdlMostrarFormasCobroId($tabla, $item, $valor){
		   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

		    $stmt = null;
	}

	

	static public function mdlMostrarBancos(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM bancos order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

			$stmt -> close();

		    $stmt = null;
	}

	static public function mdlMostrarBancosId($tabla, $item, $valor){
		   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

		    $stmt = null;
	}
	

}

