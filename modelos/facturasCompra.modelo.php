<?php

require_once "conexion.php";

class ModeloFacturasCompra{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarFacturasCompra($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha_factura DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaExisteFacturaCompra($tabla, $datos){

		$id_proveedor = $datos["id_proveedor"];
		$factura = $datos["numero_factura"];

		$sql = Conexion::conectar()->prepare("SELECT * FROM facturas_compra_equipos where id_proveedor = $id_proveedor and numero_factura = $factura");
        
        $sql -> execute();
		return $sql -> fetch();
        
    }

	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarFacturasCompra($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_proveedor, numero_factura, fecha_factura, imagen, usuario_registro) VALUES (:id_proveedor, :numero_factura, :fecha_factura, :imagen, :usuario)");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":numero_factura", $datos["numero_factura"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_factura", $datos["fecha_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);		
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from facturas_compra_equipos");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR 
	=============================================*/
	static public function mdlEditarFacturasCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_proveedor = :id_proveedor, numero_factura = :numero_factura, fecha_factura = :fecha_factura, imagen = :imagen where id = :id");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":numero_factura", $datos["numero_factura"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_factura", $datos["fecha_factura"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		

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

	static public function mdlEliminarFacturasCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			$stmt2 = Conexion::conectar()->prepare("DELETE FROM equipos WHERE id_factura = :id");
			$stmt2 -> bindParam(":id", $datos, PDO::PARAM_INT);
			$stmt2 -> execute();

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	


	

	static public function mdlFacturaPorId($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("select * FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);		

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlSumaTotalFacturaCompra($anio){

		    $anno = $anio;

			$stmt = Conexion::conectar()->prepare("SELECT sum(e.precio_compra) as total FROM equipos e join facturas_compra_equipos fce on e.id_factura = fce.id where year(fce.fecha_factura) = $anno");	
			

			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}


}