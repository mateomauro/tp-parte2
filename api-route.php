<?php
require_once 'libs/Router.php';
require_once 'app/controllers/apiControlador.php';

// crea el router
$router = new Router();

//TRAE TODO LOS VEHICULOS
$router->addRoute('vehiculos', 'GET', 'apiControlador', 'obtenerVehiculos');

//TRAE VEHICULO POR ID
$router->addRoute('vehiculos/:ID', 'GET', 'apiControlador', 'obtenerVehiculo');

//ELIMINA VEHICULO POR ID
$router->addRoute('vehiculos/:ID', 'DELETE', 'apiControlador', 'eliminarVehiculo');

//INSERTAR VEHICULO
$router->addRoute('vehiculos', 'POST', 'apiControlador', 'agregarVehiculo');

//EDITAR VEHICULO
$router->addRoute('vehiculos/:ID', 'PUT', 'apiControlador', 'editarVehiculo');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>