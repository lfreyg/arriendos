<?php

require_once "conexion.php";

class ModeloTalleres{

	

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarTalleres($id){

		if($id != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM talleres WHERE id = $id");

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from talleres order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlTallerExiste($rut){

		

			$stmt = Conexion::conectar()->prepare("SELECT id FROM talleres WHERE rut = '$rut'");

			$stmt -> execute();

			return $stmt -> fetch();

		
		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarTalleresActivos(){		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM talleres where activo = true  order by nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	CREAR 
	=============================================*/

	static public function mdlIngresarTaller($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO talleres(rut,nombre,direccion,comuna,ciudad,telefono,correo,contacto) VALUES (:rut, :nombre, :direccion, :comuna, :ciudad, :telefono, :correo, :contacto)");

		$stmt->bindParam(":rut", strtoupper($datos['rut']), PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);	
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);		
		$stmt->bindParam(":correo", strtoupper($datos['correo']), PDO::PARAM_STR);	
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);	
		$stmt->bindParam(":comuna", strtolower($datos['comuna']), PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", strtoupper($datos['ciudad']), PDO::PARAM_STR);		
		

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

	static public function mdlEditarTaller($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE talleres SET nombre = :nombre, direccion = :direccion, comuna = :comuna, ciudad = :ciudad, telefono = :telefono, correo = :correo, contacto = :contacto WHERE id = :id");

		$stmt->bindParam(":id", strtoupper($datos['id']), PDO::PARAM_INT);		
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);	
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);		
		$stmt->bindParam(":correo", strtoupper($datos['correo']), PDO::PARAM_STR);	
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);	
		$stmt->bindParam(":comuna", strtolower($datos['comuna']), PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", strtoupper($datos['ciudad']), PDO::PARAM_STR);
				

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

	static public function mdlBorrarTaller($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM talleres WHERE id = :id");

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

	static public function mdlActualizarActivo($tabla, $item1, $valor1, $item2, $valor2){

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

