<?php

require_once "conexion.php";

class ModeloProveedores{

	

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarProveedores($tabla, $item, $valor){

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
	CREAR 
	=============================================*/

	static public function mdlIngresarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rut,nombre,contacto,direccion,telefono,email) VALUES (:rut,:nombre,:contacto,:direccion,:telefono,:correo)");

		$stmt->bindParam(":rut", strtoupper($datos['rut']), PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);
		$stmt->bindParam(":correo", strtolower($datos['correo']), PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function mdlEditarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, contacto = :contacto, direccion = :direccion, telefono = :telefono, email = :correo WHERE id = :id");

		$stmt->bindParam(":id", strtoupper($datos['id']), PDO::PARAM_STR);		
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);
		$stmt->bindParam(":correo", strtolower($datos['correo']), PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlBorrarProveedor($tabla, $datos){

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
	

}

