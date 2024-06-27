<?php /** @noinspection ALL */

/*Librería de logging*/
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//Config. del logging
$log           = new Logger(__FILE__);
$CarpetaLogger = $_SERVER['DOCUMENT_ROOT'].'/'.Constantes::LOG;

/**
 * Usuario
 * Class Erp01_1m
 */
$app->group('/usuario/'.Constantes::API_VERSION_PRODUCCION, function () {

    /**
     * Agrega una empresa nueva
     * Crea una nueva empresa
     * Method: POST
     * NOTA:
     * @noinspection PhpUndefinedMethodInspection Ignora la inspección en particular de un metodo magico
     * @noinspection PhpUnusedParameterInspection Ignora la inspección en particular de un param no usado
     */
    $this->post('agregar', function (
         $request, $response) {
        try{

            $datosSolicitadosPeticion = $request->getParsedBody();
            $fechaActual = date('Y-m-d');
            //Valida los campos que le sean enviados en string, para saber si vienen cargados de información
            if($datosSolicitadosPeticion <> 0){

                $oUsuario  = new Erp01_1m();

                $oUsuario->setUsuClave($datosSolicitadosPeticion['usuClave']);
                $oUsuario->setSucNumCtrl((int) $datosSolicitadosPeticion['sucNumCtrl']);

                //En caso de que exista la empresa con esa clave, regresará el numero de control de esta
                $nUsuNumCtrlExistente = Erp01DAO::existe($oUsuario->getUsuClave());
                if ( $nUsuNumCtrlExistente == 0){
                    $sWSRespuesta = array();
                    $sWSRespuesta['error'] = true;
                    $sWSRespuesta['mensaje'] = 'El usuario no existe, probablemente fue eliminado por otro usuario.' . Constantes::VERIFIQUE_PORFAVOR ;
                    $sWSRespuesta['estatus']  = Constantes::ESTATUS_WARNING;

                    /** @noinspection PhpUndefinedMethodInspection */
                    $response->write(json_encode($sWSRespuesta));

                }else {
                    $sNombreDedo = "Huella ";

                    $nUhdCantidad = Erp64DAO::uhdCantidaddeHuellas($nUsuNumCtrlExistente) + 1;

                    $sNombreDedoCompleto = $sNombreDedo . $nUhdCantidad;

                    $oUsuario->setUhdNombre($sNombreDedoCompleto);
                    $oUsuario->setUhdFecha($fechaActual);
                    $oUsuario->setUhdHuella($datosSolicitadosPeticion['uhdHuella']);
                    $oUsuario->setUsuNumCtrl($nUsuNumCtrlExistente);

                    if (Erp01DAO::agregar($oUsuario)) {

                        $iUsuNumCtrlCreado = Erp01DAO::existe($oUsuario->getUsuClave());

                        if($iUsuNumCtrlCreado > 0){
                            $sWSRespuesta = array();
                            $sWSRespuesta['error']   = false;
                            $sWSRespuesta['mensaje'] = '';
                            $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                            /** @noinspection PhpUndefinedMethodInspection */
                            $response->write(json_encode($sWSRespuesta));
                        }
                    } else {

                        $sWSRespuesta = array();
                        $sWSRespuesta['error']   = true;
                        $sWSRespuesta['mensaje'] = 'Usuario agregar -'. Constantes::MENSAJE_GENERICO;
                        $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                        /** @noinspection PhpUndefinedMethodInspection */
                        $response->write(json_encode($sWSRespuesta));
                    }

                }
            }
            /** @noinspection PhpUndefinedMethodInspection */
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar empresa: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Usuario agregar -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            /** @noinspection PhpUndefinedMethodInspection */
            $response->write(json_encode($sWSRespuesta));

            /** @noinspection PhpUndefinedMethodInspection */
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//agregar

    /**
     * Agrega una asistencia
     * Method: POST
     */
    $this->post('agregarAsistencia', function (
        /** @noinspection  PhpUnusedParameterInspection */ $request, $response) {
        try{
            date_default_timezone_set ("America/Monterrey");

            $datosSolicitadosPeticion = $request->getParsedBody();
            $fechaActual              = date('d/m/Y');
            $fechaHoraActual          = new DateTime();
            $argHora                  = date('H:i:s');
            $sFecha                   = date_format($fechaHoraActual,'Y-m-d');
            //Valida los campos que le sean enviados en string, para saber si vienen cargados de información
            if($datosSolicitadosPeticion <> 0){

                $oUsuario  = new Erp01_1m();

                $oUsuario->setUsuClave($datosSolicitadosPeticion['usuClave']);

                //En caso de que exista la empresa con esa clave, regresará el numero de control de esta
                $nUsuNumCtrlExistente = Erp01DAO::existe($oUsuario->getUsuClave());
                if ( $nUsuNumCtrlExistente == 0){
                    $sWSRespuesta = array();
                    $sWSRespuesta['error'] = true;
                    $sWSRespuesta['mensaje'] = 'El usuario no existe, probablemente fue eliminado.' . Constantes::VERIFIQUE_PORFAVOR ;
                    $sWSRespuesta['estatus']  = Constantes::ESTATUS_WARNING;

                    /** @noinspection PhpUndefinedMethodInspection */
                    $response->write(json_encode($sWSRespuesta));
                    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);


                }else {

                    $oAsistencia    = new Seg40_1m();
                    $oAsixReg       = new Seg43_1m();
                    $asiNumCtrlRep  = 0;
                    //Obtenemos los valores enviados a través del método POST
                    $usuNumCtrlAct  = $nUsuNumCtrlExistente;
                    $usuNumCtrl     = $nUsuNumCtrlExistente;
                    $sucNumCtrl     = $datosSolicitadosPeticion['sucNumCtrl'];

                    //Consultamos el usuario
                    $usuNumCtrl = Erp01DAO::existexNumCtrl($usuNumCtrl);
                    if($usuNumCtrl <= 0){
                        $sWSRespuesta = array();
                        $sWSRespuesta['error']   = true;
                        $sWSRespuesta['mensaje'] = 'El usuario no existe, probablemente fue eliminada por otro usuario.. Por favor consulte de nueva cuenta la información y asegurese de que exista la sucursal.';
                        $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                        $response->write(json_encode($sWSRespuesta));
                        return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
                    }

                    //Consultamos la sucursal
                    $sucNumCtrl = Erp03DAO::existe($sucNumCtrl);
                    if($sucNumCtrl <= 0){
                        $sWSRespuesta = array();
                        $sWSRespuesta['error']   = true;
                        $sWSRespuesta['mensaje'] = 'La sucursal no existe, probablemente fue eliminada por otro usuario. Por favor consulte de nueva cuenta la información y asegurese de que exista la sucursal.';
                        $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                        $response->write(json_encode($sWSRespuesta));
                        return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
                    }

                    //Validamos fecha
                    $sValidarFecha = fValidaFecha($fechaActual);
                    if($sValidarFecha != ""){
                        $sWSRespuesta = array();
                        $sWSRespuesta['error']   = true;
                        $sWSRespuesta['mensaje'] = $sValidarFecha;
                        $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                        $response->write(json_encode($sWSRespuesta));
                        return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);

                    }

                    $asiRegistro = Seg45c::horxdetObtenerRegistro($usuNumCtrl,$fechaHoraActual);
                    //Consultamos la asistencia
                    $asiNumCtrl = Seg40DAO::existexUsuarioFecha($usuNumCtrl,fStringADate($fechaActual));
                    if($asiNumCtrl > 0){ //Modificar
                        //Validamos si no existe ya un registro con el mismo usuario, fecha y registro de hora.
                        switch ( $asiRegistro ) {
                            case 0:
                                $sWSRespuesta = array();
                                $sWSRespuesta['error']   = true;
                                $sWSRespuesta['mensaje'] = 'El usuario no tiene asignado un horario en el día seleccionado.';
                                $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                                $response->write(json_encode($sWSRespuesta));
                                return $response
                                    ->withHeader('Content-type', 'application/json')
                                    ->withStatus(200);
                                break;
                            case 1: $asiNumCtrlRep  = Seg40DAO::existeEntrada($asiNumCtrl); break;
                            case 2: $asiNumCtrlRep  = Seg40DAO::existeSalidaDesc($asiNumCtrl); break;
                            case 3: $asiNumCtrlRep  = Seg40DAO::existeEntradaDesc($asiNumCtrl); break;
                            case 4: $asiNumCtrlRep  = Seg40DAO::existeSalida($asiNumCtrl); break;
                        }

                        if( $asiNumCtrlRep > 0 ) {
                            $sWSRespuesta = array();
                            $sWSRespuesta['error']   = true;
                            $sWSRespuesta['mensaje'] = 'Ya existe un registro de ese usuario en esa fecha.';
                            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                            $response->write(json_encode($sWSRespuesta));
                            return $response
                                ->withHeader('Content-type', 'application/json')
                                ->withStatus(200);
                        }

                        //Seteamos los parametros al objeto de asixreg extraido del POST para leerlos en el DAO
                        $oAsixReg -> setArgHora($argHora);
                        $oAsixReg -> setArgTipo(Constantes::ARG_TIPO_BIOMETRICO);
                        $oAsixReg -> setArgObservacion("");
                        $oAsixReg -> setSucNumCtrl($sucNumCtrl);

                        //En caso de que agregue la asistencia regresara el número de control
                        $argNumCtrl = Seg40DAO::modificar($asiNumCtrl, $asiRegistro, $oAsixReg);

                        if($argNumCtrl > 0){
                            //Agregamos los datos de control
                            if (Seg15c::datoctrlAgregar("Seg43", $argNumCtrl, Constantes::CTR_ACTIVIDAD_ALTA, $usuNumCtrlAct, "")){
                                $sWSRespuesta = array();
                                $sWSRespuesta['error']   = false;
                                $sWSRespuesta['mensaje'] = '';
                                $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                                $response->write(json_encode($sWSRespuesta));
                            }
                        }else{
                            $sWSRespuesta = array();
                            $sWSRespuesta['error']   = true;
                            $sWSRespuesta['mensaje'] = Constantes::LOG_MSG_ERROR_TRANSACCION;
                            $sWSRespuesta['estatus'] = Constantes::LOG_TIPOERROR_CONTROLADO;
                            $response->write(json_encode($sWSRespuesta));
                        }
                    } else { //Agregar
                        //Obtenemos en número el día actual de la semana.
                        $diaSemana = date("N");

                        //Obtenemos el horario del usuario
                        $oHorario = Seg42DAO::obtenerHorarioxUsuario($usuNumCtrl, $diaSemana,$sFecha);

                        //Validamos si el usuario tiene horario en ese día de la semana.
                        if( $oHorario === false ) {
                            $sWSRespuesta = array();
                            $sWSRespuesta['error']   = true;
                            $sWSRespuesta['mensaje'] = 'El usuario no tiene asignado un horario en el día seleccionado.';
                            $sWSRespuesta['estatus'] = Constantes::LOG_TIPOERROR_CONTROLADO;
                            $response->write(json_encode($sWSRespuesta));
                            return $response
                                ->withHeader('Content-type', 'application/json')
                                ->withStatus(200);
                        }

                        if( $oHorario->hor_num_ctrl <= 0 ) {
                            $sWSRespuesta = array();
                            $sWSRespuesta['error']   = true;
                            $sWSRespuesta['mensaje'] = 'El horario del usuario no existe, probablemente fue eliminado por otro usuario.';
                            $sWSRespuesta['estatus'] = Constantes::LOG_TIPOERROR_CONTROLADO;
                            $response->write(json_encode($sWSRespuesta));
                            return $response
                                ->withHeader('Content-type', 'application/json')
                                ->withStatus(200);
                        }
                        //Seteamos los parametros al objeto de asistencia y asixreg extraido del POST para leerlos en el DAO
                        $oAsistencia -> setAsiNumCtrl($asiNumCtrl);
                        $oAsistencia -> setAsiFecha(fStringADate($fechaActual));
                        $oAsistencia -> setArgEntrada(null);
                        $oAsistencia -> setArgSalidaDesc(null);
                        $oAsistencia -> setArgEntradaDesc(null);
                        $oAsistencia -> setArgSalida(null);
                        $oAsistencia -> setAsiHorEntrada($oHorario->hxd_entrada);
                        $oAsistencia -> setAsiHorSalidaDesc($oHorario->hxd_salida_desc);
                        $oAsistencia -> setAsiHorEntradaDesc($oHorario->hxd_entrada_desc);
                        $oAsistencia -> setAsiHorSalida($oHorario->hxd_salida);
                        $oAsistencia -> setAsiHorDescanso($oHorario->hxd_descanso);
                        $oAsistencia -> setAsiHorTolerancia($oHorario->hor_tolerancia);
                        $oAsistencia -> setUsuNumCtrl($usuNumCtrl);

                        $oAsixReg -> setArgHora($argHora);
                        $oAsixReg -> setArgTipo(Constantes::ARG_TIPO_BIOMETRICO);
                        $oAsixReg -> setArgObservacion("");
                        $oAsixReg -> setSucNumCtrl($sucNumCtrl);

                        //En caso de que agregue la asistencia regresara el número de control
                        $arrNumCtrl = Seg40DAO::agregar($asiRegistro, $oAsistencia, $oAsixReg);

                        if($arrNumCtrl != false){
                           $sWSRespuesta = array();
                            $sWSRespuesta['error']   = false;
                            $sWSRespuesta['mensaje'] = '';
                            $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                            $response->write(json_encode($sWSRespuesta));
                        }else{
                            $sWSRespuesta = array();
                            $sWSRespuesta['error']   = true;
                            $sWSRespuesta['mensaje'] = Constantes::LOG_MSG_ERROR_TRANSACCION;
                            $sWSRespuesta['estatus'] = Constantes::LOG_TIPOERROR_CONTROLADO;
                            $response->write(json_encode($sWSRespuesta));
                        }
                    }
                    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);
                }
            }
        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar asistencia: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Asistencia agregar -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            $response->write(json_encode($sWSRespuesta));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//agregar

    /**
     * obtenerTabla
     * Obtiene la tabla Código postal
     * Method: get
     * @param $request
     * @param $response
     * @return mixed
     *
     * NOTA:
     * @noinspection PhpUndefinedMethodInspection Ignora la inspección en particular de un metodo magico
     * @noinspection PhpUnusedParameterInspection Ignora la inspección en particular de un param no usado
     */
    $this->get('obtenerTabla', function (
        /** @noinspection  PhpUnusedParameterInspection */ $request, $response) {

        try{
            $sWSRespuesta = array();

            if(!fValidarParametrosObligatoriosWS_GET(array('sucNumCtrl'), $request, $response)) {

                /** @noinspection PhpUndefinedMethodInspection */
                $sucNumCtrl = $request->getParam('sucNumCtrl');

                $operacionaRealizarDAO = new Erp01DAO;
                $arrRespuesta          = $operacionaRealizarDAO::obtenerTabla($sucNumCtrl);

                //Validamos que el arreglo venga cargado
                if (sizeof($arrRespuesta) > 0) {
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

            }

            /** @noinspection PhpUndefinedMethodInspection */
            return $response->write(json_encode($sWSRespuesta))
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);


        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener usuarios: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Obtener usuarios -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            /** @noinspection PhpUndefinedMethodInspection */
            $response->write(json_encode($sWSRespuesta));

            /** @noinspection PhpUndefinedMethodInspection */
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//obtenerTabla

    /**
     * Obtiene el objeto usuario según el número de control de esta
     * Method: get
     * @param $request
     * @param $response
     * @return mixed
     *
     * NOTA:
     * @noinspection PhpUndefinedMethodInspection Ignora la inspección en particular de un metodo magico
     * @noinspection PhpUnusedParameterInspection Ignora la inspección en particular de un param no usado
     */
    $this->get('obtenerUsuario', function (
        /** @noinspection  PhpUnusedParameterInspection */ $request, $response) {
        try{
            $sWSRespuesta = array();

            if(!fValidarParametrosObligatoriosWS_GET(array('usuClave'), $request, $response)) {

                /** @noinspection PhpUndefinedMethodInspection */
                $usuClave = $request->getParam('usuClave');

                $operacionaRealizarDAO = new Erp01DAO;
                $arrRespuesta = $operacionaRealizarDAO::obtenerUsuario($usuClave);

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

            /** @noinspection PhpUndefinedMethodInspection */
            return $response->write(json_encode($sWSRespuesta))
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener información del usuario: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Obtener información del usuario -'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            /** @noinspection PhpUndefinedMethodInspection */
            $response->write(json_encode($sWSRespuesta));

            /** @noinspection PhpUndefinedMethodInspection */
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//obtenerUsuario
});//Usuario