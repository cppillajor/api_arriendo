<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//RUTAS USUARIO Y LOGIN

$routes->post('/usuario',                'Usuario::create');
$routes->get('/usuario',                 'Usuario::index');
$routes->get('/usuario/(:segment)',      'Usuario::show/$1');
$routes->put('/usuario/(:segment)',      'Usuario::update/$1');
$routes->delete('/usuario/(:segment)',   'Usuario::delete/$1');

//RUTAS PARA EN ARRIENDO

$routes->post('/enarriendocrear',                'EnArriendo::create');
$routes->post('/enarriendoshow',                'EnArriendo::show');
$routes->post('/enarriendoeliminar',                'EnArriendo::delete');

//RUTAS PARA NOTIFICACION
$routes->post('/notificacioncrear',                'Notificacion::create');
$routes->post('/notificacionseleccionarsegunidpersona',                'Notificacion::seleccionarsegunidpersona');
$routes->post('/notificacioneliminar',                'Notificacion::delete');

//RUTAS PARA INMUEBLE
$routes->post('/inmuebleeliminar',                'Inmueble::delete');
$routes->post('/inmuebleselectseguntipoinmueble',                'Inmueble::seleccionarseguntipoinmueble');
$routes->post('/inmuebleshow',                'Inmueble::show');
$routes->post('/inmuebleselectsegunidpersona',                'Inmueble::selectsegunidpersona');
$routes->post('/inmueblecrear',                'Inmueble::create');
$routes->post('/inmuebleeditar',                'Inmueble::update');

//RUTAS PERSONA
$routes->post('/login',                'Persona::login');
$routes->post('/personaselectall',                'Persona::index');
$routes->post('/personacrear',                'Persona::create');
$routes->post('/personaeditar',                'Persona::update');
$routes->post('/personaeliminar',                'Persona::delete');
$routes->post('/personashow',                'Persona::show');
$routes->post('/personaasignarrol',                'Persona::asignarrol');
$routes->post('/personacomprobarusuariocorreo',                'Persona::comprobarcorreousuario');

//RUTAS PARA GALERIA
$routes->post('/galeriasegunidinmueble',                'Galeria::selectsegunidinmueble');
$routes->post('/galeriacrear',                'Galeria::create');
$routes->post('/galeriaeliminar',                'Galeria::delete');

//RUTAS PARA INMUEBLE PAGO MENSUAL
$routes->post('/inmueblepagomensualsegunidinmueble',                'InmueblePagoMensual::seleccionarsegunidinmueble');
$routes->post('/inmueblepagomensualcrear',                'InmueblePagoMensual::create');
$routes->post('/inmueblepagomensualeditar',                'InmueblePagoMensual::update');

//RUTAS PARA ROL
$routes->post('/rol',                'Rol::index');

//RUTAS PARA SOLICITUD ARRIENDO
$routes->post('/solicitudarriendocrear',                'SolicitudArriendo::create');
$routes->post('/solicitudarriendointeresadosinmueble',                'SolicitudArriendo::seleccionarinteresadosinmueble');
$routes->post('/solicitudarriendocomprobarsolicitudrepetida',                'SolicitudArriendo::comprobarsolicitudrepetida');

//RUTAS PARA SOLICITUD ROL
$routes->post('/solicitudrolcrear',                'SolicitudRol::create');
$routes->post('/solicitudrolcomprobarsolicitud',                'SolicitudRol::comprobarsolicitudenviadaidpersona');
$routes->post('/solicitudrolselect',                'SolicitudRol::index');
$routes->post('/solicitudroleliminar',                'SolicitudRol::delete');
//RUTAS PARA TIPO INMUEBLE
$routes->post('/tipoinmuebleselect',                'TipoInmueble::index');
$routes->post('/tipoinmueblecrear',                'TipoInmueble::create');
$routes->post('/tipoinmuebleeditar',                'TipoInmueble::update');
$routes->post('/tipoinmuebleeliminar',                'TipoInmueble::delete');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
