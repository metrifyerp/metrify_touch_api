<?php

/**
 * Obteniene una cadena "Si" o "No" a partir de un valor. Si el valor es null
 * @param $iValor -> Integer valor 0 o 1
 * @return string -> Valor "Si" o "No"
 */
function fGetSiNo($iValor)
{
    try
    {
        if ($iValor == null){
            return (string) "No";
        }
        else if($iValor > 0){
            return (string) "Si";
        }else
            return (string) "No";

    }
    catch (Exception $exception)
    {
        return "No";
    }
}//fGetSiNo

/**
 * Funci&oacute;n que sirve para validar y limpiar  un input text de Tipo POST
 *
 * trim             - Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena.
 * stripcslashes    - Devuelve una cadena con las barras invertidas eliminadas Reconoce las marcas tipo C \n, \r.
 * htmlspecialchars - Convierte caracteres especiales en entidades HTML
 * @param $sCadenaTexto   -> $itxt_input Campo a validar
 * @param $bCortarTexto   -> $itxt_input Indicamos si se requiere cortar el texto
 * @param $nCadenaTamanio -> $itxt_input Tamaño de la cadena de texto
 * @return string El string a convertir.
 */
function fLimpiarString($sCadenaTexto,$bCortarTexto,$nCadenaTamanio)
{
    $sCadenaTexto = trim($sCadenaTexto);
    $sCadenaTexto = stripcslashes($sCadenaTexto);
    $sCadenaTexto = htmlspecialchars($sCadenaTexto, ENT_COMPAT,'ISO-8859-1', true);

    //Indicamos si se requiere recortar el texto
    if($bCortarTexto)
        $sCadenaTexto = substr($sCadenaTexto,0,$nCadenaTamanio);

    return $sCadenaTexto;
}//fLimpiarString

/**
 * Obtiene de una variable de tipo Object una variable
 * tipo String , en caso de tener un valor null devuelve el par&aacute;metro
 * sDefault.
 * @param $sCadenaTexto -> variable que se convertira a String
 * @param $sDefault -> cadena que es devuelta en caso de que oObjeto sea null
 * @return string
 */
function fObtenerString($sCadenaTexto,$sDefault)
{
    try
    {
        if ($sCadenaTexto == null){
            return (string) $sDefault;
        }
        else if(strlen($sCadenaTexto) > 0){
            return (string) $sCadenaTexto;
        }else
            return (string) $sDefault;

    }
    catch (Exception $exception)
    {
        return "";
    }
}//fObtenerString

/**
 * Regresa un Password aleatorio, según los caracteres indicados.
 * substr: Devuelve parte de una cadena
 * base_convert: Convertir un número entre bases arbitrarias
 * sha1: Calcula el 'hash' sha1 de un string
 * uniqid: Generar un ID único
 * mt_rand: Genera un mejor número entero aleatorio
 * @param $iTamanio -> Cantidad de caracteres
 * @return string
 */
function fPasswordAleatorio($iTamanio)
{
    try
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $iTamanio);

    }
    catch (Exception $exception)
    {
        return "";
    }
}//fPasswordAleatorio

/**
 * Recorta una cadena <code>String</code> al tama&ntilde;o indicado en el par&aacute;metro y agrega puntos suspensivos al final de la cadena<br>
 * Ejemplo: fRecortaString("Lorem ipsum dolor sit amet, consectetur adipiscing elit",12)<br>
 * Salida:  Lorem ips...
 * @param $sCadena -> Cadena de texto original.
 * @param $iTamanioMaximo -> Tama&ntilde;o m&aacute;ximo que tendr&aacute; la cadena a recortar. * @param $iTamanioMaximo
 * @return string $sCadena
 */
function fRecortaString($sCadena,$iTamanioMaximo)
{
    try
    {
        if($sCadena == ""){
            return (string) $sCadena;
        }else{
            if (strlen($sCadena) > $iTamanioMaximo){
                $sCadena = substr($sCadena, 0, $iTamanioMaximo);
            }
            return (string) $sCadena;
        }

    }
    catch (Exception $exception)
    {
        $sCadena = "";
        return (string) $sCadena;
    }
}
//fRecortaString

/**
 * Elimina carácteres no deseados de una cadena de texto
 * Reemplaza todas las apariciones del string buscado con el string de reemplazo
 * @param $palabraABuscar -> Palabra que se buscara en la cade de texto
 * @param $palabraRemplazo -> Palabra por la cual se reemplazará la cade de texto
 * @param $sCadenaTexto -> Cadena de texto
 * @return string
 */
function fReemplazarPalabra($palabraABuscar,$palabraRemplazo,$sCadenaTexto)
{
    try
    {
        $sRespuesta = str_replace($palabraABuscar, $palabraRemplazo, $sCadenaTexto);

        return (string) $sRespuesta;
    }
    catch (Exception $exception)
    {
        return "";
    }
}//fReemplazarPalabra

/**
 * @param $nCadenaTextoCantidad
 * @return bool
 * https://arjunphp.com/check-for-valid-email-address-in-php/
 */
function fValidarCorreoElectronico($nCadenaTextoCantidad)
{
    if(preg_match("/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $nCadenaTextoCantidad) > 0)
        return true;
    else
        return false;

}//fValidarCorreoElectronico

/**
 * Valida los campos que le sean enviados en string, para saber si vienen cargados de información
 * @param $parametrosObligatorios
 * @param $request
 * @param $response
 * @return bool
 */
function fValidarParametrosObligatoriosWS($parametrosObligatorios, $request, $response){
    $bError                   = false;
    $datosSolicitadosPeticion = $request->getParsedBody();

    foreach($parametrosObligatorios as $parametroObligatorio){
        if(!isset($datosSolicitadosPeticion[$parametroObligatorio]) || strlen($datosSolicitadosPeticion[$parametroObligatorio])<=0){
            $bError = true;
            //Conjunto de parametros obligatorios los cuales vienen vacios
            //Se comenta debido a que actualmente la combinación de parametros obligatorios no esta en uso
            //$parametrosObligatoriosRespuesta .= $parametroObligatorio . ', ';
        }
    }

    //Si encuentra un error, regresamos una respuesta
    if($bError){
        $sWSRespuesta             = array();
        $sWSRespuesta['error']    = true;
        $sWSRespuesta['mensaje']  = Constantes::PARAMETROS_OBLIGATORIOS;
        $sWSRespuesta['estatus']  = Constantes::ESTATUS_ERROR;
        /** @noinspection PhpUndefinedMethodInspection */
        $response->write(json_encode($sWSRespuesta));
    }
    return $bError;
}//fValidarParametrosObligatoriosWS

/**
 * Valida los campos que le sean enviados en string, para saber si vienen cargados de información
 * @param $parametrosObligatorios
 * @param $request
 * @param $response
 * @return bool
 */
function fValidarParametrosObligatoriosWS_GET($parametrosObligatorios, $request, $response){
    $bError                          = false;

    foreach($parametrosObligatorios as $parametroObligatorio){

        /** @noinspection PhpUndefinedMethodInspection */
        $datosSolicitadosPeticion =  $request->getParam($parametroObligatorio);

        if(strlen($datosSolicitadosPeticion) <= 0){
            $bError = true;
            //Conjunto de parametros obligatorios los cuales vienen vacios
            //Se comenta debido a que actualmente la combinación de parametros obligatorios no esta en uso
            //$parametrosObligatoriosRespuesta .= $parametroObligatorio . ', ';
        }
    }

    //Si encuentra un error, regresamos una respuesta
    if($bError){
        $sWSRespuesta             = array();
        $sWSRespuesta['error']    = true;
        $sWSRespuesta['mensaje']  = Constantes::PARAMETROS_OBLIGATORIOS;
        $sWSRespuesta['estatus']  = Constantes::ESTATUS_ERROR;
        /** @noinspection PhpUndefinedMethodInspection */
        $response->write(json_encode($sWSRespuesta));
    }
    return $bError;
}//fValidarParametrosObligatoriosWS_GET

/**
 * Funci&oacute;n que sirve para validar y limpiar  un input text de Tipo POST
 *
 * trim             - Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena.
 * stripcslashes    - Devuelve una cadena con las barras invertidas eliminadas Reconoce las marcas tipo C \n, \r.
 * htmlspecialchars - Convierte caracteres especiales en entidades HTML
 * @param $sCadenaTexto   -> $itxt_input Campo a validar
 * @param $bCortarTexto   -> $itxt_input Indicamos si se requiere cortar el texto
 * @param $nCadenaTamanio -> $itxt_input Tamaño de la cadena de texto
 * @return string El string a convertir.
 */
function fObtenerValidarString($sCadenaTexto, $bCortarTexto, $nCadenaTamanio)
{
    $sCadenaTexto = trim($sCadenaTexto);
    $sCadenaTexto = stripcslashes($sCadenaTexto);
    $sCadenaTexto = strip_tags($sCadenaTexto);

    //Indicamos si se requiere recortar el texto
    if($bCortarTexto)
        $sCadenaTexto = mb_substr($sCadenaTexto,0,$nCadenaTamanio);

    return $sCadenaTexto;
}//fObtenerValidarString

/**
 * Esta función recibe tres parámetros (mes, día y año). Si la fecha existe en el calendario devuelve true y si no recibe false.
 * @param $pFecha -> Fecha en formato '20/08/2021'
 * @return bool
 * https://www.arsys.es/blog/programacion/tutorial-php-validar-fecha/
 */
function fValidaFecha($pFecha)
{
    $sResultado    = "";
    $fechaEnPartes = explode('/', $pFecha);

    if(count($fechaEnPartes) == 3 && !checkdate($fechaEnPartes[1], $fechaEnPartes[0], $fechaEnPartes[2])){
        $sResultado = "Fecha incorrecta. Ejemplo: 20/08/2021.";
    }

    return $sResultado;

}//fValidaFecha

/**
 * Convierte un string con una fecha en formato d/m/Y a un string con una fecha en formato Y-m-d.
 * @param   string $pFecha String con la fecha en formato d/m/Y.
 * @return  string String con la fecha en formato Y-m-d o string vacio.
 */
function fStringADate($pFecha)
{
    $sResultado    = "";

    if ($pFecha != ""){
        $pFecha = str_replace('/', '-', $pFecha);
        $sResultado  = date('Y-m-d', strtotime($pFecha));
    }

    return $sResultado;
}//fStringADate

/**
 * Esta funci&oacute;n obtiene de una variable de tipo Object una variable
 * tipo int, en caso de tener un valor null devuelve el par&aacute;metro
 * iDefault.
 * @param $iNumeroActual -> variable que se convertira a Integer
 * @param $iDefault -> cadena que es devuelta en caso de que oObjeto sea null
 * @return string
 */
function fObtenerInt($iNumeroActual,$iDefault)
{
    try {
        if ($iNumeroActual == null || $iNumeroActual == "null") {
            return (int)$iDefault;
        } else if ($iNumeroActual > 0) {
            return (int)$iNumeroActual;
        } else
            return (int)$iDefault;

    } catch (Exception $exception) {
        return 0;
    }
}//fObtenerInt
