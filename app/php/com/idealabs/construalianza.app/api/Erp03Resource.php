<?php

/*Librería de logging*/
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//Config. del logging
$log           = new Logger(__FILE__);
$CarpetaLogger = $_SERVER['DOCUMENT_ROOT'].'/'.Constantes::LOG;

/**
 * Sucursal
 * Class Erp03_1m
 */
$app->group('/sucursal/'.Constantes::API_VERSION_PRODUCCION, function () {

    /**
     * Obtiene el objeto sucursal según el número de control de esta
     * Method: get
     * @param $request
     * @param $response
     * @return mixed
     *
     */
    $this->get('obtenerSucursal', function ( $request, $response) {
        try{
            $sWSRespuesta = array();

            if(!fValidarParametrosObligatoriosWS_GET(array('sucNumCtrl'), $request, $response)) {

                $sucNumCtrl = $request->getParam('sucNumCtrl');

                $operacionaRealizarDAO = new Erp03DAO;
                $arrRespuesta = $operacionaRealizarDAO::obtenerSucursal($sucNumCtrl);

                $sWSRespuesta = array();

                //Validamos que el arreglo venga cargado
                if (sizeof($arrRespuesta) > 0) {
                    $sWSRespuesta['error'] = false;
                    $sWSRespuesta['mensaje'] = '';
                    $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                    $sWSRespuesta['arrData'] = $arrRespuesta;

                } else {
                    $sWSRespuesta['error'] = true;
                    $sWSRespuesta['mensaje'] = Constantes::NO_HAY_DATOS;
                    $sWSRespuesta['estatus'] = Constantes::ESTATUS_WARNING;
                    $sWSRespuesta['arrData'] = $arrRespuesta;
                }
            }

            return $response->write(json_encode($sWSRespuesta))
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener información de la sucursal: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Obtener información de la sucursal -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            $response->write(json_encode($sWSRespuesta));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//obtenerSucursal

    /**
     * Obtiene el objeto sucursal según la clave de esta
     * Method: get
     * @param $request
     * @param $response
     * @return mixed
     */
    $this->get('obtenerSucursales', function ( $request, $response) {
        try{
            $operacionaRealizarDAO = new Erp03DAO;
            $arrRespuesta = $operacionaRealizarDAO::obtenerSucursales();

            $sWSRespuesta = array();

            //Validamos que el arreglo venga cargado
            if(sizeof($arrRespuesta) > 0) {
                $sWSRespuesta['error'] = false;
                $sWSRespuesta['mensaje'] = '';
                $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                $sWSRespuesta['arrData'] = $arrRespuesta;

            } else {
                $sWSRespuesta['error'] = true;
                $sWSRespuesta['mensaje'] = Constantes::NO_HAY_DATOS;
                $sWSRespuesta['estatus'] = Constantes::ESTATUS_WARNING;
                $sWSRespuesta['arrData'] = $arrRespuesta;
            }

            return $response->write(json_encode($sWSRespuesta))
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener información de la sucursal: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Obtener información de la sucursal -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            $response->write(json_encode($sWSRespuesta));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//obtenerSucursales

    /**
     * Obtiene la tabla de sucursales
     * Method: get
     * @param $request
     * @param $response
     * @return mixed
     */
    $this->get('obtenerTabla', function ($request, $response) {

        try{
            $operacionaRealizarDAO = new Erp03DAO;
            $arrRespuesta          = $operacionaRealizarDAO::obtenerTabla();

            $sWSRespuesta = array();

            //Validamos que el arreglo venga cargado
            if(sizeof($arrRespuesta) > 0) {
                $sWSRespuesta['error']   = false;
                $sWSRespuesta['mensaje'] = '';
                $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                $sWSRespuesta['arrData'] = $arrRespuesta;

            } else {
                $sWSRespuesta['error']   = true;
                $sWSRespuesta['mensaje'] = Constantes::NO_HAY_DATOS;
                $sWSRespuesta['estatus'] = Constantes::ESTATUS_WARNING;
                $sWSRespuesta['arrData'] = $arrRespuesta;
            }

            return $response->write(json_encode($sWSRespuesta))
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);


        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener sucursales: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Obtener sucursales -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            $response->write(json_encode($sWSRespuesta));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//obtenerTabla
});//Sucursal
