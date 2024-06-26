<?php
/**
 * Entidad
 * Class Seg09_1m
 */
class Seg09DAO
{
    //PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
    //PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
    //PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
    //                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

    /**
     * Obtener la entidad seg&uacute;n el numero de control
     * que se le indique
     * @param $entNumCtrl
     * @return int
     */
    public static function existe($entNumCtrl){
        try {

            $nNumCtrlExiste = 0;
            $sQuery  = "SELECT * FROM entidad USE INDEX(`PRIMARY`) WHERE ent_clave = :ent_clave LIMIT 1";
            $ps      = Utils::getInstance()->connectDB()->prepare($sQuery);
            $ps -> bindValue(":ent_clave", $entNumCtrl);
            $ps -> execute();
            $row  = $ps->fetch(PDO::FETCH_ASSOC);

            if($row["ent_num_ctrl"] > 0)
                $nNumCtrlExiste = $row["ent_num_ctrl"];

            return $nNumCtrlExiste;
        } catch (PDOException $PDOException){

            if ($PDOException->getMessage() <> "")
                throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
            else
                throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener entidad, ".Constantes::LOG_MSG_ERROR_TRANSACCION,Constantes::LOG_TIPOERROR_FATALERROR);
        }
    }//existe
}//Entidad