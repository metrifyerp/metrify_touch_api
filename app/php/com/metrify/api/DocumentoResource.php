<?php /** @noinspection ALL */

/*Librería de logging*/
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//Config. del logging
$log           = new Logger(__FILE__);
$CarpetaLogger = $_SERVER['DOCUMENT_ROOT'].'/'.Constantes::LOG;

//Especifica diferentes informes de nivel de error
//TODO: En producción, cambiar a: 0 --> Deshabilitar en producción
error_reporting(0);
ini_set('display_errors', 'On');

/**
 * Documento
 * Class Erp15_1m
 */
$app->group('/Documento/'.Constantes::API_VERSION_PRODUCCION, function (){

    /**
     * subir
     * La carga de archivos es una característica que debe estar presente en todas las aplicaciones web.
     * Esta recurso se encarga de subir un archivo
     * Method: post
     * @param $request
     * @param $response
     * @args $args
     * @return mixed
     *
     * NOTA:
     * @noinspection PhpUndefinedMethodInspection Ignora la inspección en particular de un metodo magico
     * @noinspection PhpUnusedParameterInspection Ignora la inspección en particular de un param no usado
     */
    $this->post('agregar/{docNombre}', function (
        /** @noinspection PhpUnusedParameterInspection */ $request, $response, $args) {

        try {

            //Las cargas de archivos $_FILES están disponibles desde el getUploadedFiles()
            //Este método obtiene el objeto de la solicitud para así devolver una matriz con el nombre del elemento.
            /** @noinspection PhpUndefinedMethodInspection */
            $archivoMatriz = $request->getUploadedFiles();

            //Obtenemos el archivo mediante el ID
            $archivoaSubir = $archivoMatriz['documento'];

            if($archivoaSubir <> null) {
                //A continuación, verificamos si la carga se realizó correctamente o no.
                /** @noinspection PhpUndefinedMethodInspection */
                if ($archivoaSubir->getError() === UPLOAD_ERR_OK) {

                    //Obtenemos la extención del archivo.
                    /** @noinspection PhpUndefinedMethodInspection */
                    $archivoExtencion = pathinfo($archivoaSubir->getClientFilename(), PATHINFO_EXTENSION);

                    //Establecemos el ContentType de de acuerdo al tipo de archivo, para que el navegador sepa manejar el contenido
                    /**
                     * Extenciones permitidas
                     * pdf
                     * jpeg
                     * jpg
                     * png
                     * xml
                     * ini
                     */
                    if ($archivoExtencion == Constantes::EXT_PDF || $archivoExtencion == Constantes::EXT_JPEG || $archivoExtencion == Constantes::EXT_JPG || $archivoExtencion == Constantes::EXT_PNG || $archivoExtencion == Constantes::EXT_XML || $archivoExtencion == Constantes::EXT_INI) {

                        //Obtenemos y cambiamos el nombre del archivo mediante id del archivo mandado en el metodo POST
                        $archivoNombre = sprintf('%s.%0.8s', $args["docNombre"], $archivoExtencion);

                        //Después de eso, movemos el archivo cargado en TMP al directorio de destino el cúal esta configurado en settings
                        $docs = $this->get('settings')['docs'];
                        /** @noinspection PhpUndefinedMethodInspection */
                        $archivoaSubir->moveTo($docs . DIRECTORY_SEPARATOR . $archivoNombre);

                        //A continuación, verificamos si la carga se realizó correctamente o no.
                        /** @noinspection PhpUndefinedMethodInspection */
                        if ($archivoaSubir->getError() === UPLOAD_ERR_OK) {
                            $sWSRespuesta['error'] = false;
                            $sWSRespuesta['mensaje'] = 'El archivo se ha subido satisfactoriamente.';
                            $sWSRespuesta['estatus'] = Constantes::ESTATUS_OK;
                            $sWSRespuesta['arrData'] = [];

                        } else {
                            $sWSRespuesta['error'] = true;
                            $sWSRespuesta['mensaje'] = 'Documento subir: El documento no se subio a la carpeta de documentos.' . Constantes::MENSAJE_GENERICO;
                            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                            $sWSRespuesta['arrData'] = [];
                        }
                    } else {
                        $sWSRespuesta['error'] = true;
                        $sWSRespuesta['mensaje'] = 'Documento subir. El documento que desea subir no cuenta como tipo de archivo válido, tipos válidos: ' . Constantes::EXT_PDF . ", " . Constantes::EXT_JPEG . ", " . Constantes::EXT_JPG . ", " . Constantes::EXT_PNG . ", " . Constantes::EXT_XML . ", " . Constantes::EXT_INI;
                        $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                        $sWSRespuesta['arrData'] = [];
                    }

                } else {
                    $sWSRespuesta['error'] = true;
                    $sWSRespuesta['mensaje'] = 'Documento subir.' . Constantes::MENSAJE_GENERICO;
                    $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                    $sWSRespuesta['arrData'] = [];
                }
            }else {
                $sWSRespuesta['error'] = true;
                $sWSRespuesta['mensaje'] = 'Documento subir. No se encontró el identificador: documento.' . Constantes::MENSAJE_GENERICO;
                $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                $sWSRespuesta['arrData'] = [];
            }

            /** @noinspection PhpUndefinedMethodInspection */
            $response->write(json_encode($sWSRespuesta));

            /** @noinspection PhpUndefinedMethodInspection */
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);

        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Documento subir: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Documento subir.'. Constantes::MENSAJE_GENERICO;
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
     * obtenerDocumento
     * La carga de archivos es una característica que debe estar presente en todas las aplicaciones web.
     * Esta recurso se encarga de obtener un archivo por medio del nombre de este
     * Method: post
     * @param $request
     * @param $response
     * @args $args
     * @return mixed
     *
     * NOTA:
     * @noinspection PhpUndefinedMethodInspection Ignora la inspección en particular de un metodo magico
     * @noinspection PhpUnusedParameterInspection Ignora la inspección en particular de un param no usado
     *
     * https://www.php.net/manual/es/function.fopen.php
     */
    $this->post('obtenerDocumento/{docNombre}', function (
        /** @noinspection PhpUnusedParameterInspection */ $request, $response, $args) {
        try{
            //Obtenemos el nombre del archivo mediante id del archivo mandado en el metodo POST
            $archivoNombre =  $args["docNombre"];

            //Otenemos el archivo cargado en docs (directorio de destino) el cúal esta configurado en settings
            $docs = $this->get('settings')['docs'];

            //Ruta del archivo que se exportará
            $archivoaExportar = $docs.'/'. $archivoNombre;

            //Abre un fichero o un URL
            //asocia un recurso con nombre, especificado por filename, a un flujo.
            //'r'	Apertura para sólo lectura; coloca el puntero al fichero al principio del fichero.
            $archivoSoloLectura = fopen($archivoaExportar, "r");

            //Se valida que el archivo exista en la ubicación indicada en: $archivoaExportar
            if($archivoSoloLectura){
                //Un stream es un objeto de tipo resource que puede ser leído o escrito de una forma lineal,
                //y con el que se puede usar la función fseek() para buscar posiciones dentro del mismo.
                //Los streams sirven para generalizar operaciones que comparten una funcionalidad común.
                //Son una característica de PHP que fue introducida en PHP 4.3 para unificar los métodos de trabajar con archivos,
                //sockets y otros recursos similares.

                //Crea una nueva instancia de flujo, que será enviada en el cuerpo de respuesta
                $stream = new \Slim\Http\Stream($archivoSoloLectura);

                if($stream <> null){
                    //MIME
                    //El tipo Extensiones multipropósito de Correo de Internet (MIME) es una forma estandarizada de indicar
                    //la naturaleza y el formato de un documento.
                    //Está definido y estandarizado en IETF RFC 6838.
                    /** @noinspection PhpUndefinedMethodInspection */
                    return $response
                        //Fuerza al navegador a descarcar un archivo
                        ->withHeader('Content-Type', 'application/force-download')
                        //Le especifica al navegador que el archivo a descargar es desconocido.
                        //Los navegadores tienen un cuidado particular cuando manipulan estos archivos,
                        //tratando de proteger al usuario previéndo comportamientos peligrosos.
                        ->withHeader('Content-Type', 'application/octet-stream')
                        ->withHeader('Content-Type', 'application/download')
                        ->withHeader('Content-Description', 'File Transfer')
                        //Tipo de transformación que se ha utilizado para representar el cuerpo de manera aceptable
                        ->withHeader('Content-Transfer-Encoding', 'binary')
                        ->withHeader('Content-Disposition', 'attachment; filename="' . basename($archivoaExportar) . '"')
                        //El encabezado Expires contiene la fecha y hora en la que se considerará la respuesta caducada.
                        ->withHeader('Expires', '0')
                        //Especifica directivas para los mecanismos de almacenamiento en caché tanto en las solicitudes como en las respuestas.
                        //must-revalidate: El caché debe verificar el estado de los recursos obsoletos antes de usarlo
                        //y los caducados no deben usarse.
                        ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                        //Se utiliza para la compatibilidad con versiones anteriores de las memorias caché HTTP / 1.0
                        //en las que el Cache-Controlencabezado HTTP / 1.1 aún no está presente.
                        ->withHeader('Pragma', 'public')
                        ->withHeader('Content-Length', filesize($archivoaExportar))
                        ->withBody($stream);

                } else {
                    $sWSRespuesta['error'] = true;
                    $sWSRespuesta['mensaje'] = 'Documento obtener.'. Constantes::MENSAJE_GENERICO;
                    $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
                    $sWSRespuesta['arrData'] = [];

                    /** @noinspection PhpUndefinedMethodInspection */
                    $response->write(json_encode($sWSRespuesta));

                    /** @noinspection PhpUndefinedMethodInspection */
                    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(404);
                }
            } else {
                $sWSRespuesta['error'] = true;
                $sWSRespuesta['mensaje'] = 'No se encontró el documento con el identificador: ' . $archivoNombre . ", probablemente ha sido eliminado por otro usuario,". Constantes::VERIFIQUE_PORFAVOR;
                $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;

                /** @noinspection PhpUndefinedMethodInspection */
                $response->write(json_encode($sWSRespuesta));

                /** @noinspection PhpUndefinedMethodInspection */
                return $response
                    ->withHeader('Content-type', 'application/json')
                    ->withStatus(404);

            }
        } catch (PDOException | Exception $Exception){

            //Error que se guarda en el Log, para una mejor interpretación
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']-> pushHandler(new StreamHandler($GLOBALS['CarpetaLogger'], Logger::ERROR));
            /** @noinspection PhpUndefinedMethodInspection */
            $GLOBALS['log']->error(Constantes::LOG_ERROR_FATAL_ERROR . " - Documento subir: " ."MENSAJE: ". $Exception -> getMessage() ." ARCHIVO: ". $Exception -> getFile() ." LÍNEA: ". $Exception -> getLine());

            $sWSRespuesta = array();
            $sWSRespuesta['error']   = true;
            $sWSRespuesta['mensaje'] = 'Documento obtener.'. Constantes::MENSAJE_GENERICO;
            $sWSRespuesta['estatus'] = Constantes::ESTATUS_ERROR;
            /** @noinspection PhpUndefinedMethodInspection */
            $response->write(json_encode($sWSRespuesta));

            /** @noinspection PhpUndefinedMethodInspection */
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(500);
        }
    });//obtenerDocumento

});//Documento

