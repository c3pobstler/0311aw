<?php 
session_start();
require(__DIR__.'/Application.php');
/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');
$app=Application::getInstance();
$app->init(array('host'=>'127.0.0.1','user'=>'user','pass'=>'', 'bd'=>'ejercicio3'));
$app->connectBD();
