<?php
/**
 * Carga automaticamente lo que agreguemos dentro de las carpetas indicadas.
 */

$rutaBase = __DIR__ . '/';

//Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
date_default_timezone_set("America/Monterrey");

$arrCarpetasaCargar = [
    '../META-INF/',
    'php/com/idealabs/framework/utils/',
    'php/com/idealabs/construalianza.app/modelos/',
    'php/com/idealabs/construalianza.app/clases/',
    'php/com/idealabs/construalianza.app/api/'
];//$arrCarpetasaCargar

//Recorre el arreglo de carpetas para poder obtener los archivos .php de estas
foreach($arrCarpetasaCargar as $carpeta)
{
    //Busca todos los nombres de ruta que coinciden con pattern en este caso .php según las reglas usadas por la función glob()
    foreach (glob($rutaBase . "$carpeta*.php") as $nombreArchivoPHP)
    {
        //Verifica si el archivo ya ha sido incluido y si es así, no se incluye
        require_once $nombreArchivoPHP;
    }//foreach glob
}//foreach $arrCarpetasaCargar