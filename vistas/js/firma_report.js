   //======================================================================
    // VARIABLES
    //======================================================================

   
    const $canvas = document.querySelector("#pizarra");
    let miCanvas = document.querySelector('#pizarra');
    let lineas = [];
    let correccionX = 0;
    let correccionY = 0;
    let pintarLinea = false;
    // Marca el nuevo punto
    let nuevaPosicionX = 0;
    let nuevaPosicionY = 0;

    let posicion = miCanvas.getBoundingClientRect()
    correccionX = posicion.x;
    correccionY = posicion.y;

    miCanvas.width = 300;
    miCanvas.height = 300;

    //======================================================================
    // FUNCIONES
    //======================================================================

    /**
     * Funcion que empieza a dibujar la linea
     */
    function empezarDibujo () {
        pintarLinea = true;
        lineas.push([]);
    };
    
    /**
     * Funcion que guarda la posicion de la nueva línea
     */
    function guardarLinea() {
        lineas[lineas.length - 1].push({
            x: nuevaPosicionX,
            y: nuevaPosicionY
        });
    }

    /**
     * Funcion dibuja la linea
     */
    function dibujarLinea (event) {
        event.preventDefault();
        if (pintarLinea) {
            let ctx = miCanvas.getContext('2d')
            // Estilos de linea
            ctx.lineJoin = ctx.lineCap = 'round';
            ctx.lineWidth = 3;
            // Color de la linea
            ctx.strokeStyle = '#0000FF';
            // Marca el nuevo punto
            if (event.changedTouches == undefined) {
                // Versión ratón
                nuevaPosicionX = event.layerX;
                nuevaPosicionY = event.layerY;
            } else {
                // Versión touch, pantalla tactil
                nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
                nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
            }
            // Guarda la linea
            guardarLinea();
            // Redibuja todas las lineas guardadas
            ctx.beginPath();
            lineas.forEach(function (segmento) {
                ctx.moveTo(segmento[0].x, segmento[0].y);
                segmento.forEach(function (punto, index) {
                    ctx.lineTo(punto.x, punto.y);
                });
            });
            ctx.stroke();
        }
    }

    /**
     * Funcion que deja de dibujar la linea
     */
    function pararDibujar () {
        pintarLinea = false;
        guardarLinea();
    }

    //======================================================================
    // EVENTOS
    //======================================================================

    // Eventos raton
    miCanvas.addEventListener('mousedown', empezarDibujo, false);
    miCanvas.addEventListener('mousemove', dibujarLinea, false);
    miCanvas.addEventListener('mouseup', pararDibujar, false);

    // Eventos pantallas táctiles
    miCanvas.addEventListener('touchstart', empezarDibujo, false);
    miCanvas.addEventListener('touchmove', dibujarLinea, false);



 btnGuardaFirma.onclick = async () => {   
  // Convertir la imagen a Base64 y ponerlo en el enlace
  const data = $canvas.toDataURL("image/png");
  const fd = new FormData();
  fd.append("imagen", data); // Se llama "imagen", en PHP lo recuperamos con $_POST["imagen"]
  const respuestaHttp = await fetch("ajax/guardaFirma.php", {
    method: "POST",
    body: fd,
  });
  const nombreImagenSubida = await respuestaHttp.json();
  alertify.success("Se ha firmado el documento");
  
   

  window.location = "index.php?ruta=firma-report";

};


$('#btnVolverFirma').click(function() {    

        
           window.location = "index.php?ruta=devolucion-equipos-arriendos-detalle";  

});

$('#btnLimpiarFirma').click(function() {    

        
         window.location = "index.php?ruta=firma-report";

});

$('#btnVerDocumento').click(function() {    

        
     var id = $('#idReport').val();

    window.open("extensiones/pdf/TCPDF/report-retiro.php?id="+id, "_blank");

});