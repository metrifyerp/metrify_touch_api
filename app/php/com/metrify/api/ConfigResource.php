<?php

/*Librería de logging*/
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//Config. del logging
$log           = new Logger(__FILE__);
$CarpetaLogger = $_SERVER['DOCUMENT_ROOT'].'/'.Constantes::LOG;

//Especifica diferentes informes de nivel de error
/**
 * TODO - DESPLIGUE PRODUCCIÓN
 */
error_reporting(0);
/**
 * TODO - DESPLIGUE PRODUCCIÓN
 */

/**
 * TODO - DESPLIGUE DEV
 */
//error_reporting(E_ALL ^ E_NOTICE );
//ini_set('display_errors', 'On');
/**
 * TODO - DESPLIGUE DEV
 */

/**
 * Configuracion
 */
$app->group('/config/'.Constantes::API_VERSION_PRODUCCION, function (){

    /**
     * Obtiene el día actaul del servidor
     * Method: get
     * @param $request
     * @param $response
     * @return mixed
     *
     */
    $this->get('obtenerDiaActual', function ($request, $response) {

	    try {
		    // Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
		    date_default_timezone_set("America/Monterrey");
		    $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre",
			    "Octubre","Noviembre","Diciembre");
		    $sWSRespuesta = array();
		    $joConfig = new stdClass();

		    $joConfig->hoy = $diassemana[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');
		    $arrRespuesta = $joConfig;

		    // Validamos que el objeto tenga propiedades
		    if (count(get_object_vars($arrRespuesta)) > 0) {
			    $sWSRespuesta['error'] = false;
			    $sWSRespuesta['mensaje'] = '';
			    $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
			    $sWSRespuesta['arrData'] = array($arrRespuesta);
		    } else {
			    $sWSRespuesta['error'] = true;
			    $sWSRespuesta['mensaje'] = Constantes::NO_HAY_DATOS;
			    $sWSRespuesta['estatus'] = Constantes::ESTATUS_WARNING;
			    $sWSRespuesta['arrData'] = array($arrRespuesta);
		    }

		    return $response->write(json_encode($sWSRespuesta))
			    ->withHeader('Content-type', 'application/json')
			    ->withStatus(200);
	    } catch (PDOException | Exception $Exception) {
		    // Error que se guarda en el Log, para una mejor interpretación
		    $GLOBALS['log']->pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
		    $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener día actual: " . "MENSAJE: " . $Exception->getMessage() . " ARCHIVO: " . $Exception->getFile() . " LÍNEA: " . $Exception->getLine());

		    $sWSRespuesta = array();
		    $sWSRespuesta['error'] = true;
		    $sWSRespuesta['mensaje'] = 'Obtener día actual -' . Constantes::MENSAJE_GENERICO;
		    $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
		    $response->write(json_encode($sWSRespuesta));

		    return $response
			    ->withHeader('Content-type', 'application/json')
			    ->withStatus(500);
	    }

    });//obtenerDiaActual

});//obtenerDiaActual

