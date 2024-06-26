<?php

class Constantes
{
    /**
     * Nombre del sistema <br>
     * Este se muestra en la pestaña del navegador
     */
    Const NOMBRE_SISTEMA = "alianzaapi";
    Const LOG            = Constantes::NOMBRE_SISTEMA.'/logs/log_alianza.log';

    /**
     * HORXDET
     */

    Const HXD_DESCANSO_SI = 1;
    Const HXD_DESCANSO_NO = 0;

    Const HXD_DIA_LUNES     = 1;
    Const HXD_DIA_MARTES    = 2;
    Const HXD_DIA_MIERCOLES = 3;
    Const HXD_DIA_JUEVES    = 4;
    Const HXD_DIA_VIERNES   = 5;
    Const HXD_DIA_SABADO    = 6;
    Const HXD_DIA_DOMINGO   = 7;

    /**
     * DIAINHABIL
     */

    Const DIN_TIPO_COMPLETO = 1; //Día completo.
    Const DIN_TIPO_MEDIO    = 2; //Medio día.

    /**
     * ALIANZA
     */
    Const ALZ_ESTATUS_ACTIVO    = 1;
    Const ALZ_ESTATUS_INACTIVO  = 0;

    /**
     * Mensaje de error gen&eacute;rico
     */
    Const MENSAJE_GENERICO        = " No se realizó la transacción. Por favor intente de nueva cuenta y si persiste el problema, por favor comuníquese con las oficinas centrales para mayor información.";
    Const NO_HAY_DATOS            = "No se encontraron datos disponibles en esta tabla.";
    Const VERIFIQUE_PORFAVOR      = " verifique por favor...";
    Const PARAMETROS_OBLIGATORIOS = "Los campos con * son obligatorios.";

    /**
     * Esta constante se usa para indicar en el log cuando un error es FATAL ERROR,  <br>
     *  por ejemplo: SQLException, Exception, inconsistencia de datos.
     */
    Const LOG_ERROR_FATAL_ERROR = "Fatal Error ";

    /**
     * Esta constante se usa para indicar en el log cuando un error es de configuraci&oacute;n, por ejemplo: <br>
     * par&aacute;metros de sistema que no existen o no tiene valor u otros errores que tengan que ver con la
     * configuraci&oacute;n del sistema en los que solo un administrador del sistema puede resolver.
     */
    Const LOG_ERROR_CONFIGURACION = "Configuración - ";

    /**
     * Esta constante se usa para indicar en el log cuando un error es FATAL ERROR,  <br>
     *  por ejemplo: SQLException, Exception, inconsistencia de datos.
     */
    Const LOG_MSG_ERROR_TRANSACCION = "No se realizó la transacción. ";
    /**
     * Indica cual es el tipo de error controlado dirigido al usuario. <br>
     * Este tipo de error no debe generar log.
     */
    Const LOG_TIPOERROR_CONTROLADO = 1;

    /**
     * Indica cual es el tipo de error FATAL ERROR. <br>
     * Este tipo de error debe generar un log.error.
     */
    Const LOG_TIPOERROR_FATALERROR = 2;

    /**
     * Indica cual es el tipo de error que indica si el usuario ya no cuenta
     *  con su dispositivo activo en los colegios donde anteriormente se
     *  encontraba activo.
     * Este tipo de error no debe generar log.
     */
    Const LOG_TIPOERROR_DISPOSITIVO = 3;

    /**
     * Valor del estatus <b>INACTIVO</b> de la empresa.
     */
    Const ESTATUS_INACTIVO      = 0;

    /**
     * Valor del estatus <b>ACTIVO</b> de la empresa.
     */
    Const ESTATUS_ACTIVO        = 1;

    /**
     * Indica cual es el tipo de error de configuraci&oacute;n. <br>
     * Este tipo de error debe generar un log.warn
     */
    Const LOG_TIPOERROR_CONFIGURACION = 4;

    /**
     * Valor del estatus <b>ACTIVO</b> de la empresa.
     */
    Const EMP_ESTATUS_ACTIVO          = 1;

    /**
     * Valor del estatus <b>ACTIVO</b> del articulo.
     */
    Const CUR_ESTATUS_ACTIVO          = 1;

    /**
     * Constantes requeridas para nuestro servicio web
     */

    /**
     * ESTATUS DE RESPUESTA
     */
    Const ESTATUS_OK      = 1;
    Const ESTATUS_ERROR   = 2;
    Const ESTATUS_WARNING = 3;
    Const ESTATUS_INFO    = 4;

    /**
     * ERP Alianza
     */

    /**
     * Version del API
     * El cambio en una API es inevitable a medida que mejora su conocimiento y experiencia de un sistema.
     * Gestionar el impacto de este cambio puede ser un desafío cuando amenaza con romper la integración existente del cliente.
     */
    Const API_VERSION_PRODUCCION = "v1/";

    /**
     * Datos Control
     * CTR_ACTIVIDAD_MODIFICA = Modificación
     * CTR_ACTIVIDAD_ALTA     = Alta
     */

    Const CTR_ACTIVIDAD_MODIFICA = 1;
    Const CTR_ACTIVIDAD_ALTA     = 4;
    Const CTR_MENSAJE_ERROR      = "Los datos de control no fueron generados. Por favor comun&iacute;quese con las oficinas centrales para mayor información.";

    /**
     * Extenciones permitidas
     * Son las extenciones permitidas por el API para la carga de archivos
     * pdf
     * jpeg
     * jpg
     * png
     * xml
     * ini
     */
    Const EXT_PDF  = "pdf";
    Const EXT_JPEG = "jpeg";
    Const EXT_JPG  = "jpg";
    Const EXT_PNG  = "png";
    Const EXT_XML  = "xml";
    Const EXT_INI  = "ini";

    /**
     * ASIXREG
     */

    Const ARG_TIPO_BIOMETRICO   = 1;
    Const ARG_TIPO_MANUAL       = 2;

    /**
     * TIPAUS
     */
    Const TDA_NUM_CTRL_FALTA        = 1;
    Const TDA_NUM_CTRL_VACACIONES   = 2;
    Const TDA_NUM_CTRL_VACACIONES_TRABAJADAS = 3;
    Const TDA_NUM_CTRL_PERMISO      = 4;
    Const TDA_NUM_CTRL_INCAPACIDAD  = 5;


}//Constantes
