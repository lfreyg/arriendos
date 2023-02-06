<?php

require_once "conexion.php";

class ModeloGuiaDespacho{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarGuiaDespacho($idSucursal){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT gd.id as id, eo.razon_social as empresa, gd.numero_guia as guia, gd.fecha_guia as fecha, c.nombre as constructora, o.nombre as obra, gd.oc as oc, gd.adjunto as adjunto, gd.estado_guia as idestado, e.descripcion as estado, tg.id as idtransporte, tg.nombre as chofer FROM guia_despacho gd JOIN empresas_operativas eo ON gd.id_empresa = eo.id JOIN constructoras c ON gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id JOIN estados e ON gd.estado_guia = e.id LEFT JOIN transporte_guia tg ON gd.id_transporte_guia = tg.id  where gd.id_sucursal = $idSucursal and gd.tipo_guia = 'A' order by gd.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoDetalle($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT gd.estado_guia as estadoGuia, eo.id as idEmpresa, eo.razon_social as empresa, gd.numero_guia as guia, gd.fecha_guia as fecha, c.rut as rutConstructora, c.nombre as constructora, o.nombre as obra, gd.oc as oc, gd.fecha_termino as fechaTermino, gd.rut_empresa_transporte as rutTransporte, gd.patente_transportista as patente, gd.rut_transportista as rutChofer, gd.nombre_transportista as chofer, gd.id_constructoras as idConstructora, gd.id_obras as idObra FROM guia_despacho gd JOIN empresas_operativas eo ON gd.id_empresa = eo.id JOIN constructoras c ON gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id where gd.id = $id and gd.tipo_guia = 'A'");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoDetalleTraslado($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT gd.estado_guia as estadoGuia, eo.id as idEmpresa, eo.razon_social as empresa, gd.numero_guia as guia, gd.fecha_guia as fecha, gd.rut_empresa_transporte as rutTransporte, gd.patente_transportista as patente, gd.rut_transportista as rutChofer, gd.nombre_transportista as chofer, gd.id_sucursal as sucursal_origen FROM guia_despacho gd JOIN empresas_operativas eo ON gd.id_empresa = eo.id where gd.id = $id and gd.tipo_guia = 'T'");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoUnico($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho WHERE id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}

	

	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarGuiaDespacho($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, fecha_guia, id_constructoras, id_obras, id_sucursal, adjunto, oc, fecha_termino, id_transporte_guia, rut_empresa_transporte, rut_transportista, nombre_transportista, patente_transportista, creado_por, tipo_guia) VALUES (:id_empresa,:fecha_guia,:id_constructora, :id_obra, :id_sucursal, :adjunto, :oc, :fecha_termino, :id_transporte_guia, :rut_empresa_transporte, :rut_transportista, :nombre_transportista, :patente_transportista, :creado_por, :tipoGuia)");

		$stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_guia", $datos["fecha_guia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);	
		$stmt->bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_STR);
		$stmt->bindParam(":id_transporte_guia", $datos["id_transporte_guia"], PDO::PARAM_INT);	
		$stmt->bindParam(":rut_empresa_transporte", $datos["rut_empresa_transporte"], PDO::PARAM_STR);
		$stmt->bindParam(":rut_transportista", $datos["rut_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_transportista", $datos["nombre_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":patente_transportista", $datos["patente_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoGuia", $datos["tipoGuia"], PDO::PARAM_STR);
		
		
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

	static public function mdlIngresarGuiaDespachoTraslado($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, fecha_guia, id_constructoras, id_obras, id_sucursal, adjunto, oc, fecha_termino, id_transporte_guia, rut_empresa_transporte, rut_transportista, nombre_transportista, patente_transportista, creado_por, tipo_guia, id_sucursal_destino, id_pedido_interno) VALUES (:id_empresa,:fecha_guia,:id_constructora, :id_obra, :id_sucursal, :adjunto, :oc, :fecha_termino, :id_transporte_guia, :rut_empresa_transporte, :rut_transportista, :nombre_transportista, :patente_transportista, :creado_por, :tipoGuia, :sucursalDestino, :idPedidoGenerado)");

		$stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_guia", $datos["fecha_guia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);	
		$stmt->bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_STR);
		$stmt->bindParam(":id_transporte_guia", $datos["id_transporte_guia"], PDO::PARAM_INT);	
		$stmt->bindParam(":rut_empresa_transporte", $datos["rut_empresa_transporte"], PDO::PARAM_STR);
		$stmt->bindParam(":rut_transportista", $datos["rut_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_transportista", $datos["nombre_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":patente_transportista", $datos["patente_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoGuia", $datos["tipoGuia"], PDO::PARAM_STR);
		$stmt->bindParam(":sucursalDestino", $datos["sucursalDestino"], PDO::PARAM_INT);
		$stmt->bindParam(":idPedidoGenerado", $datos["idPedidoGenerado"], PDO::PARAM_INT);
		
		
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

	

	static public function mdlEditarGuiaDespacho($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_guia = :fecha_guia, id_constructoras = :id_constructora, id_obras = :id_obra, adjunto = :adjunto, oc =:oc, fecha_termino =:fecha_termino, id_transporte_guia =:id_transporte_guia, rut_empresa_transporte =:rut_empresa_transporte, rut_transportista =:rut_transportista, nombre_transportista =:nombre_transportista, patente_transportista =:patente_transportista where id = :id");

		$stmt->bindParam(":fecha_guia", $datos["fecha_guia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);					
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_STR);
		$stmt->bindParam(":id_transporte_guia", $datos["id_transporte_guia"], PDO::PARAM_INT);	
		$stmt->bindParam(":rut_empresa_transporte", $datos["rut_empresa_transporte"], PDO::PARAM_STR);
		$stmt->bindParam(":rut_transportista", $datos["rut_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_transportista", $datos["nombre_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":patente_transportista", $datos["patente_transportista"], PDO::PARAM_STR);
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

	static public function mdlEliminarGuiaDespacho($id){
       
       $estado = 1; //VUELVE LOS EQUIPOS A DISPONIBLE
		
       $sqlGuia = Conexion::conectar()->prepare("UPDATE equipos e JOIN guia_despacho_detalle gdd ON e.id = gdd.id_equipo SET e.id_estado = $estado WHERE gdd.id_guia = $id"); 
               $sqlGuia->execute();

        $sqlPedido = Conexion::conectar()->prepare("UPDATE pedido_equipo_detalle SET id_guia_despacho = null, id_guia_detalle = null, id_equipo = null, fecha_entrega = null WHERE id_guia_despacho = $id");

	          $sqlPedido->execute();        

		$stmt = Conexion::conectar()->prepare("DELETE FROM guia_despacho WHERE id = $id");
		
		if($stmt -> execute()){
           
           
			$stmt2 = Conexion::conectar()->prepare("DELETE FROM guia_despacho_detalle WHERE id_guia = $id");		
			$stmt2 -> execute();

			 $sqlMaterial = Conexion::conectar()->prepare("UPDATE materiales_insumos mi JOIN guia_despacho_materiales gdm ON mi.id = gdm.id_materiales_insumos SET mi.cantidad_sale = mi.cantidad_sale - gdm.cantidad WHERE gdm.id_guia = $id"); 

                         $sqlMaterial->execute();

			$stmt3 = Conexion::conectar()->prepare("DELETE FROM guia_despacho_materiales WHERE id_guia = $id");		
			$stmt3 -> execute();
			

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ANULAR 
	=============================================*/

	static public function mdlAnularGuiaDespacho($id, $idUsuario){

		$estado = 1; //VUELVE LOS EQUIPOS A DISPONIBLE

		 $sqlGuia = Conexion::conectar()->prepare("UPDATE equipos e JOIN guia_despacho_detalle gdd ON e.id = gdd.id_equipo SET e.id_estado = $estado WHERE gdd.id_guia = $id"); 
               $sqlGuia->execute();

               $sqlPedido = Conexion::conectar()->prepare("UPDATE pedido_equipo_detalle SET id_guia_despacho = null, id_guia_detalle = null, id_equipo = null, fecha_entrega = null WHERE id_guia_despacho = $id");

	          $sqlPedido->execute();

		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho SET estado_guia = 14 WHERE id = $id");
		
		if($stmt -> execute()){

			date_default_timezone_set('America/Santiago');
        		$hoy = date('Y-m-d H:i:s');
           
           $stmt2 = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET registro_eliminado = true, usuario_elimina = $idUsuario, fecha_elimina = :hoy WHERE id_guia = $id");		
		   $stmt2 -> execute();

		   $stmt2->bindParam(":hoy", $hoy, PDO::PARAM_STR);

		   $sqlMaterial = Conexion::conectar()->prepare("UPDATE materiales_insumos mi JOIN guia_despacho_materiales gdm ON mi.id = gdm.id_materiales_insumos SET mi.cantidad_sale = mi.cantidad_sale - gdm.cantidad WHERE gdm.id_guia = $id"); 
			 
                   $sqlMaterial->execute();

			
           $stmt3 = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales SET registro_eliminado = true WHERE id_guia = $id");		
		   $stmt3 -> execute();		   
			

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaEquipoDevueltoParaGuiaCompleta($idGuia){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho_detalle WHERE validado = 0 and id_guia = $idGuia");

			
		    $stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

	static public function mdlValidaMaterialValidado($idGuia){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho_materiales WHERE validado = 0 and id_guia = $idGuia");

			
		    $stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

	static public function mdlValidaEquipoConMatch($idGuia){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho_detalle WHERE match_cambio is not null and id_guia = $idGuia");

			
		   $stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

        //FUNCION VALIDA SI EXISTE ALGUNA GUIA SIN ENVIAR A SII, NO PUEDE CREAR NUEVA GUIA SI EXISTEN SIN FIRMAR, APLICA SOLO PARA TRASLADO DE PEDIDO
	static public function mdlValidarGuiaDespachoTrasladoPedido($idPedido){

		      $estado = 12; //GUIA SIN ENVIAR A SII

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho WHERE estado_guia = $estado and tipo_guia = 'T' and id_pedido_interno = $idPedido");

		   $stmt -> execute();

		  return $stmt -> fetchAll();

		  $stmt -> close();

		  $stmt = null;

	}

	static public function mdlGuiaDespachoTrasladoPedido($idPedido){

		   
			$stmt = Conexion::conectar()->prepare("SELECT gd.id as idGuia, gd.numero_guia as numeroGuia, s.nombre as sucursalDestino, su.nombre as sucursalOrigen, gd.nombre_transportista as chofer, e.descripcion as estadoGuia, gd.fecha_guia as fecha, gd.creado_por as usuarioCrea FROM guia_despacho gd join sucursales s on gd.id_sucursal_destino = s.id join sucursales su on gd.id_sucursal = su.id JOIN estados e on gd.estado_guia = e.id where gd.id_pedido_interno = $idPedido and gd.estado_guia != 14 and gd.tipo_guia = 'T' order by gd.id desc");

		   $stmt -> execute();

		  return $stmt -> fetchAll();

		  $stmt -> close();

		  $stmt = null;

	}


	static public function mdlValidarEnPedido($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido_equipo_detalle where id_guia_despacho = $id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

		


}