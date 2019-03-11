<?php
	require('include/procesarRegistro.php');
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Registro</title>
</head>

<body>

<div id="contenedor">

<?php
	require("include/common/cabecera.php");
	require("include/common/sidebarIzq.php");
?>

	<div id="contenido">
		<h1>Registro de usuario</h1>
		
		<form action="procesarRegistro.php" method="POST">	
<?php
if (count($erroresFormulario) > 0) {
	echo '<ul class="errores">';
}
foreach($erroresFormulario as $error) {
	echo "<li>$error</li>";
}
if (count($erroresFormulario) > 0) {
	echo '</ul>';
}
?>		
		</ul>
		<fieldset>
			<div class="grupo-control">
				<label>Nombre de usuario:</label> <input class="control" type="text" name="nombreUsuario" value="<?=$nombreUsuario ?>" />
			</div>
			<div class="grupo-control">
				<label>Nombre completo:</label> <input class="control" type="text" name="nombre" value="<?=$nombre ?>" />
			</div>
			<div class="grupo-control">
				<label>Password:</label> <input class="control" type="password" name="password" />
			</div>
			<div class="grupo-control"><label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" /><br /></div>
			<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
		</fieldset>

	</div>

<?php
	require("include/common/sidebarDer.php");
	require("include/common/pie.php");
?>


</div>

</body>
</html>