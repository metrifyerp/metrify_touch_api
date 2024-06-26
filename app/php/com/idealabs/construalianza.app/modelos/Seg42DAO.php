<?php
/**
 * Horario
 * Class Seg42DAO
 */
class Seg42DAO
{
    //PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
    //PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
    //PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
    //                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

    /**
     * Obtener el horario seg&uacute;n el numero de control que se le indique
     * @param $horNumCtrl
     * @return int
     */
    public static function existe($horNumCtrl){
        try {

            $nNumCtrlExiste = 0;

            $sQuery  = "SELECT hor_num_ctrl FROM horario USE INDEX(`PRIMARY`) WHERE hor_num_ctrl = :hor_num_ctrl LIMIT 1";

            $ps = Utils::getInstance()->connectDB()->prepare($sQuery);
            $ps -> bindValue(":hor_num_ctrl", $horNumCtrl);
            $ps -> execute();
            $row  = $ps->fetch(PDO::FETCH_ASSOC);

            if($row["hor_num_ctrl"] > 0) {
                $nNumCtrlExiste = $row["hor_num_ctrl"];
            }
            return $nNumCtrlExiste;

        } catch (PDOException $PDOException){
            if ($PDOException->getMessage() <> ""){
                throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
            }else{
                throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener horario, ".Constantes::LOG_MSG_ERROR_TRANSACCION,Constantes::LOG_TIPOERROR_FATALERROR);
            }
        }
    }//existe

    /**
     * Obtiene el horario que coincida con el número de control del usuario.
     * @param $usuNumCtrl -> Número de control del usuario
     * @param $diaSemana  -> Número del día de la semana.
     * @param $fecha -> Fecha.
     * @return object
     */
    public static function obtenerHorarioxUsuario($usuNumCtrl, $diaSemana, $fecha){
        try {
            $sQuery = "
                SELECT
                    horario.hor_num_ctrl,
                    horario.hor_clave,
                    horario.hor_nombre,
                    horario.hor_tolerancia,
                    IF(diainhabil.din_num_ctrl IS NULL, horxdet.hxd_entrada, diainhabil.din_entrada) AS hxd_entrada,
                    IF(diainhabil.din_num_ctrl IS NULL, horxdet.hxd_salida_desc, NULL) AS hxd_salida_desc,
                    IF(diainhabil.din_num_ctrl IS NULL, horxdet.hxd_entrada_desc, NULL) AS hxd_entrada_desc,
                    IF(diainhabil.din_num_ctrl IS NULL, horxdet.hxd_salida, diainhabil.din_salida) AS hxd_salida,
                    IF(diainhabil.din_num_ctrl IS NULL, horxdet.hxd_descanso, :hxd_descanso) AS hxd_descanso,
                    diainhabil.din_num_ctrl
                FROM
                    usuario 
                    JOIN
                        usuxsuc 
                        ON usuario.usu_num_ctrl = usuxsuc.usu_num_ctrl 
                    JOIN
                        usuxrol 
                        ON usuario.usu_num_ctrl = usuxrol.usu_num_ctrl 
                    JOIN
                        horxrolxsuc 
                        ON usuxsuc.suc_num_ctrl = horxrolxsuc.suc_num_ctrl 
                        AND usuxrol.rol_num_ctrl = horxrolxsuc.rol_num_ctrl 
                    JOIN
                        horario 
                        ON horxrolxsuc.hor_num_ctrl = horario.hor_num_ctrl 
                    JOIN
                        horxdet 
                        ON horario.hor_num_ctrl = horxdet.hor_num_ctrl
                    LEFT JOIN
                        diainhabil
                        ON diainhabil.din_fecha = CAST(:din_fecha AS DATE)
                        AND diainhabil.din_tipo = :din_tipo
                WHERE
                    usuxsuc.usu_num_ctrl = :usu_num_ctrl
                    AND horxdet.hxd_dia  = :hxd_dia";

            $ps  = Utils::getInstance()->connectDB()->prepare($sQuery);
            $ps -> bindValue(":hxd_descanso", Constantes::HXD_DESCANSO_NO);
            $ps -> bindValue(":din_fecha", $fecha);
            $ps -> bindValue(":din_tipo", Constantes::DIN_TIPO_MEDIO);
            $ps -> bindValue(":usu_num_ctrl", $usuNumCtrl);
            $ps -> bindValue(":hxd_dia", $diaSemana);
            $ps -> execute();
            $row  = $ps->fetch(PDO::FETCH_OBJ);

            return $row;

        } catch (PDOException $PDOException){
            if ($PDOException->getMessage() <> ""){
                throw new PDOException( $PDOException -> getMessage(),Constantes::LOG_TIPOERROR_FATALERROR);
            }else{
                throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener horario información, ".Constantes::LOG_MSG_ERROR_TRANSACCION,Constantes::LOG_TIPOERROR_FATALERROR);
            }
        }
    }//obtenerHorarioxUsuario
}//Seg42DAO