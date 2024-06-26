<?php

/*Librería de logging*/
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//Config. del logging
$log           = new Logger(__FILE__);
$CarpetaLogger = $_SERVER['DOCUMENT_ROOT'].'/'.Constantes::LOG;

/**
 * Dato Control
 * Class Seg15_1m
 */
class Seg15c
{
    /**
     * Crea un registro de dato de control.
     * @param $entClave -> Clave de la entidad
     * @param $ctrOrigen  -> N&uacute;mero de control del campo que origin&oacute; el dato de control
     * @param $ctrActividad -> Tipo de actividad que se va guardar(Checar valores por campo valxcam)
     * @param $usuNumCtrl -> N&uacute;mero de control de la persona que origin&oacute; el dato de control
     * @param $ctrObserva -> Observaciones que se guardar&aacute;n en el dato de control
     * @return bool
     * @throws Exception
     */
    public static function datoctrlAgregar($entClave, $ctrOrigen, $ctrActividad, $usuNumCtrl, $ctrObserva){
        try{

            $bDatoCtrlCreado      = false;

            $oDatoCtrl            = new Seg15_1m();

            $datoCtrlFechaHora    = date("Y-m-d H:i:s");

            //Consultamos el número de control de la entidad para saber si esta existe
            $iEntNumCtrl          = Seg09DAO::existe($entClave);

            //Validamos que la entidad exista para poder guardar el datoCtrl
            if($iEntNumCtrl > 0){

                //Creamos el Objeto oDatoCtrl
                //Seteamos los parametros al objeto de cliente extraidos para leerlos en el DAO
                $oDatoCtrl -> setEntNumCtrl($iEntNumCtrl);
                $oDatoCtrl -> setCtrOrigen($ctrOrigen);
                $oDatoCtrl -> setCtrActividad($ctrActividad);
                $oDatoCtrl -> setUsuNumCtrl($usuNumCtrl);
                $oDatoCtrl -> setCtrObserva($ctrObserva);
                $oDatoCtrl -> setCtrFechora($datoCtrlFechaHora);

                //Agregamos el dato control del registro
                if(Seg15DAO::agregar($oDatoCtrl))
                    $bDatoCtrlCreado = true;
            }

            return $bDatoCtrlCreado;

        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar dato control: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            return false;
        }
    }//datoctrlAgregar
}//Dato control


