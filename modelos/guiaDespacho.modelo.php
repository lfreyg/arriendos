<?php

require_once "conexion.php";

class ModeloGuiaDespacho{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarGuiaDespacho($idSucursal){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT gd.id as id, eo.razon_social as empresa, gd.numero_guia as guia, gd.fecha_guia as fecha, c.nombre as constructora, o.nombre as obra, gd.oc as oc, gd.adjunto as adjunto, gd.estado_guia as idestado, e.descripcion as estado FROM guia_despacho gd JOIN empresas_operativas eo ON gd.id_empresa = eo.id JOIN constructoras c ON gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id JOIN estados e ON gd.estado_guia = e.id where gd.id_sucursal = $idSucursal order by gd.numero_guia desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoDetalle($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, c.nombre as constructora, o.nombre as obra, s.nombre as sucursal, u.nombre as usuario, e.descripcion as estado, pe.compartido as compartido, pe.documento as documento, pe.creado as creado, pe.orden_compra as oc FROM pedido_equipo pe join constructoras c on pe.id_constructoras = c.id join obras o on pe.id_obras = o.id join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id join estados e on pe.estado = e.id WHERE pe.id = $id");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoUnico($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido_equipo WHERE id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

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
	static public function mdlIngresarGuiaDespacho($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, fecha_guia, id_constructoras, id_obras, id_sucursal, adjunto, oc, creado_por) VALUES (:id_empresa,:fecha_guia,:id_constructora, :id_obra, :id_sucursal, :adjunto, :oc, :creado_por)");

		$stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_guia", $datos["fecha_guia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);		
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from guia_despacho");
 
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
	static public function mdlEditarGuiaDespacho($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_constructoras = :id_constructora, id_obras = :id_obra, id_sucursal = :id_sucursal, documento = :documento, orden_compra =:oc where id = :id");

		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);			
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);
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

	static public function mdlEliminarGuiaDespacho($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			$stmt2 = Conexion::conectar()->prepare("DELETE FROM pedido_equipo_detalle WHERE id_pedido_equipo = :id");
			$stmt2 -> bindParam(":id", $datos, PDO::PARAM_INT);
			$stmt2 -> execute();

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaEquipoPedido($valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido_equipo_detalle WHERE cantidad_guia > 0 and id_pedido_equipo = $valor");

			
			$stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

		


}