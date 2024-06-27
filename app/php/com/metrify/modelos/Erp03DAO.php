<?php

/**
 * Sucursal
 * Class Erp03_1m
 */
class Erp03DAO
{
	//PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
	//PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
	//PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
	//                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

	/**
	 * Obtener la sucursal seg&uacute;n el numero de control
	 * que se le indique
	 * @param $sucNumCtrl
	 * @return int
	 */
	public static function existe($sucNumCtrl)
	{
		try {

			$nNumCtrlExiste = 0;

			$sQuery = "SELECT * FROM sucursal USE INDEX(`PRIMARY`) WHERE suc_num_ctrl = :suc_num_ctrl LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":suc_num_ctrl", $sucNumCtrl);

			$ps->execute();

			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["suc_num_ctrl"] > 0)
				$nNumCtrlExiste = $row["suc_num_ctrl"];

			return $nNumCtrlExiste;

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe sucursal, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);

		}
	}//existe

	/**
	 * Obtiene la sucursal que coincida con el número de control.
	 * @param $nSucNumCtrl -> Número de control de la sucursal
	 * @return array|false
	 */
	public static function obtenerSucursal($nSucNumCtrl)
	{
		try {

			$sQuery = "SELECT 
                            sucursal.suc_num_ctrl,
                            sucursal.suc_clave,
                            CONCAT_WS(' ', suc_clave, '-', suc_nombre ) as suc_nombre,
                            sucursal.suc_calle,
                            sucursal.suc_numero_exterior,
                            sucursal.suc_colonia,
                            sucursal.suc_ciudad,
                            sucursal.suc_principal,
                            sucursal.emp_num_ctrl,
                            sucursal.est_num_ctrl,
                            sucursal.suc_serie,
                            sucursal.suc_telefono,
                            sucursal.suc_hora_entrada,
                            sucursal.suc_hora_salida,
                            sucursal.suc_estatus,
                            sucursal.cpo_num_ctrl,
                            sucursal.suc_orden,
                            sucursal.axp_num_ctrl,
                            codigopostal.cpo_codigo,
                            estado.est_nombre,
                            estado.est_abreviacion,
                            artxpreciolista.axp_deslarga
                        FROM 
                            sucursal USE INDEX(`PRIMARY`)
                            JOIN codigopostal ON sucursal.cpo_num_ctrl = codigopostal.cpo_num_ctrl
                            JOIN estado on sucursal.est_num_ctrl = estado.est_num_ctrl
                            JOIN artxpreciolista on sucursal.axp_num_ctrl = artxpreciolista.axp_num_ctrl
                        WHERE 
                          suc_num_ctrl = :suc_num_ctrl ";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":suc_num_ctrl", $nSucNumCtrl);

			$ps->execute();

			return $ps->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener sucursal información, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//obtenerSucursal

	/**
	 * Obtiene todas las sucursales que coincida con el número de control.
	 * @return array|false
	 */
	public static function obtenerSucursales()
	{
		try {

			$sQuery = "SELECT GROUP_CONCAT(suc_num_ctrl) AS suc_num_ctrl FROM sucursal USE INDEX(`PRIMARY`) WHERE suc_estatus = :suc_estatus";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":suc_estatus", Constantes::ALZ_ESTATUS_ACTIVO);

			$ps->execute();

			return $ps->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener sucursal información, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//obtenerSucursales

	/**
	 * Obtiene la tabla de sucursal
	 * @return array|false convertido a JSON Object
	 */
	public static function obtenerTabla()
	{
		try {
			$sQuery = "SELECT suc_num_ctrl, CONCAT_WS(' ', suc_clave, '-', suc_nombre ) as suc_nombre FROM sucursal USE 
                        INDEX (`PRIMARY`) WHERE suc_estatus = :suc_estatus ORDER BY suc_clave";
			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);
			$ps->bindValue(":suc_estatus", Constantes::ALZ_ESTATUS_ACTIVO);
			$ps->execute();
			return $ps->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener sucursales, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//obtenerTabla

}//Sucursal