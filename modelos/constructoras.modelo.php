<?php

require_once "conexion.php";

class ModeloConstructoras{

	

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarConstructoras($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarConstructorasActivas(){		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM constructoras where estado = 1  order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	CREAR 
	=============================================*/

	static public function mdlIngresarConstructora($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rut,nombre,direccion,telefono,contacto_cobranza,telefono_cobranza,email_cobranza,forma_pago_id,banco, codigo_actividad) VALUES (:rut, :nombre, :direccion, :telefono, :contacto, :telefonoCobra, :mailCobra,:formaPago, :banco, :codigoAct)");

		$stmt->bindParam(":rut", strtoupper($datos['rut']), PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);	
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);		
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);	
		$stmt->bindParam(":telefonoCobra", strtoupper($datos['telefonoCobra']), PDO::PARAM_STR);	
		$stmt->bindParam(":mailCobra", strtolower($datos['mailCobra']), PDO::PARAM_STR);
		$stmt->bindParam(":formaPago", strtoupper($datos['formaPago']), PDO::PARAM_STR);		
		$stmt->bindParam(":banco", strtoupper($datos['banco']), PDO::PARAM_STR);
		$stmt->bindParam(":codigoAct", strtoupper($datos['codigoAct']), PDO::PARAM_STR);

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

	static public function mdlEditarConstructora($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, direccion = :direccion, telefono = :telefono, contacto_cobranza = :contacto, telefono_cobranza = :telefonoCobra, email_cobranza = :mailCobra, forma_pago_id = :formaPago, banco = :banco, codigo_actividad = :codigoAct WHERE id = :id");

		$stmt->bindParam(":id", strtoupper($datos['id']), PDO::PARAM_STR);		
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);	
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);		
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);	
		$stmt->bindParam(":telefonoCobra", strtoupper($datos['telefonoCobra']), PDO::PARAM_STR);	
		$stmt->bindParam(":mailCobra", strtolower($datos['mailCobra']), PDO::PARAM_STR);
		$stmt->bindParam(":formaPago", strtoupper($datos['formaPago']), PDO::PARAM_STR);		
		$stmt->bindParam(":banco", strtoupper($datos['banco']), PDO::PARAM_STR);
		$stmt->bindParam(":codigoAct", strtoupper($datos['codigoAct']), PDO::PARAM_STR);
				

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

	static public function mdlBorrarConstructora($tabla, $datos){

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

	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/

	static public function mdlActualizar($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	

}

