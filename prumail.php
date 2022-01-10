<?php
//mespino@laspalmasgc.es
$para="amlf65@gmail.com";
$titulo="Web Martínez Serra";
$cabeceras = "From: webmaster@example.com";
$mensaje="Prueba de correo";

mail($para, $titulo, $mensaje, $cabeceras);

exit("fin programa");

?>