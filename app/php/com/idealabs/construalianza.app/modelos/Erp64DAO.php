<?php
/**
 * Usuxhishid
 * Class Erp64_1m
 */

class Erp64DAO
{
    //PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
    //PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
    //PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
    //                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

    /**
     * Obtenemos las huellas registradas por usuario
     * en donde se le indique
     * @return int $nHuellasxUsuario
     */
    public static function uhdCantidaddeHuellas($usuNumCtrl){
        try {

            $nHuellasxUsuario = 0;

            $sQuery  = "SELECT COUNT(uhd_num_ctrl) as uhd_cantidad FROM usuxhishid USE INDEX(`PRIMARY`) WHERE usu_num_ctrl = :usu_num_ctrl  ";

            $ps      = Utils::getInstance()->connectDB()->prepare($sQuery);

            $ps -> bindValue(":usu_num_ctrl", $usuNumCtrl);

            $ps -> execute();

            $row  = $ps->fetch(PDO::FETCH_ASSOC);

            if($row["uhd_cantidad"] > 0)
                $nHuellasxUsuario = $row["uhd_cantidad"];

            return $nHuellasxUsuario;


        } catch (PDOException $PDOException){
            throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
        }
    }//usuarioCantidadeHuellas
}//Usuxhishid