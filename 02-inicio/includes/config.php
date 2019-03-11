<?php
ini_set('default_charset', 'UTF-8'); 
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');
session_start();
echo '<link rel="stylesheet" href="../estilo.css" type="text/css">';
include("includes/comun/cabecera.php");
include("includes/comun/sidebarDer.php");
include("includes/comun/sidebarIzq.php");
?>