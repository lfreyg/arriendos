<?php

require_once "conexion.php";

class ModeloFacturacionNCND{

	

	static public function mdlMostrarFacturasNCND($idEmpesa){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT f.id as idFactura, eo.razon_social as empresa, f.numero_factura as numFactura, f.fecha_factura as fecha, c.rut as rutCliente, c.nombre as cliente, o.nombre as obra, e.descripcion as estado, f.neto, f.estado_factura FROM factura f JOIN empresas_operativas eo ON f.id_empresa = eo.id JOIN constructoras c ON f.id_constructora = c.id JOIN estados e ON f.estado_factura = e.id LEFT JOIN obras o ON f.id_obra = o.id where f.id_empresa = $idEmpesa and f.numero_factura != 0 and f.tipo_factura = 'A' ORDER BY f.numero_factura desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlListadoNC($idFactura){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT nc.id as idNC, eo.razon_social as empresa, nc.numero_nc, nc.fecha_nota, tnc.descripcion as tipoNC, nc.neto, c.nombre as constructora, o.nombre as obra, e.descripcion as estadoNC, nc.estado_nota FROM nota_credito nc JOIN constructoras c ON nc.id_constructora = c.id JOIN obras o ON nc.id_obra = o.id JOIN estados e ON nc.estado_nota = e.id JOIN empresas_operativas eo ON nc.id_empresa = eo.id JOIN tipo_nc tnc ON nc.tipo_nota = tnc.id where nc.id_factura = $idFactura and nc.proceso = 'F' order by nc.numero_nc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarNC($idNC){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT nc.id as idNC, eo.razon_social as empresa, nc.numero_nc, nc.fecha_nota, tnc.descripcion as tipoNC, nc.neto, c.nombre as constructora, c.rut as rutConstructora, c.direccion, c.telefono, c.contacto_cobranza, c.email_cobranza, c.codigo_actividad, c.comuna, c.ciudad,o.nombre as obra, e.descripcion as estadoNC, nc.tipo_nota, ca.codigo, ca.actividad, f.numero_factura, f.neto as neto_factura, nc.id_factura as idFactura, nc.estado_nota as idEstadoNota, nc.id_empresa as idEmpresaOperativa FROM nota_credito nc JOIN constructoras c ON nc.id_constructora = c.id JOIN obras o ON nc.id_obra = o.id JOIN estados e ON nc.estado_nota = e.id JOIN empresas_operativas eo ON nc.id_empresa = eo.id JOIN tipo_nc tnc ON nc.tipo_nota = tnc.id join codigo_actividad ca on c.codigo_actividad = ca.codigo join factura f on nc.id_factura = f.id where nc.id = $idNC");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlListarTipoNotaCredito(){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT id, descripcion from tipo_nc order by id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlListarTipoNotaDebito(){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT id, descripcion from tipo_nd order by id");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlIngresarNC($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO nota_credito(id_factura, id_constructora, id_obra, fecha_nota, iva, id_empresa, tipo_nota) VALUES (:id_factura, :id_constructora, :id_obra, :fecha_nota, :iva,  :id_empresa, :tipo_nota)");

		$stmt->bindParam(":id_factura", $datos["id_factura"], PDO::PARAM_INT);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_nota", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa", $datos["empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_nota", $datos["tipo_nota"], PDO::PARAM_INT);	
		
			
		
	
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from nota_credito");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlGuardaRegistroNCSII($datos){

     $sqlFacSII = Conexion::conectar()->prepare("SELECT descripcion from factura_sii where id = :idRegistroFacSII");

     $sqlFacSII->bindParam(":idRegistroFacSII", $datos["idRegistroFacSII"], PDO::PARAM_INT);

     $sqlFacSII->execute();

     $desc = $sqlFacSII->fetch();

     $descripcion = $desc['descripcion'];
      



     $stmt = Conexion::conectar()->prepare("INSERT INTO nota_credito_sii(id_factura, id_nota_credito, id_eepp, descripcion, precio, valor) VALUES (:idFactura, :idNC, :id_eepp, :descripcion, :neto, :neto)");

		
		$stmt->bindParam(":id_eepp", $datos["id_eepp"], PDO::PARAM_INT);
		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
		$stmt->bindParam(":idNC", $datos["idNC"], PDO::PARAM_INT);
		$stmt->bindParam(":neto", $datos["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
		

		if($stmt->execute()){

			   	return 'ok'; 
		}

		


	}



	static public function mdlGuardaRegistroNDSII($datos){

     $sqlFacSII = Conexion::conectar()->prepare("SELECT descripcion from factura_sii where id = :idRegistroFacSII");

     $sqlFacSII->bindParam(":idRegistroFacSII", $datos["idRegistroFacSII"], PDO::PARAM_INT);

     $sqlFacSII->execute();

     $desc = $sqlFacSII->fetch();

     $descripcion = $desc['descripcion'];
      



     $stmt = Conexion::conectar()->prepare("INSERT INTO nota_debito_sii(id_factura, id_nota_debito, id_eepp, descripcion, precio, valor) VALUES (:idFactura, :idND, :id_eepp, :descripcion, :neto, :neto)");

		
		$stmt->bindParam(":id_eepp", $datos["id_eepp"], PDO::PARAM_INT);
		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
		$stmt->bindParam(":idND", $datos["idND"], PDO::PARAM_INT);
		$stmt->bindParam(":neto", $datos["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
		

		if($stmt->execute()){

			   	return 'ok'; 
		}

		


	}




	static public function mdlRegistrarDetalleNCSii($datos){

	 $tipoNC =  $datos["idTipoNC"];

	 if($tipoNC != 2){	

		$stmt = Conexion::conectar()->prepare("INSERT INTO nota_credito_sii(id_factura, id_nota_credito, descripcion, precio, valor) VALUES (:idFactura, :idNC, :descripcion, :neto, :neto)");

		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
		$stmt->bindParam(":idNC", $datos["idNC"], PDO::PARAM_INT);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->execute();
			
   }    
        
      

         $sqlNCActual = Conexion::conectar()->prepare("UPDATE nota_credito SET neto = :neto, rut_cliente = :rut, razon_cliente = :razon, telefono_cliente = :tele, contacto_cliente = :contacto, direccion_cliente = :direccion, comuna_cliente = :comuna, ciudad_cliente = :ciudad, actividad_cliente = :codigo WHERE id = :idNC");

           $sqlNCActual->bindParam(":neto", $datos["neto"], PDO::PARAM_INT);
           $sqlNCActual->bindParam(":idNC", $datos["idNC"], PDO::PARAM_INT);
           $sqlNCActual->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":razon", $datos["razon"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":tele", $datos["tele"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
           $sqlNCActual->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		   $sqlNCActual -> execute();


       

        if($tipoNC == 1){
		           $estado = 14;
		           $idFactura = $datos["idFactura"];
		           $neto = $datos["neto"];
		           $idNC = $datos["idNC"];

		           
		           $sqlFac = Conexion::conectar()->prepare("UPDATE factura SET estado_factura = $estado WHERE id = $idFactura");

				    $sqlFac -> execute();

				    $sqlFacEEPP = Conexion::conectar()->prepare("DELETE FROM factura_eepp WHERE id_factura = $idFactura");	
				    $sqlFacEEPP -> execute();

				
				    $sqlOCFac = Conexion::conectar()->prepare("UPDATE oc_arriendos oc set oc.id_factura = null WHERE oc.id_factura = $idFactura");	
				    $sqlOCFac -> execute();

				    $sqlFacSII = Conexion::conectar()->prepare("UPDATE factura_sii set id_eepp = 0 WHERE id_factura = $idFactura");	
		             $sqlFacSII -> execute();
			
        }
   
    return "ok";

	}



	static public function mdlRegistrarDetalleNDSii($datos){
   
   /*
		$stmt = Conexion::conectar()->prepare("INSERT INTO nota_debito_sii(id_factura, id_nota_debito, descripcion, precio, valor) VALUES (:idFactura, :idND, :descripcion, :neto, :neto)");

		$stmt->bindParam(":idFactura", $datos["idFactura"], PDO::PARAM_INT);
		$stmt->bindParam(":idND", $datos["idND"], PDO::PARAM_INT);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->execute()	
    */   
        
       

         $sqlNDActual = Conexion::conectar()->prepare("UPDATE nota_debito SET neto = :neto, rut_cliente = :rut, razon_cliente = :razon, telefono_cliente = :tele, contacto_cliente = :contacto, direccion_cliente = :direccion, comuna_cliente = :comuna, ciudad_cliente = :ciudad, actividad_cliente = :codigo WHERE id = :idND");

           $sqlNDActual->bindParam(":neto", $datos["neto"], PDO::PARAM_INT);
           $sqlNDActual->bindParam(":idND", $datos["idND"], PDO::PARAM_INT);
           $sqlNDActual->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":razon", $datos["razon"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":tele", $datos["tele"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
           $sqlNDActual->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		   $sqlNDActual -> execute();
        
       return 'ok';


	}





	static public function mdlEliminarNC($idnc){
               
              		       
		       $sqlNC = Conexion::conectar()->prepare("DELETE FROM nota_credito WHERE id = $idnc"); 
              

				
		if($sqlNC -> execute()){

			     $sqlNCReg = Conexion::conectar()->prepare("DELETE FROM nota_credito_sii WHERE id_nota_credito = $idnc"); 

			     $sqlNCReg -> execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlQuitarRegistroNC($id){
               
              		       
		      

			     $sqlNCReg = Conexion::conectar()->prepare("DELETE FROM nota_credito_sii WHERE id = $id"); 

			     $sqlNCReg -> execute();

			return "ok";
		
		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlQuitarRegistroND($id){
               
              		       
		      

			     $sqlNDReg = Conexion::conectar()->prepare("DELETE FROM nota_debito_sii WHERE id = $id"); 

			     $sqlNDReg -> execute();

			return "ok";
		
		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlIngresarND($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO nota_debito(id_factura, id_constructora, id_obra, fecha_nota, iva, id_empresa, tipo_nota) VALUES (:id_factura, :id_constructora, :id_obra, :fecha_nota, :iva,  :id_empresa, :tipo_nota)");

		$stmt->bindParam(":id_factura", $datos["id_factura"], PDO::PARAM_INT);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_nota", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa", $datos["empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_nota", $datos["tipo_nota"], PDO::PARAM_INT);	
		
			
		
	
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from nota_debito");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

  
  static public function mdlListadoND($idFactura){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT nd.id as idND, eo.razon_social as empresa, nd.numero_nd, nd.fecha_nota, tnc.descripcion as tipoND, nd.neto, c.nombre as constructora, o.nombre as obra, e.descripcion as estadoND, nd.estado_nota FROM nota_debito nd JOIN constructoras c ON nd.id_constructora = c.id JOIN obras o ON nd.id_obra = o.id JOIN estados e ON nd.estado_nota = e.id JOIN empresas_operativas eo ON nd.id_empresa = eo.id JOIN tipo_nd tnc ON nd.tipo_nota = tnc.id where nd.id_factura = $idFactura order by nd.numero_nd");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}


	static public function mdlMostrarND($idND){

		   		    			
			$stmt = Conexion::conectar()->prepare("SELECT nd.id as idND, eo.razon_social as empresa, nd.numero_nd, nd.fecha_nota, tnc.descripcion as tipoND, nd.neto, c.nombre as constructora, c.rut as rutConstructora, c.direccion, c.telefono, c.contacto_cobranza, c.email_cobranza, c.codigo_actividad, c.comuna, c.ciudad,o.nombre as obra, e.descripcion as estadoND, nd.tipo_nota, ca.codigo, ca.actividad, f.numero_factura, f.neto as neto_factura, nd.id_factura as idFactura, nd.estado_nota as idEstadoNota, nd.id_empresa as idEmpresaOperativa FROM nota_debito nd JOIN constructoras c ON nd.id_constructora = c.id JOIN obras o ON nd.id_obra = o.id JOIN estados e ON nd.estado_nota = e.id JOIN empresas_operativas eo ON nd.id_empresa = eo.id JOIN tipo_nd tnc ON nd.tipo_nota = tnc.id join codigo_actividad ca on c.codigo_actividad = ca.codigo join factura f on nd.id_factura = f.id where nd.id = $idND");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}


	static public function mdlEliminarND($idND){
               
              		       
		       $sqlND = Conexion::conectar()->prepare("DELETE FROM nota_debito WHERE id = $idND"); 
              

				
		if($sqlND -> execute()){

			$sqlNDReg = Conexion::conectar()->prepare("DELETE FROM nota_debito_sii WHERE id_nota_debito = $idND"); 

			$sqlNDReg -> execute();

			return 'ok';
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlTimbreNC($idNC,$idEmpresa){
               
               $estado = 13;
		       
		       $sqlNC = Conexion::conectar()->prepare("UPDATE nota_credito nc JOIN dte d ON nc.id_empresa = d.id_empresa_operativa SET nc.numero_nc = d.numero_nc, nc.estado_nota = $estado WHERE nc.id = $idNC and d.id_empresa_operativa = nc.id_empresa"); 
               $sqlNC->execute();  


               $sqlNuevaFac = Conexion::conectar()->prepare("UPDATE dte SET numero_nc = numero_nc + 1 where id_empresa_operativa = $idEmpresa"); 
              	

				
		if($sqlNuevaFac -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlTimbreND($idND,$idEmpresa){
               
               $estado = 13;
		       
		       $sqlND = Conexion::conectar()->prepare("UPDATE nota_debito nd JOIN dte d ON nd.id_empresa = d.id_empresa_operativa SET nd.numero_nd = d.numero_nd, nd.estado_nota = $estado WHERE nd.id = $idND and d.id_empresa_operativa = nd.id_empresa"); 
               $sqlND->execute();  


               $sqlNuevaFac = Conexion::conectar()->prepare("UPDATE dte SET numero_nd = numero_nd + 1 where id_empresa_operativa = $idEmpresa"); 
              	

				
		if($sqlNuevaFac -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlTotalNC($id){
               
              		       
		      

			     $sqlNCReg = Conexion::conectar()->prepare("SELECT SUM(valor) as neto FROM nota_credito_sii WHERE id_nota_credito = $id"); 

			     $sqlNCReg -> execute();

			     return $sqlNCReg -> fetch();
		
		

		$sqlNCReg -> close();

		$sqlNCReg = null;

	}



	static public function mdlTotalND($id){
               
              		       
		      

			     $sqlNDReg = Conexion::conectar()->prepare("SELECT SUM(valor) as neto FROM nota_debito_sii WHERE id_nota_debito = $id"); 

			     $sqlNDReg -> execute();

			     return $sqlNDReg -> fetch();
		
		

		$sqlNDReg -> close();

		$sqlNDReg = null;

	}

	static public function mdlContarNC($idFactura){
               
              		       
		      

			     $sqlNC = Conexion::conectar()->prepare("SELECT count(id) as sonNC FROM nota_credito WHERE id_factura = $idFactura and estado_nota = 13"); 

			     $sqlNC -> execute();

			     return $sqlNC -> fetch();
		
		

		$sqlNC -> close();

		$sqlNC = null;

	}

	static public function mdlContarND($idFactura){
               
              		       
		      

			     $sqlND = Conexion::conectar()->prepare("SELECT count(id) as sonND FROM nota_debito WHERE id_factura = $idFactura and estado_nota = 13"); 

			     $sqlND -> execute();

			     return $sqlND -> fetch();
		
		

		$sqlND -> close();

		$sqlND = null;

	}

	static public function mdlNCFinalizada($idFactura){
               
              		       
		      

			     $sqlND = Conexion::conectar()->prepare("SELECT id FROM nota_credito WHERE id_factura = $idFactura and numero_nc = 0"); 

			     $sqlND -> execute();

			     return $sqlND -> fetch();
		
		

		$sqlND -> close();

		$sqlND = null;

	}


	static public function mdlNDFinalizada($idFactura){
               
              		       
		      

			     $sqlND = Conexion::conectar()->prepare("SELECT id FROM nota_debito WHERE id_factura = $idFactura and numero_nd = 0"); 

			     $sqlND -> execute();

			     return $sqlND -> fetch();
		
		

		$sqlND -> close();

		$sqlND = null;

	}


	static public function mdlTotalNCPorFactura($idFactura){
               
              		       
		      

			     $sqlND = Conexion::conectar()->prepare("SELECT SUM(neto) as neto FROM nota_credito WHERE id_factura = $idFactura and estado_nota = 13"); 

			     $sqlND -> execute();

			     return $sqlND -> fetch();
		
		

		$sqlND -> close();

		$sqlND = null;

	}



}

