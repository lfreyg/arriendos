<?php

require_once "conexion.php";

class ModeloTipoEquipos{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarTipoEquipos($tabla, $item, $valor){

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

	static public function mdlMostrarTipoEquiposIdCategoria($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarTipoEquiposActivos($item, $valor,$orden){

		   if($item == ''){
		      $stmt = Conexion::conectar()->prepare("SELECT * FROM nombre_equipos where estado = 1");
		  }

		   if($item != ''){
		      $stmt = Conexion::conectar()->prepare("SELECT * FROM nombre_equipos where $item = :$item AND estado = 1");
		      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
		  }

			
			$stmt -> execute();

			return $stmt -> fetchAll();	
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarTipoEquiposActivosPorMarca($tabla, $item, $valor){

		    $stmt = Conexion::conectar()->prepare("SELECT * FROM nombre_equipos where  estado = 1");

			$stmt -> execute();

			return $stmt -> fetchAll();	
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE TIPO EQUIPOS
	=============================================*/

	static public function mdlIngresarTipoEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria,id_marca,descripcion,precio,modelo, meses_garantia,vida_util) VALUES (:idCategoria,:marca,:descripcion,:precio,:modelo,:garantia,:vida)");

		$stmt -> bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_INT);		
		$stmt -> bindParam(":descripcion", strtoupper(str_replace('"', "''",$datos["descripcion"])), PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
		$stmt -> bindParam(":modelo", strtoupper(str_replace('"', "''",$datos["modelo"])), PDO::PARAM_STR);
		$stmt -> bindParam(":garantia", $datos["garantia"], PDO::PARAM_INT);
		$stmt -> bindParam(":vida", $datos["vida"], PDO::PARAM_INT);


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

	static public function mdlEditarTipoEquipos($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_marca = :marca, descripcion = :descripcion, modelo = :modelo, precio = :precio, foto = :foto, meses_garantia = :meses_garantia, vida_util = :vida WHERE id = :id");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_INT);
		$stmt -> bindParam(":descripcion", strtoupper($datos["descripcion"]), PDO::PARAM_STR);
		$stmt -> bindParam(":modelo", strtoupper($datos["modelo"]), PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);		
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":meses_garantia", $datos["garantia"], PDO::PARAM_INT);	
		$stmt -> bindParam(":vida", $datos["vida"], PDO::PARAM_INT);	
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

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

	static public function mdlActualizarTipo($tabla, $item1, $valor1, $item2, $valor2){

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

	
	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlBorrarTipoEquipos($tabla, $datos){

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

	static public function mdlValidarTipoEquipos($item1, $valor1,$item2,$valor2,$item3,$valor3,$item4,$valor4){

		if($item1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM nombre_equipos WHERE id_categoria = :valor1 and id_marca = :valor2 and descripcion = :valor3 and modelo = :valor4");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
			$stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);

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




}