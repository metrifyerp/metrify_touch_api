<?php

/**
 * Asistencia
 * Class Seg40DAO
 */
class Seg40DAO
{
	//PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
	//PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
	//PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
	//                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

	/**
	 * Agregar asistencia
	 * @param $asiRegistro Int
	 * @param $oAsistencia Seg40_1m
	 * @param $oAsixReg Seg43_1m
	 * @return mixed
	 */
	public static function agregar($asiRegistro, $oAsistencia, $oAsixReg)
	{
		$sQueryAsistencia = "
            INSERT INTO
                asistencia (asi_fecha, arg_entrada, arg_salida_desc, arg_entrada_desc, arg_salida, asi_hor_entrada, asi_hor_salida_desc, asi_hor_entrada_desc, asi_hor_salida, asi_hor_descanso, asi_hor_tolerancia, usu_num_ctrl)
            VALUES (
                :asi_fecha, :arg_entrada, :arg_salida_desc, :arg_entrada_desc, :arg_salida, :asi_hor_entrada, :asi_hor_salida_desc, :asi_hor_entrada_desc, :asi_hor_salida, :asi_hor_descanso, :asi_hor_tolerancia, :usu_num_ctrl
            )";

		$sQueryAsixReg = "
            INSERT INTO
                asixreg (arg_hora, arg_tipo, arg_observacion, suc_num_ctrl)
            VALUES (
                :arg_hora, :arg_tipo, :arg_observacion, :suc_num_ctrl
            )";

		$sQueryAusencia = "
            DELETE
            FROM
                ausencia 
            WHERE
                ausencia.usu_num_ctrl = :usu_num_ctrl 
                AND ausencia.tda_num_ctrl = :tda_num_ctrl 
                AND CAST(ausencia.aus_fechahora_ini AS DATE) = CAST(:aus_fechahora_ini AS DATE) 
                AND CAST(ausencia.aus_fechahora_fin AS DATE) = CAST(:aus_fechahora_fin AS DATE)";

		$Utils = new Utils();

		try {
			//Empezamos la transacción.
			$Utils->getInstance()->connectDB()->beginTransaction();

			//AsixReg
			$ps = $Utils->getInstance()->connectDB()->prepare($sQueryAsixReg);
			$ps->bindValue(":arg_hora", $oAsixReg->getArgHora());
			$ps->bindValue(":arg_tipo", $oAsixReg->getArgTipo());
			$ps->bindValue(":arg_observacion", $oAsixReg->getArgObservacion());
			$ps->bindValue(":suc_num_ctrl", $oAsixReg->getSucNumCtrl());

			$ps->execute();

			//Si no se inserto AsixReg hacemos RollBack y regresamos False
			if ($ps == false) {
				$Utils->getInstance()->connectDB()->rollBack();
				return false;
			}

			//Obtenemos el $argNumCtrl
			$sQuery = "SELECT LAST_INSERT_ID() AS nuevo_registro";
			$ps = $Utils->getInstance()->connectDB()->prepare($sQuery);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["nuevo_registro"] > 0) {
				$argNumCtrl = $row["nuevo_registro"];
			} else {
				//Si no se obtuvo el $usuNumCtrl hacemos RollBack y regresamos False
				$Utils->getInstance()->connectDB()->rollBack();
				return false;
			}

			//Asistencia
			$ps = $Utils->getInstance()->connectDB()->prepare($sQueryAsistencia);

			//Asignamos el $argNumCtrl al campo correspondiente segun el tipo de registro.
			switch ($asiRegistro) {
				case 1:
					$oAsistencia->setArgEntrada($argNumCtrl);
					break;
				case 2:
					$oAsistencia->setArgSalidaDesc($argNumCtrl);
					break;
				case 3:
					$oAsistencia->setArgEntradaDesc($argNumCtrl);
					break;
				case 4:
					$oAsistencia->setArgSalida($argNumCtrl);
					break;
				default:
					if ($ps == false) {
						$Utils->getInstance()->connectDB()->rollBack();
						return false;
					}
			}

			$ps->bindValue(":asi_fecha", $oAsistencia->getAsiFecha());
			$ps->bindValue(":arg_entrada", $oAsistencia->getArgEntrada());
			$ps->bindValue(":arg_salida_desc", $oAsistencia->getArgSalidaDesc());
			$ps->bindValue(":arg_entrada_desc", $oAsistencia->getArgEntradaDesc());
			$ps->bindValue(":arg_salida", $oAsistencia->getArgSalida());
			$ps->bindValue(":asi_hor_entrada", $oAsistencia->getAsiHorEntrada());
			$ps->bindValue(":asi_hor_salida_desc", $oAsistencia->getAsiHorSalidaDesc());
			$ps->bindValue(":asi_hor_entrada_desc", $oAsistencia->getAsiHorEntradaDesc());
			$ps->bindValue(":asi_hor_salida", $oAsistencia->getAsiHorSalida());
			$ps->bindValue(":asi_hor_descanso", $oAsistencia->getAsiHorDescanso());
			$ps->bindValue(":asi_hor_tolerancia", $oAsistencia->getAsiHorTolerancia());
			$ps->bindValue(":usu_num_ctrl", $oAsistencia->getUsuNumCtrl());
			$ps->execute();

			//Si no se inserto AsixReg hacemos RollBack y regresamos False
			if ($ps == false) {
				$Utils->getInstance()->connectDB()->rollBack();
				return false;
			}

			//Obtenemos el $asiNumCtrl
			$sQuery = "SELECT LAST_INSERT_ID() AS nuevo_registro";
			$ps = $Utils->getInstance()->connectDB()->prepare($sQuery);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["nuevo_registro"] > 0) {
				$asiNumCtrl = $row["nuevo_registro"];
			} else {
				//Si no se obtuvo el $usuNumCtrl hacemos RollBack y regresamos False
				$Utils->getInstance()->connectDB()->rollBack();
				return false;
			}

			//Ausencia
			$ps = $Utils->getInstance()->connectDB()->prepare($sQueryAusencia);
			$ps->bindValue(":usu_num_ctrl", $oAsistencia->getUsuNumCtrl());
			$ps->bindValue(":tda_num_ctrl", Constantes::TDA_NUM_CTRL_FALTA);
			$ps->bindValue(":aus_fechahora_ini", $oAsistencia->getAsiFecha());
			$ps->bindValue(":aus_fechahora_fin", $oAsistencia->getAsiFecha());
			$ps->execute();

			//Si no se elimino Ausencia hacemos RollBack y regresamos False
			if ($ps == false) {
				$Utils->getInstance()->connectDB()->rollBack();
				return false;
			}

			//Todas las Queries se hicieron correctamente, hacemos Commit y hacemos return.
			$Utils->getInstance()->connectDB()->commit();
			return [$asiNumCtrl, $argNumCtrl];

		} catch (PDOException $PDOException) {
			$Utils->getInstance()->connectDB()->rollBack();
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar asistencia, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//agregar

	/**
	 * Obtener la asistencia seg&uacute;n el numero de control que se le indique
	 * @param $asiNumCtrl
	 * @return int
	 */
	public static function existe($asiNumCtrl)
	{
		try {
			$nNumCtrlExiste = 0;

			$sQuery = "SELECT asi_num_ctrl FROM asistencia USE INDEX(`PRIMARY`) WHERE asi_num_ctrl = :asi_num_ctrl LIMIT 1";
			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":asi_num_ctrl", $asiNumCtrl);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["asi_num_ctrl"] > 0) {
				$nNumCtrlExiste = $row["asi_num_ctrl"];
			}
			return $nNumCtrlExiste;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener asistencia, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//existe

	/**
	 * Obtener la asistencia seg&uacute;n la Entrada
	 * @param $asiNumCtrl Int
	 * @return int
	 */
	public static function existeEntrada($asiNumCtrl)
	{
		try {
			$asiNumCtrlExt = 0;

			$sQuery = "
                SELECT
                    asi_num_ctrl 
                FROM
                    asistencia use INDEX(`PRIMARY`) 
                WHERE
                    asi_num_ctrl = :asi_num_ctrl
                    AND arg_entrada IS NOT NULL
                LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":asi_num_ctrl", $asiNumCtrl);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["asi_num_ctrl"] > 0) {
				$asiNumCtrlExt = $row["asi_num_ctrl"];
			}

			return $asiNumCtrlExt;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe entrada, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//existeEntrada

	/**
	 * Obtener la asistencia seg&uacute;n la Entrada Desc.
	 * @param $asiNumCtrl Int
	 * @return int
	 */
	public static function existeEntradaDesc($asiNumCtrl)
	{
		try {
			$asiNumCtrlExt = 0;

			$sQuery = "
                SELECT
                    asi_num_ctrl 
                FROM
                    asistencia use INDEX(`PRIMARY`) 
                WHERE
                    asi_num_ctrl = :asi_num_ctrl
                    AND arg_entrada_desc IS NOT NULL
                LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":asi_num_ctrl", $asiNumCtrl);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["asi_num_ctrl"] > 0) {
				$asiNumCtrlExt = $row["asi_num_ctrl"];
			}

			return $asiNumCtrlExt;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe entrada desc., " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//existeEntradaDesc

	/**
	 * Obtener la asistencia seg&uacute;n la Salida
	 * @param $asiNumCtrl Int
	 * @return int
	 */
	public static function existeSalida($asiNumCtrl)
	{
		try {
			$asiNumCtrlExt = 0;

			$sQuery = "
                SELECT
                    asi_num_ctrl 
                FROM
                    asistencia use INDEX(`PRIMARY`) 
                WHERE
                    asi_num_ctrl = :asi_num_ctrl
                    AND arg_salida IS NOT NULL
                LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":asi_num_ctrl", $asiNumCtrl);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["asi_num_ctrl"] > 0) {
				$asiNumCtrlExt = $row["asi_num_ctrl"];
			}

			return $asiNumCtrlExt;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe salida, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//existeSalida

	/**
	 * Obtener la asistencia seg&uacute;n la Salida Desc.
	 * @param $asiNumCtrl Int
	 * @return int
	 */
	public static function existeSalidaDesc($asiNumCtrl)
	{
		try {
			$asiNumCtrlExt = 0;

			$sQuery = "
                SELECT
                    asi_num_ctrl 
                FROM
                    asistencia use INDEX(`PRIMARY`) 
                WHERE
                    asi_num_ctrl = :asi_num_ctrl
                    AND arg_salida_desc IS NOT NULL
                LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":asi_num_ctrl", $asiNumCtrl);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if (count($row) > 0)
				if ($row["asi_num_ctrl"] > 0)
					$asiNumCtrlExt = $row["asi_num_ctrl"];


			return $asiNumCtrlExt;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe salida desc., " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//existeSalidaDesc

	/**
	 * Obtener la asistencia seg&uacute;n el Usuario y Fecha
	 * @param $usuNumCtrl Int
	 * @param $asiFecha String
	 * @return int
	 */
	public static function existexUsuarioFecha($usuNumCtrl, $asiFecha)
	{
		try {
			$asiNumCtrl = 0;

			$sQuery = "
                SELECT
                    asi_num_ctrl 
                FROM
                    asistencia use INDEX(`PRIMARY`) 
                WHERE
                    usu_num_ctrl = :usu_num_ctrl
                    AND asi_fecha = CAST(:asi_fecha AS DATE)
                    AND (
                        arg_entrada IS NOT NULL
                        OR arg_salida_desc IS NOT NULL
                        OR arg_entrada_desc IS NOT NULL
                        OR arg_salida IS NOT NULL ) 
                LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":usu_num_ctrl", $usuNumCtrl);
			$ps->bindValue(":asi_fecha", $asiFecha);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["asi_num_ctrl"] > 0) {
				$asiNumCtrl = $row["asi_num_ctrl"];
			}

			return $asiNumCtrl;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe asistencia, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//existexUsuarioFecha

	/**
	 * Modificar asistencia
	 * @param $asiNumCtrl Int
	 * @param $asiRegistro Int
	 * @param $oAsixReg Seg43_1m
	 * @return int
	 */
	public static function modificar($asiNumCtrl, $asiRegistro, $oAsixReg)
	{
		$sQueryAsixReg = "
            INSERT INTO
                asixreg (arg_hora, arg_tipo, arg_observacion, suc_num_ctrl)
            VALUES (
                :arg_hora, :arg_tipo, :arg_observacion, :suc_num_ctrl
            )";

		$Utils = new Utils();
		$campo = "";

		try {
			//Empezamos la transacción.
			$Utils->getInstance()->connectDB()->beginTransaction();

			//AsixReg
			$ps = $Utils->getInstance()->connectDB()->prepare($sQueryAsixReg);
			$ps->bindValue(":arg_hora", $oAsixReg->getArgHora());
			$ps->bindValue(":arg_tipo", $oAsixReg->getArgTipo());
			$ps->bindValue(":arg_observacion", $oAsixReg->getArgObservacion());
			$ps->bindValue(":suc_num_ctrl", $oAsixReg->getSucNumCtrl());

			$ps->execute();

			//Si no se inserto AsixReg hacemos RollBack y regresamos 0
			if ($ps == false) {
				$Utils->getInstance()->connectDB()->rollBack();
				return 0;
			}

			//Obtenemos el $argNumCtrl
			$sQuery = "SELECT LAST_INSERT_ID() AS nuevo_registro";
			$ps = $Utils->getInstance()->connectDB()->prepare($sQuery);
			$ps->execute();
			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["nuevo_registro"] > 0) {
				$argNumCtrl = $row["nuevo_registro"];
			} else {
				//Si no se obtuvo el $usuNumCtrl hacemos RollBack y regresamos 0
				$Utils->getInstance()->connectDB()->rollBack();
				return 0;
			}

			//Asistencia
			//Asignamos el $argNumCtrl al campo correspondiente segun el tipo de registro.
			switch ($asiRegistro) {
				case 1:
					$campo = "arg_entrada";
					break;
				case 2:
					$campo = "arg_salida_desc";
					break;
				case 3:
					$campo = "arg_entrada_desc";
					break;
				case 4:
					$campo = "arg_salida";
					break;
				default:
					if ($ps == false) {
						$Utils->getInstance()->connectDB()->rollBack();
						return 0;
					}
			}

			$sQueryAsistencia = "
                UPDATE
                    asistencia
                SET 
                    $campo = :arg_num_ctrl
                WHERE
                    asistencia.asi_num_ctrl = :asi_num_ctrl";


			$ps = $Utils->getInstance()->connectDB()->prepare($sQueryAsistencia);
			$ps->bindValue(":arg_num_ctrl", $argNumCtrl);
			$ps->bindValue(":asi_num_ctrl", $asiNumCtrl);
			$ps->execute();

			//Si no se inserto AsixReg hacemos RollBack y regresamos 0
			if ($ps == false) {
				$Utils->getInstance()->connectDB()->rollBack();
				return 0;
			}

			//Todas las Queries se hicieron correctamente, hacemos Commit y hacemos return.
			$Utils->getInstance()->connectDB()->commit();
			return $argNumCtrl;

		} catch (PDOException $PDOException) {
			$Utils->getInstance()->connectDB()->rollBack();
			if ($PDOException->getMessage() <> "") {
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar asistencia, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//modificar
}//Asistencia