<?php

require_once "conexion.php";

class ModeloTransportista{

	/*=============================================
	CREAR CHOFER
	=============================================*/

	static public function mdlIngresarTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rut,nombre,patente,rut_empresa_transporte) VALUES (:rut,:nombre,:patente,:empresa)");

		$stmt->bindParam(":rut", str_replace(".","",strtoupper($datos['rut'])), PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":patente", strtoupper($datos['patente']), PDO::PARAM_STR);
		$stmt->bindParam(":empresa", str_replace(".","",strtoupper($datos['empresa'])), PDO::PARAM_STR);
				

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CHOFER
	=============================================*/

	static public function mdlMostrarTransportistas($tabla, $item, $valor){

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

	/*=============================================
	EDITAR CHOFER
	=============================================*/

	static public function mdlEditarTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET patente = :patente, rut_empresa_transporte = :empresa WHERE id = :id");

		$stmt -> bindParam(":patente", strtoupper($datos["patente"]), PDO::PARAM_STR);
		$stmt -> bindParam(":empresa", str_replace(".","",strtoupper($datos["empresa"])), PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);		
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CHOFER
	=============================================*/

	static public function mdlBorrarTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidarEliminar($idTransporte){
		
			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho WHERE id_transporte_guia = $idTransporte limit 1");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}

