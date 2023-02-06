<?php

require_once "conexion.php";

class ModeloFacturacionEEPP{

	

	

	static public function mdlMostrarConstructoraFactura(){

    
       
       
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT c.id as id, c.rut as rut, c.nombre as nombre FROM eepp ep JOIN constructoras c ON ep.id_constructoras = c.id where (ep.como_factura = 'EEPP' or ep.como_factura is null) and ep.cerrado = 0 order by c.nombre");
		
      	
		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarObrasFactura($idConstructora){

		   
            
            $stmt = Conexion::conectar()->prepare("SELECT DISTINCT o.id as id, o.nombre as nombre FROM eepp ep JOIN obras o ON ep.id_obras = o.id where ep.id_constructoras = $idConstructora and (ep.como_factura = 'EEPP' or ep.como_factura is null) and ep.cerrado = 0 order by o.nombre");

			/*
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT o.id as id, o.nombre as nombre FROM eepp ep JOIN obras o ON ep.id_obras = o.id where ep.id_constructoras = $idConstructora and ep.como_factura = 'EEPP' and cerrado = 0 order by o.nombre");
			*/
			
          
			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarEEPPFacturacionPrevia($idObra){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, ep.fecha_eepp, ep.fecha_corte, SUM(epd.total) as total_equipos FROM eepp_detalle_equipos epd JOIN eepp ep ON epd.id_eepp = ep.id where ep.id_obras = $idObra and ep.id not in (select distinct id_eepp from oc_arriendos) and ep.cerrado = 0  GROUP BY epd.id_eepp");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlMostrarEEPPFacturacionPreviaVolverFacturar($idObra, $idFactura){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, ep.fecha_eepp, ep.fecha_corte, SUM(epd.total) as total_equipos FROM eepp_detalle_equipos epd JOIN eepp ep ON epd.id_eepp = ep.id where ep.id_obras = $idObra and ep.id not in (select distinct id_eepp from oc_arriendos) and ep.id not in (select id_eepp from factura_eepp where id_factura = $idFactura) and ep.cerrado = 0  GROUP BY epd.id_eepp");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlExisteMasEEPP($idObra){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT ep.id FROM eepp ep where ep.id_obras = $idObra and (ep.como_factura = 'EEPP' or ep.como_factura is null) and ep.cerrado = 0 and ep.id not in (select id_eepp from factura_eepp)");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEEPPFacturacionSeleccion($idFactura){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, ep.fecha_eepp, ep.fecha_corte, SUM(epd.total) as total_equipos, ep.id_obras FROM eepp_detalle_equipos epd JOIN eepp ep ON epd.id_eepp = ep.id JOIN factura_eepp fep ON fep.id_eepp = ep.id where fep.id_factura = $idFactura GROUP BY epd.id_eepp");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEEPPFacturacionSeleccionFacturaDirecta($idFactura){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, ep.fecha_eepp, ep.fecha_corte, SUM(oca.total) as total_equipos, ep.id_obras FROM eepp_detalle_equipos epd JOIN eepp ep ON epd.id_eepp = ep.id JOIN factura_eepp fep ON fep.id_eepp = ep.id JOIN oc_arriendos_detalle oca ON epd.id = oca.id_eepp_detalle where fep.id_factura = $idFactura GROUP BY epd.id_eepp");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlMostrarEEPPFacturacionPreviaEquipos($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM eepp_detalle_equipos where id_eepp = $idEEPP");		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEEPPFacturacionPreviaMateriales($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM eepp_detalle_materiales where id_eepp = $idEEPP");		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEEPPFacturacionPreviaExtras($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT SUM(monto) as total FROM eepp_descuentos_extras where id_eepp = $idEEPP and tipo = 'E'");		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEEPPFacturacionPreviaDscto($idEEPP){
		
		
			$stmt = Conexion::conectar()->prepare("SELECT SUM(monto) * -1 as total FROM eepp_descuentos_extras where id_eepp = $idEEPP and tipo = 'D'");		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	
    
    static public function mdlMostrarEEPPFacturacionObtieneId($idObra){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, ep.fecha_corte FROM eepp_detalle_equipos epd JOIN eepp ep ON epd.id_eepp = ep.id where ep.id_obras = $idObra GROUP BY epd.id_eepp, ep.fecha_corte ORDER BY ep.fecha_corte;");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	 static public function mdlMostrarEEPPAsociadoFactura($idFactura){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, ep.fecha_corte FROM eepp_detalle_equipos epd JOIN eepp ep ON epd.id_eepp = ep.id JOIN factura_eepp fep ON fep.id_eepp = ep.id where fep.id_factura = $idFactura GROUP BY epd.id_eepp, ep.fecha_corte ORDER BY ep.fecha_corte;");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	 static public function mdlReferenciaFacturas($idFactura){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT rf.id, r.codigo_referencia, r.descripcion, rf.numero_referencia, date_format(rf.fecha_referencia, '%d-%m-%Y') as fecha_referencia FROM referencia_factura rf JOIN referencias r on rf.id_referencia = r.id where id_factura = $idFactura");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarEEPPFacturacionAgrupaEquipos($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id_eepp, epd.descripcion, epd.precio, SUM(epd.total) as total_equipos, SUM(epd.dias) as dias FROM eepp_detalle_equipos epd  where epd.id_eepp = $idEEPP GROUP BY epd.id_eepp, epd.descripcion, epd.precio order by epd.descripcion");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEEPPFacturacionMateriales($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, codigo, material, cantidad, precio, total, guia FROM `eepp_detalle_materiales` where id_eepp = $idEEPP");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlMostrarEEPPFacturacionDetalleEquipos($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT epd.id as idRegistro, epd.id_eepp, epd.codigo, CONCAT(epd.descripcion, ' ', epd.modelo, ' ', epd.marca) as descripcion, epd.guia, epd.precio, epd.total as total_equipos, epd.dias as dias, epd.fecha_arriendo, epd.fecha_devolucion, epd.report_devolucion, epd.cobro_desde, epd.cobro_hasta FROM eepp_detalle_equipos epd  where epd.id_eepp = $idEEPP order by epd.descripcion");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	/*=============================================
	REGISTRO NUEVA FACTURA
	=============================================*/
	static public function mdlIngresarFactura($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO factura(id_empresa, id_constructora, id_obra, fecha_factura, iva, tipo_factura, como) VALUES (:empresa, :id_constructora, :id_obra, :fecha, :iva,  :tipo, :como)");

		$stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", strtoupper($datos["fecha"]), PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);	
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);	
		$stmt->bindParam(":como", $datos["como"], PDO::PARAM_STR);
			
		
	
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from factura");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}



	/*=============================================
	MOSTRAR LISTA PARA TABLA
	=============================================*/

	static public function mdlMostrarListadoFacturacion($idObra){

		    $estado = 13;
		    			
			$stmt = Conexion::conectar()->prepare("SELECT f.id as idFactura, f.id_obra as idObra, eo.razon_social as empresa, f.numero_factura as numFactura, f.orden_compra, f.fecha_orden, f.fecha_factura as fecha, c.nombre as cliente, e.descripcion as estado, f.neto, f.estado_factura FROM factura f JOIN empresas_operativas eo ON f.id_empresa = eo.id JOIN constructoras c ON f.id_constructora = c.id JOIN estados e ON f.estado_factura = e.id where f.id_obra = $idObra and f.tipo_factura = 'A' and f.como = 'EEPP' ORDER BY fecha_factura desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}


	/*=============================================
	REGISTRO EEPP ASOCIADO A FACTURA
	=============================================*/
	static public function mdlIngresarFacturaEEPP($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO factura_eepp(id_eepp, id_factura) VALUES (:idEEPP, :idFactura)");

		$stmt->bindParam(":idEEPP", $datos["idEEPP"], PDO::PARAM_INT);
		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
				
	
		if($stmt->execute()){

                   $sqlEEPP = Conexion::conectar()->prepare("UPDATE eepp set como_factura = 'EEPP' where id = :idEEPP");

		            $sqlEEPP->bindParam(":idEEPP", $datos["idEEPP"], PDO::PARAM_INT);

		            $sqlEEPP->execute();

                   return "ok";                 

		}else{

		   return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


    /*=============================================
	MOSTRAR LISTA EEPP SELECCIONADOS
	=============================================*/

	static public function mdlMostrarListadoEEPPSeleccionado($idFactura){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT fep.id as idEEPPSeleccion, fep.id_eepp as idEEPP, fep.id_factura as idFactura, ep.fecha_corte as fechaEEPP FROM factura_eepp fep JOIN eepp ep ON fep.id_eepp = ep.id where fep.id_factura = $idFactura and fep.id_eepp not in (select id_eepp from oc_arriendos) ORDER BY ep.fecha_corte");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	
	static public function mdlEliminarEEPPSeleccionado($idRegistro, $idEEPP, $idFactura){

		
		
      	$stmt = Conexion::conectar()->prepare("DELETE FROM factura_eepp WHERE id = $idRegistro");

	
		$stmt -> execute();

			$stmt2 = Conexion::conectar()->prepare("DELETE FROM factura_sii WHERE id_eepp = $idEEPP and id_factura = $idFactura");

	
		$stmt2 -> execute();

            $sqlConsulta = Conexion::conectar()->prepare("SELECT DISTINCT id_eepp from factura_sii WHERE id_eepp = $idEEPP");

             $sqlConsulta -> execute(); 
             $respuesta = $sqlConsulta -> fetch();	

          
          if(!$respuesta){
			$stmt3 = Conexion::conectar()->prepare("UPDATE eepp set como_factura = null WHERE id = $idEEPP");

	
		    $stmt3 -> execute();
		}
			
		return "ok";	
		
		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlEliminarRegistrosFacturaSII($idFactura){

		
		
      	$stmt = Conexion::conectar()->prepare("DELETE FROM factura_sii WHERE id_factura = $idFactura");

	
		$stmt -> execute();
			
		return "ok";	
		
		

		$stmt -> close();

		$stmt = null;

	}

     
    

	static public function mdlInsertarRegistrosFacturaSII($datos){

		
		
      	$stmt = Conexion::conectar()->prepare("INSERT INTO factura_sii (id_factura, id_eepp, codigo, descripcion, glosa, cantidad, um, precio, valor) VALUES (:idFactura, :id_eepp, :codigo, :descripcion, :glosa, :cantidad, :um, :precio, :valor)");

      		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
      		$stmt->bindParam(":id_eepp", $datos["id_eepp"], PDO::PARAM_INT);
      		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
      		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
      		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
      		$stmt->bindParam(":um", $datos["um"], PDO::PARAM_STR);
      		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
      		$stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
      		$stmt->bindParam(":glosa", $datos["glosa"], PDO::PARAM_STR);

	
		if($stmt -> execute()){			
		   return "ok";	
		}else{
			return "error";
		}
		

		$stmt -> close();

		$stmt = null;
		

	}


    static public function mdlPrevisualizarFactura($idFactura){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT codigo, descripcion, glosa, cantidad, precio, valor  FROM factura_sii where id_factura = $idFactura ORDER BY id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function obtenerDatosFactura($idFactura){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT id_empresa, numero_factura, orden_compra, hes, fecha_orden, id_constructora, id_obra, fecha_factura, iva, neto, tipo_factura, estado_factura, rut, razon_social FROM factura where id = $idFactura");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}



	 static public function mdlMostrarDatosFacturaSII($idFactura){
			
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, id_factura, codigo, descripcion, glosa, cantidad, precio, valor, um  FROM factura_sii where id_factura = $idFactura ORDER BY id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	 static public function mdlMostrarRegistrosNC($idNC){
			
			$stmt = Conexion::conectar()->prepare("SELECT id, descripcion, valor FROM nota_credito_sii where id_nota_credito = $idNC ORDER BY id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}


	 static public function mdlMostrarRegistrosND($idND){
			
			$stmt = Conexion::conectar()->prepare("SELECT id, descripcion, valor FROM nota_debito_sii where id_nota_debito = $idND ORDER BY id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}


	static public function mdlActualizaEstadoFactura($idFactura, $valor){

		
		
      	$stmt = Conexion::conectar()->prepare("UPDATE factura SET estado_factura = $valor WHERE id = $idFactura");

	
		$stmt -> execute();
			
		return "ok";	
		
		

		$stmt -> close();

		$stmt = null;

	}

	 static public function mdlTraerRegistroFacturaSII($id){
			
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, id_factura, codigo, descripcion, glosa, cantidad, precio, valor, um  FROM factura_sii where id = $id");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}


	static public function mdlActualizaRegistroFacturaSII($datos){

		$precio = $datos["precioSII"];
		$cantidad = $datos["cantidadSII"];
		$valor = $precio * $cantidad;
		
      	$stmt = Conexion::conectar()->prepare("UPDATE factura_sii SET codigo = :codigoSII, descripcion = :descripcionSII, glosa = :glosaSII, cantidad = :cantidadSII, precio = :precioSII, valor = :valor WHERE id = :idRegistroSII");

	    
        $stmt->bindParam(":idRegistroSII", $datos["idRegistroSII"], PDO::PARAM_INT);
		$stmt->bindParam(":codigoSII", $datos["codigoSII"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcionSII", $datos["descripcionSII"], PDO::PARAM_STR);
		$stmt->bindParam(":glosaSII", $datos["glosaSII"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadSII", $datos["cantidadSII"], PDO::PARAM_INT);	
		$stmt->bindParam(":precioSII", $datos["precioSII"], PDO::PARAM_INT);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);	


		$stmt -> execute();
			
		return "ok";	
		
		

		$stmt -> close();

		$stmt = null;

	}


    static public function mdlObtenerTotalFactura($idFactura){

		   

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as totalFactura FROM factura_sii where id_factura = $idFactura GROUP by id_Factura");					
			

			$stmt -> execute();

			return $stmt -> fetch();

	}


	static public function mdlTotalEEPP($idEEPP){
		   

			$stmt = Conexion::conectar()->prepare("SELECT total_eepp FROM eepp where id = $idEEPP");	

			$stmt -> execute();

			return $stmt -> fetch();

	}

	static public function mdlMontoFacturadoEEPP($idEEPP){
		   

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as totalFactura FROM factura_sii where id_eepp = $idEEPP GROUP by id_eepp");	

			$stmt -> execute();

			return $stmt -> fetch();

	}

	static public function mdlMontoNotaCredito($idEEPP){
		   

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) * -1 as totalNC FROM nota_credito_sii where id_eepp = $idEEPP GROUP by id_eepp");	

			$stmt -> execute();

			return $stmt -> fetch();

	}

	static public function mdlMontoNotaDebito($idEEPP){
		   

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as totalND FROM nota_debito_sii where id_eepp = $idEEPP GROUP by id_eepp");	

			$stmt -> execute();

			return $stmt -> fetch();

	}

	static public function mdlReferencias(){
		   

			$stmt = Conexion::conectar()->prepare("SELECT id, codigo_referencia, descripcion FROM referencias ORDER by id");	

			$stmt -> execute();

			return $stmt -> fetchAll();

	}

	static public function mdlAgregaReferenciaFactura($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO referencia_factura(id_factura, id_oc_arriendo, id_referencia, numero_referencia, fecha_referencia) VALUES (:idFactura, :idOC, :idReferencia, :numero, :fechaRef)");

		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
		$stmt->bindParam(":idOC", $datos["idOC"], PDO::PARAM_INT);
		$stmt->bindParam(":idReferencia", $datos["idReferencia"], PDO::PARAM_INT);
		$stmt->bindParam(":numero", strtoupper($datos["numero"]), PDO::PARAM_STR);
		$stmt->bindParam(":fechaRef", $datos["fechaRef"], PDO::PARAM_STR);	
		
			
		
	
		if($stmt->execute()){

			return 'ok';                

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	static public function mdlFinalizaFactura($idFactura,$idEmpresa){
               
               $estado = 13;
		       
		       $sqlFactura = Conexion::conectar()->prepare("UPDATE factura fac JOIN dte d ON fac.id_empresa = d.id_empresa_operativa SET fac.numero_factura = d.numero_factura, fac.estado_factura = $estado WHERE fac.id = $idFactura and d.id_empresa_operativa = fac.id_empresa"); 
               $sqlFactura->execute();  


               $sqlNuevaFac = Conexion::conectar()->prepare("UPDATE dte SET numero_factura = numero_factura + 1 where id_empresa_operativa = $idEmpresa"); 
              	

				
		if($sqlNuevaFac -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlActualizaTotalNeto($idFactura,$total){
               
              		       
		       $sqlFactura = Conexion::conectar()->prepare("UPDATE factura set neto = $total where id = $idFactura"); 
               $sqlFactura->execute();                  

				
		

			return "ok";
		
		
		$stmt -> close();

		$stmt = null;

	}

	static public function mdlOCParaFacturar($idObra){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT oca.id as idOC, oca.id_eepp, oca.numero_oc, oca.fecha_oc, oca.id_factura, ep.fecha_corte FROM oc_arriendos oca JOIN eepp ep ON oca.id_eepp = ep.id where id_obra = $idObra and id_factura is null ORDER BY fecha_oc desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlValidarFacturaOC($idFactura){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT distinct id_factura FROM oc_arriendos where id_factura = $idFactura");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}


	static public function mdlEditarFactura($datos){
               
              		       
		       $stmt = Conexion::conectar()->prepare("UPDATE factura set fecha_factura = :fecha where id = :id"); 

		       $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		       $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);


               $stmt->execute();                  

				
		

			return "ok";
		
		
		$stmt -> close();

		$stmt = null;

	}


	static public function mdlExisteFacturaSinTerminar($idObra){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT * from factura where id_obra = $idObra and tipo_factura = 'A' and numero_factura = 0");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	



			

}

