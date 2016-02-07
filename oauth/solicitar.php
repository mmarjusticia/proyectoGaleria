<?php

session_start();

require_once '../clases/Google/autoload.php';

$cliente = new Google_Client();

$cliente->setApplicationName('proyectoEnviarCorreoDesdeGmail');

$cliente->setClientId("270220163093-pe1ci6joub5ai7k0dgtlloukg764pclj.apps.googleusercontent.com"); 

$cliente->setClientSecret('U-cIahmOQjJkR4Iyl-A1oL6-');

$cliente->setRedirectUri('https://galeria-mmarjusticia.c9users.io/oauth/guardar.php');

$cliente->setScopes('https://mail.google.com/');

$cliente->setAccessType('offline');

if (!$cliente->getAccessToken()) {

   $auth = $cliente->createAuthUrl(); //solicitud

   header("Location: $auth");

}
