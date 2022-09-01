recargaTabla();


function genera_tabla_compras() {

	id = $('#idFacturaCompra').val();


	datos = "id=" + id;


	$.ajax({


		url: "ajax/tabla-equipos-comprados.ajax.php",
		method: "POST",
		data: datos,

		success: function(html) {

			$('#mostrar_tabla_detalles').html(html);
			totalFactura();

		}
	});

	
}



$(".tablaEquiposFactura tbody").on("click", "button.agregarEquipoArriendo", function() {

	$('#compraDetallePrecio').val('');
	$('#compraDetalleCodigo').val('');
	$('#compraDetalleSerie').val('');


	var idTipoEquipo = $(this).attr("idTipoEquipo");

	var datos = new FormData();
	datos.append("idTipoEquipo", idTipoEquipo);

	$.ajax({

		url: "ajax/tipoEquipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {


			var idMarca = respuesta["id_marca"];

			var datos = new FormData();
			datos.append("idMarca", idMarca);
			$.ajax({
				url: "ajax/marcas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(marca) {

					$("#compraDetalleMarca").val(marca["descripcion"]);
					$("#compraDetalleDescripcion").val(respuesta["descripcion"]);
					$("#compraDetalleModelo").val(respuesta["modelo"]);
					$("#idEquipoDetalle").val(respuesta["id"]);
					$('#compraDetalleSerie').focus();

				}

			})


		}



	});



});


$('#btnAgregarDetalle').click(function() {

	if ($('#compraDetalleDescripcion').val() == '') {
		alertify.error("Seleccione un equipo de la lista");
		return false;
	}

	if ($('#compraDetalleSerie').val() == '') {
		alertify.error("Debe ingresar Número de Serie");
		$('#compraDetalleSerie').focus();
		return false;
	}

	if ($('#compraDetalleCodigo').val() == '') {
		alertify.error("Debe asignar un código al equipo");
		$('#compraDetalleCodigo').focus();
		return false;
	}

	if ($('#compraDetallePrecio').val() == '') {
		alertify.error("Debe ingresar precio de compra");
		$('#compraDetallePrecio').focus();
		return false;
	}

	if ($('#sucursalCompra').val() == "") {
		alertify.error("Debe seleccionar sucursal");
		$('#sucursalCompra').focus();
		return false;
	}

	

if ($('#compraDetalleCodigo').val() != '') {
	
	
	id_nombre_equipos = $('#idEquipoDetalle').val();
	id_factura = $('#idFacturaCompra').val();
	codigo = $('#compraDetalleCodigo').val();
	numero_serie = $('#compraDetalleSerie').val();
	precio_compra = $('#compraDetallePrecio').val();
	sucursal = $('#sucursalCompra').val();

	datos = "id_nombre_equipos=" + id_nombre_equipos +
		"&id_factura=" + id_factura +
		"&codigo=" + codigo +
		"&numero_serie=" + numero_serie +
		"&precio_compra=" + precio_compra +
		"&id_sucursal=" + sucursal;


	$.ajax({

		type: "POST",
		url: "ajax/guarda-equipo-detalle-factura.ajax.php",
		data: datos,

		success: function(res) {

			genera_tabla_compras();
			alertify.success("Equipo creado con exito");

			$('#compraDetalleSerie').val('');
			$('#compraDetalleCodigo').val('');
			$('#compraDetalleSerie').focus();
			


		}
	});
}
});



$('#compraDetalleSerie').blur(function() {
	//codigo = $('#compraDetalleSerie').val();
	//$('#compraDetalleCodigo').val();
	$('#compraDetalleCodigo').focus();
});


$('#seleccionaMarcaEquipo').change(function() {

	$('#compraDetalleMarca').val('');
	$('#compraDetalleDescripcion').val('');
	$('#compraDetalleModelo').val('');



	var idMarca = $('#seleccionaMarcaEquipo').val();
	$('.tablaEquiposFactura').DataTable().destroy();

	recargaTabla(idMarca);
	$('.tablaEquiposFactura').DataTable().ajax.reload();


});


function recargaTabla(id) {

	var idMarca = id;

	$('.tablaEquiposFactura').DataTable({
		"ajax": {
			"url": "ajax/datatable-detalle-compra.ajax.php",
			"method": 'POST',
			"datatype": 'json',
			"destroy": "true",
			"data": {
				idMarca: idMarca
			}
		},
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}

	});

}

/*=============================================
REVISAR SI EL CODIGO YA ESTÁ REGISTRADO
=============================================*/


$('#compraDetalleCodigo').blur(function() {

	if ($('#compraDetalleCodigo').val() != '') {
		$(".alert").remove();

		var validarCodigo = $(this).val();

		var datos = new FormData();
		datos.append("validarCodigo", validarCodigo);

		$.ajax({
			url: "ajax/equipos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta) {
				if (respuesta) {

					//$("#compraDetalleCodigo").parent().after('<div class="alert alert-warning">El código ya existe</div>');

					$("#compraDetalleCodigo").val("");	
					$("#compraDetalleCodigo").focus();				
					alertify.error("Código de equipo ya existe");

				}

			}

		});
	}
});



function editar(id) {

	var idEquipo = id;

	var datos = new FormData();
	datos.append("idEquipo", idEquipo);

	$.ajax({

		url: "ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(equipo) {
			var idTipoEquipo = equipo["id_nombre_equipos"];
			var precio = equipo["precio_compra"];
			var serie = equipo["numero_serie"];
			var codigo = equipo["codigo"];
			var id = equipo["id"];
			var sucursal = equipo["id_sucursal"];



			var datos = new FormData();
			datos.append("idTipoEquipo", idTipoEquipo);

			$.ajax({

				url: "ajax/tipoEquipos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(tipo) {
					var idMarca = tipo["id_marca"];
					var tipoEquipo = tipo["descripcion"];
					var modelo = tipo["modelo"];



					var datos = new FormData();
					datos.append("idMarca", idMarca);
					$.ajax({
						url: "ajax/marcas.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(marca) {

							marca = marca["descripcion"];



							$("#compraDetalleMarcaEdita").val(marca);
							$("#compraDescripcionEdita").val(tipoEquipo);
							$("#compraModeloEdita").val(modelo);
							$("#idEquipoDetalleEdita").val(id);
							$('#editaDetallePrecio').val(precio);
							$('#editaDetalleSerie').val(serie);
							$('#editaDetalleCodigo').val(codigo);
							$('#editaSucursalCompra').val(sucursal);
							$('#editaDetallePrecio').focus();

						}
					})

				}
			});

		}

	});



	$("#modalEditarEquipo").modal("show");
}


$('#btnGuardarEdita').click(function() {

	if ($('#editaDetallePrecio').val() == '') {
		alertify.error("Debe ingresar precio de compra");
		$('#editaDetallePrecio').focus();
		return;
	}

	if ($('#editaDetalleSerie').val() == '') {
		alertify.error("Debe ingresar Número de Serie");
		$('#editaDetalleSerie').focus();
		return;
	}

	if ($('#editaDetalleCodigo').val() == '') {
		alertify.error("Debe asignar un código al equipo");
		$('#editaDetalleCodigo').focus();
		return;
	}


	idEquipo = $('#idEquipoDetalleEdita').val();
	codigo = $('#editaDetalleCodigo').val();
	numero_serie = $('#editaDetalleSerie').val();
	precio_compra = $('#editaDetallePrecio').val();
	sucursal = $('#editaSucursalCompra').val();

	datos = "idEquipo=" + idEquipo +
		"&codigo=" + codigo +
		"&numero_serie=" + numero_serie +
		"&precio_compra=" + precio_compra +
		"&id_sucursal=" + sucursal;


	$.ajax({

		type: "POST",
		url: "ajax/edita-equipo-detalle-factura.ajax.php",
		data: datos,

		success: function(res) {

			alertify.success("Equipo actualizado");
			genera_tabla_compras();


		}
	});
});

$('#btnFinalizarFactura').click(function() {
	window.location = "index.php?ruta=facturas-compra-equipos";

});

function eliminarConsulta(id) {
	id = id;
	alertify.confirm('ELIMINAR EQUIPO', 'Esta seguro de eliminar el equipo?', function() {
		elimina_equipo(id)
	}, function() {});
}

function elimina_equipo(id) {
	var idEquipo = id;

	var datos = new FormData();
	datos.append("eliminarEquipo", idEquipo);


	$.ajax({
		url: "ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {

			alertify.success("Equipo Eliminado");
			genera_tabla_compras();



		}
	});
}

function totalFactura(){
   id = $('#idFacturaCompra').val();

   var datos = new FormData();
	datos.append("idFacturaCompra", id);


	$.ajax({
		url: "ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(r) {
           
           if(r["total"] == null){
           	total = "$ 0";
           }else{         
            total = formatNumber.new(r["total"], "$ ");
           }
			$("#totalCompra").val(total);





		}
	});

}

 var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}