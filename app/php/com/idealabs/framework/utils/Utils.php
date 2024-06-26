<?php

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
 * Esta funci&oacute;n obtiene una conexi&oacute;n del pool configurado
 * inicialmente en context.xml
 *
 * @return Utils Conexi&oacute;n activa de la base de datos
 * configurada.
 * <br>
 * <b>Ejemplo :</b><pre>Utils.getConexion()</pre>
 * @property null PDOLocal
 */
class Utils
{

    //Instancía de conexión a la base de datos
    private static $_DATABASE = null;

    //Objeto de conexión-DB
    private $pdo;

    /**
     * Database constructor.<br>
     * Inicializa y se encarga de los atributos del objeto de conexión. <br>
     */
    function __construct()
    {
        try {

            // Crear nueva conexión PDO
            $this->pdo = self::connectDB();

        } catch (PDOException $PDOException) {
            if ($PDOException->getMessage() <> "")
                throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
            else
                throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Constructor credenciales de conexión, ".Constantes::LOG_MSG_ERROR_TRANSACCION,Constantes::LOG_TIPOERROR_FATALERROR);
        }
    }//__construct

    /**
     * Crear una nueva conexión PDO basada
     * en los datos de conexión
     * @return PDO Objeto PDO
     */
    function connectDB(){
        try{
            if ($this->pdo == null) {
                $this->pdo = new PDO(
                    'mysql:dbname=' . _DATABASE .
                    ';host=' . _HOSTNAME .
                    ';port:3306;',
                    _USERNAME,
                    _PASSWORD,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8, sql_mode='TRADITIONAL'")
                );

                //Desactivar la emulación de instrucciones preparadas y usar declaraciones preparadas
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                //Habilitar excepciones
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Eliminar el uso de bytes adicionales
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            return $this->pdo;

        } catch (PDOException $PDOException){

            if ($PDOException->getMessage() <> "")
                throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
            else
                throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Credenciales de conexión, ".Constantes::LOG_MSG_ERROR_TRANSACCION,Constantes::LOG_TIPOERROR_FATALERROR);
        }
    }//connectDB

    /**
     * Retorna en la única instancia de la clase
     * o crea una conexión inicial <br>
     * @return Utils|null
     */
    public static function getInstance()
    {
        if (self::$_DATABASE === null) {
            self::$_DATABASE = new self();
        }
        return self::$_DATABASE;
    }//getInstance

    /**
     * Evita la clonación de la instancia de la base de datos
     *
     */
    final protected function __clone(){}//__clone
}//Database
