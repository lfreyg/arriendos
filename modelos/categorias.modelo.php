<?php

require_once "conexion.php";

class ModeloCategorias{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES (:categoria)");

		$stmt->bindParam(":categoria", strtoupper(str_replace('"',"''",$datos)), PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarCategorias($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by categoria");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CATEGORIAS STOCK
	=============================================*/

	
	static public function mdlMostrarStockCategorias($idCategoria, $idSucursal){

		    $estadoDisponible = 1;
		    $estadoRevision = 18;

			$stmt = Conexion::conectar()->prepare("select count(ne.id_categoria) as stock FROM nombre_equipos ne join equipos e on ne.id = e.id_nombre_equipos where ne.id_categoria = $idCategoria and e.id_estado = $estadoDisponible and e.id_sucursal = $idSucursal GROUP BY ne.id_categoria");					
			

			$stmt -> execute();

			$stock = $stmt -> fetch();

			if($stock){
				$stock_solo = $stock["stock"];
			}else{
				$stock_solo = 0;
			}



			
			$stmt = Conexion::conectar()->prepare("select count(ne.id_categoria) as repara FROM nombre_equipos ne join equipos e on ne.id = e.id_nombre_equipos where ne.id_categoria = $idCategoria and e.id_estado = $estadoRevision and e.id_sucursal = $idSucursal GROUP BY ne.id_categoria");					
			

			$stmt -> execute();

			$repara = $stmt -> fetch();

			if($repara){
				$repara_solo = $repara["repara"];
			}else{
				$repara_solo = 0;
			}
			

			
			$stmt = Conexion::conectar()->prepare("select count(ne.id_categoria) as tengo FROM nombre_equipos ne join equipos e on ne.id = e.id_nombre_equipos where ne.id_categoria = $idCategoria and e.id_sucursal = $idSucursal GROUP BY ne.id_categoria");					
			

			$stmt -> execute();

			$tengo = $stmt -> fetch();

			if($tengo){
				$tengo_solo = $tengo["tengo"];
			}else{
				$tengo_solo = 0;
			}
			
            
             $arreglo = array($stock_solo);
             array_push($arreglo,$repara_solo);
             array_push($arreglo,$tengo_solo);

             return $arreglo;
         
		


		//$stmt -> close();

		//$stmt = null;

	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", strtoupper(str_replace('"',"''",$datos["categoria"])), PDO::PARAM_STR);
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
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarCategoria($tabla, $datos){

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

