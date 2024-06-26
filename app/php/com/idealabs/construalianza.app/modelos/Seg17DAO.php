<?php
/**
 * Parametro
 * Class Seg17_1m
 */

class Seg17DAO
{
    //PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
    //PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
    //PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
    //                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

    /**
     * Obtiene la sucursal que coincida con el número de control.
     * @param $parClave -> Clave del parametro
     * @return array|false
     */
    public static function obtenerParametroxClave($parClave){
        try {

            $sQuery  = "SELECT 
                            *
                        FROM 
                            parametro USE INDEX(`PRIMARY`)
                        WHERE 
                          par_clave = :par_clave ";

            $ps      = Utils::getInstance()->connectDB()->prepare($sQuery);

            $ps -> bindValue(":par_clave",  $parClave);

            $ps -> execute();

            $rs = $ps->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        } catch (PDOException $PDOException){
            if ($PDOException->getMessage() <> ""){
                throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
            }else{
                throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener parametro información, ".Constantes::LOG_MSG_ERROR_TRANSACCION,Constantes::LOG_TIPOERROR_FATALERROR);
            }
        }

    }//obtenerParametroxClave
}