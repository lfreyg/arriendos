<?php
session_start();
$idReport = $_SESSION["idReportDevolucion"];
$imagenCodificada = $_POST["imagen"];
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", $imagenCodificada);
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);
$nombreImagenGuardada = "../vistas/img/firmaReport/firma_" . $idReport . ".png";
file_put_contents($nombreImagenGuardada, $imagenDecodificada);
echo json_encode($nombreImagenGuardada);

?>