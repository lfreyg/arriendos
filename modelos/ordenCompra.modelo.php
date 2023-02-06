<?php

require_once "conexion.php";

class ModeloOrdenCompra{

	/*=============================================
	MOSTRAR LISTA PARA TABLA
	=============================================*/

	static public function mdlMostrarListadoOC($idObra, $idEEPP){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT oc.id as idRegistro, oc.id_constructora as constructora, oc.id_obra as obra, oc.numero_oc as oc, oc.fecha_oc as fechaOC, oc.fecha_creacion as fechaCrea, oc.usuario_crea as usuario, oc.id_factura, f.numero_factura, f.neto FROM oc_arriendos oc left join factura f on oc.id_factura = f.id where oc.id_obra = $idObra and oc.id_eepp = $idEEPP");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	
	static public function mdlMostrarOC($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM oc_arriendos WHERE id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}


	static public function mdlMostrarOCConDatos($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT oc.numero_oc as oc, oc.fecha_oc as fecha, c.nombre as constructora, o.nombre as obra, oc.id_constructora as idConstructora, oc.id_obra as idObra, oc.id as idOC, oc.id_eepp, oc.id_factura FROM oc_arriendos oc JOIN constructoras c ON oc.id_constructora = c.id JOIN obras o ON oc.id_obra = o.id WHERE oc.id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}

	
	/*=============================================
	REGISTRO ORDEN COMPRA
	=============================================*/
	static public function mdlIngresarOC($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO oc_arriendos(id_constructora, id_obra, id_eepp, numero_oc, fecha_oc, usuario_crea) VALUES (:id_constructora, :id_obra, :id_eepp, :oc, :fechaOC, :usuario)");

		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_eepp", $datos["id_eepp"], PDO::PARAM_INT);
		$stmt->bindParam(":oc", strtoupper($datos["oc"]), PDO::PARAM_STR);	
		$stmt->bindParam(":fechaOC", $datos["fechaOC"], PDO::PARAM_STR);	
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);		
		
	
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from oc_arriendos");
 
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
	static public function mdlEditarOC($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE oc_arriendos SET numero_oc = :numero_oc, fecha_oc = :fecha_oc where id = :id");

		$stmt->bindParam(":numero_oc", strtoupper($datos["oc"]), PDO::PARAM_STR);
		$stmt->bindParam(":fecha_oc", $datos["fechaOC"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		

		if($stmt->execute()){

		     $sqlocDet = Conexion::conectar()->prepare("UPDATE oc_arriendos_detalle SET numero_oc = :numero_oc where id_oc_arriendo = :id");

			$sqlocDet->bindParam(":numero_oc", strtoupper($datos["oc"]), PDO::PARAM_STR);
			$sqlocDet->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$sqlocDet->execute();

			$sqlRef = Conexion::conectar()->prepare("UPDATE referencia_factura SET numero_referencia = :numero_oc, fecha_referencia = :fecha_oc where id_oc_arriendo = :id");

			$sqlRef->bindParam(":numero_oc", strtoupper($datos["oc"]), PDO::PARAM_STR);
			$sqlRef->bindParam(":fecha_oc", $datos["fechaOC"], PDO::PARAM_STR);
			$sqlRef->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$sqlRef->execute();

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

	static public function mdlEliminarOC($idOC){

		
		
       $sqlOC = Conexion::conectar()->prepare("DELETE FROM oc_arriendos where id = $idOC"); 
               
               $sqlOC->execute();

		$stmt = Conexion::conectar()->prepare("DELETE FROM oc_arriendos_detalle WHERE id_oc_arriendo = $idOC");

	
		$stmt -> execute();
			
		return "ok";	
		
		

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	REGISTRO DETALLE ORDEN COMPRA
	=============================================*/
	static public function mdlIngresarDetalleOC($datos){
                
                $precio = $datos["precio_oc"];
                $cantidad = $datos["cantidad_oc"]; 
                $total = $precio * $cantidad;
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO oc_arriendos_detalle(id_oc_arriendo, numero_oc, id_constructora, id_obra, id_eepp, id_eepp_detalle, precio_oc, cantidad_oc, total, tabla) VALUES (:id_oc_arriendo, :numero_oc, :id_constructora, :id_obra, :id_eepp, :id_eepp_detalle, :precio_oc, :cantidad_oc, :total, :tabla)");

		
		$stmt->bindParam(":id_oc_arriendo", $datos["id_oc_arriendo"], PDO::PARAM_INT);
		$stmt->bindParam(":numero_oc", $datos["numero_oc"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);	
		$stmt->bindParam(":id_eepp", $datos["id_eepp"], PDO::PARAM_INT);	
		$stmt->bindParam(":id_eepp_detalle", $datos["id_eepp_detalle"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_oc", $datos["precio_oc"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad_oc", $datos["cantidad_oc"], PDO::PARAM_INT);
		$stmt->bindParam(":total", $total, PDO::PARAM_INT);
		$stmt->bindParam(":tabla", $datos["tabla"], PDO::PARAM_STR);		
		
	
		if($stmt->execute()){
                   return "ok";                 

		}else{

		   return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	static public function mdlDetalleOCPorId($idOC){

		$stmt = Conexion::conectar()->prepare("SELECT id, id_oc_arriendo, numero_oc, id_constructora, id_obra, id_eepp, id_eepp_detalle, precio_origen, cantidad_origen, precio_oc, cantidad_oc, total, tabla FROM oc_arriendos_detalle where id_oc_arriendo = $idOC");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlEliminarDetalleOC($idRegistro){

		
		
      	$stmt = Conexion::conectar()->prepare("DELETE FROM oc_arriendos_detalle WHERE id = $idRegistro");

	
		$stmt -> execute();
			
		return "ok";	
		
		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlValidaExiste($datos){

        $fechaInicio = 	$datos["fechaInicio"];	
		
      	$stmt = Conexion::conectar()->prepare("SELECT * FROM oc_arriendos_detalle WHERE id_guia_despacho_detalle = :idRegistroGuiaDetalle and fecha_hasta >= '$fechaInicio'");

      	        $stmt->bindParam(":idRegistroGuiaDetalle", $datos["idRegistroGuiaDetalle"], PDO::PARAM_INT);
      	       
	
		$stmt -> execute();

		return $stmt -> fetch();
		
		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlObtenerCantidadesEEPPOC($datos){

       		
      	$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad_oc) as cantidad FROM oc_arriendos_detalle WHERE id_eepp_detalle = :id and tabla = :tipoTabla");

      	 $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
      	 $stmt->bindParam(":tipoTabla", $datos["tipoTabla"], PDO::PARAM_STR);
      	        
		$stmt -> execute();

		return $stmt -> fetch();
		
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidarExisteEnOC($datos){

       		
      	$stmt = Conexion::conectar()->prepare("SELECT id FROM oc_arriendos_detalle WHERE id_eepp_detalle = :id and tabla = :tipoTabla and id_oc_arriendo = :idOC");

      	 $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
      	 $stmt->bindParam(":tipoTabla", $datos["tipoTabla"], PDO::PARAM_STR);
      	 $stmt->bindParam(":idOC", $datos["idOC"], PDO::PARAM_INT);
      	        
		$stmt -> execute();

		return $stmt -> fetch();
		
		

		$stmt -> close();

		$stmt = null;

	}




	static public function mdlMostrarDescuentosExtrasOC($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT ede.descripcion, if(ede.tipo = 'D',ede.monto * -1,ede.monto) as montoCambio, if(ede.tipo = 'D','DESCUENTO','EXTRA') as tipoActo FROM eepp_descuentos_extras ede WHERE ede.id = $id");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	







	
}