<?php

//Inicio del procesamiento
session_start();

//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["esAdmin"]);
unset($_SESSION["nombre"]);


session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portada</title>
</head>

<body>

<div id="contenedor">

<?php
	require("include/common/cabecera.php");
	require("include/common/sidebarIzq.php");
?>

	<div id="contenido">
		<h1>Hasta pronto!</h1>
	</div>

<?php
	require("include/common/sidebarDer.php");
	require("include/common/pie.php");
?>


</div>

</body>
</html>