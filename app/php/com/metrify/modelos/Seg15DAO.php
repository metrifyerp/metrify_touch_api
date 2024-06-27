<?php

/**
 * Dato Control
 * Class Seg15_1m
 */
class Seg15DAO
{
	//PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
	//PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
	//PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
	//                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

	/**
	 * Agregar un nuevo dato control
	 * @param Seg15_1m $oDatoCtrl
	 * @return bool
	 */
	public static function agregar(Seg15_1m $oDatoCtrl)
	{
		try {

			$Utils = new Utils();

			$sQuery = "INSERT INTO datoctrl  (`ent_num_ctrl`,
                                             `ctr_origen`,
                                             `ctr_actividad`,
                                             `usu_num_ctrl`,
                                             `ctr_fechahora`,
                                             `ctr_observa`)
                        VALUES (:ent_num_ctrl, :ctr_origen, :ctr_actividad,:usu_num_ctrl, :ctr_fechora, :ctr_observa )";

			$ps = $Utils->getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":ent_num_ctrl", $oDatoCtrl->getEntNumCtrl());
			$ps->bindValue(":ctr_origen", $oDatoCtrl->getCtrOrigen());
			$ps->bindValue(":ctr_actividad", $oDatoCtrl->getCtrActividad());
			$ps->bindValue(":usu_num_ctrl", $oDatoCtrl->getUsuNumCtrl());
			$ps->bindValue(":ctr_fechora", $oDatoCtrl->getCtrFechora());
			$ps->bindValue(":ctr_observa", $oDatoCtrl->getCtrObserva());

			$ps->execute();
			if ($ps)
				return true;

			return false;
		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar dato control, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}

	}//agregar
}//Dato Control