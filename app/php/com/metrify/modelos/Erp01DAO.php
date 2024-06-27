<?php

/**
 * Usuario
 * Class Erp01_1m
 */
class Erp01DAO
{
	//PDOStatement::rowCount() Devuelve el número de filas afectadas por la última sentencia DELETE, INSERT, o UPDATE ejecutada por el correspondiente objeto PDOStatement.
	//PDOStatement::fetch()    Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
	//PDOStatement::execute()  Ejecuta la sentencia preparada. Si ésta incluía marcadores de parámetros, se debe:
	//                         llamar a PDOStatement::bindParam() y/o PDOStatement::bindValue() para vincular variables o valores (respectivamente) a los marcadores de parámetros.

	/**
	 * Agregar una nueva huella digital
	 * @param Erp01_1m $oUsuario
	 * @return bool
	 */
	public static function agregar(Erp01_1m $oUsuario)
	{
		try {

			$Utils = new Utils();

			$sQuery = "INSERT INTO usuxhishid  (`uhd_nombre`,
                                             `uhd_fecha`,
                                             `usu_num_ctrl`,
                                             `uhd_huella`,
                                             `suc_num_ctrl`
                                             )
                        VALUES (:uhd_nombre, :uhd_fecha, :usu_num_ctrl,:uhd_huella, :suc_num_ctrl)";

			$ps = $Utils->getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":uhd_nombre", $oUsuario->getUhdNombre());
			$ps->bindValue(":uhd_fecha", $oUsuario->getUhdFecha());
			$ps->bindValue(":usu_num_ctrl", $oUsuario->getUsuNumCtrl());
			$ps->bindValue(":uhd_huella", $oUsuario->getUhdHuella());
			$ps->bindValue(":suc_num_ctrl", $oUsuario->getSucNumCtrl());

			$ps->execute();

			if ($ps)
				return true;

			return false;
		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Agregar usuario, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//agregar

	/**
	 * Obtener el usuario seg&uacute;n la clave
	 * que se le indique
	 * @param $sUsuClave
	 * @return int
	 */
	public static function existe($sUsuClave)
	{
		try {

			$nNumCtrlExiste = 0;

			$sQuery = "SELECT * FROM usuario USE INDEX(`PRIMARY`) WHERE usu_clave = :usu_clave LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":usu_clave", $sUsuClave);

			$ps->execute();

			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["usu_num_ctrl"] > 0)
				$nNumCtrlExiste = $row["usu_num_ctrl"];

			return $nNumCtrlExiste;


		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe usuario, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//existexClave

	/**
	 * Obtener el usuario seg&uacute;n la clave
	 * que se le indique
	 * @param $sUsuNumCtrl
	 * @return int
	 */
	public static function existexNumCtrl($sUsuNumCtrl)
	{
		try {

			$nNumCtrlExiste = 0;

			$sQuery = "SELECT * FROM usuario USE INDEX(`PRIMARY`) WHERE usu_num_ctrl = :usu_num_ctrl LIMIT 1";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":usu_num_ctrl", $sUsuNumCtrl);

			$ps->execute();

			$row = $ps->fetch(PDO::FETCH_ASSOC);

			if ($row["usu_num_ctrl"] > 0)
				$nNumCtrlExiste = $row["usu_num_ctrl"];

			return $nNumCtrlExiste;

		} catch (PDOException $PDOException) {

			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Existe usuario por número de control, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//existexClave

	/**
	 * Obtiene la tabla de usuarios
	 */
	public static function obtenerTabla($nSucNumCtrl)
	{
		try {

			$sQuery = "SELECT
                CONCAT_WS(' ', IFNULL(UCASE(usu_nombre), ''), IFNULL(UCASE(usu_paterno), ''), IFNULL(UCASE(usu_materno),'')) AS usu_nombrecompleto,
	            CONCAT_WS(' ', IFNULL(UCASE(rol.rol_nombre), 'Sin rol asignado'), IFNULL(CONCAT('-'), ' '), IFNULL(UCASE(sucursal.suc_nombre), '')) AS usu_informacion,
                usu_clave,
                uhd_nombre,
                uhd_huella
            FROM
                usuario USE INDEX(`PRIMARY`)
            LEFT JOIN
                usuxsuc USE INDEX(`PRIMARY`) 
                ON usuario.usu_num_ctrl = usuxsuc.usu_num_ctrl 
            LEFT JOIN
                sucursal USE INDEX(`PRIMARY`) 
                ON usuxsuc.suc_num_ctrl = sucursal.suc_num_ctrl
            LEFT JOIN
                usuxrol USE INDEX(`PRIMARY`) 
                ON usuario.usu_num_ctrl = usuxrol.usu_num_ctrl 
            LEFT JOIN
                rol USE INDEX(`PRIMARY`) 
                ON usuxrol.rol_num_ctrl = rol.rol_num_ctrl
            JOIN
                usuxhishid USE INDEX(`PRIMARY`) 
                ON usuario.usu_num_ctrl = usuxhishid.usu_num_ctrl 
            WHERE
                usuxsuc.suc_num_ctrl IN ($nSucNumCtrl) AND usuario.usu_estatus = :usu_estatus ";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":usu_estatus", Constantes::ALZ_ESTATUS_ACTIVO);

			$ps->execute();

			return $ps->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $PDOException) {

			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener usuarios, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);

		}
	}//obtenerTabla

	/**
	 * Obtiene el usuario que coincida con la clave
	 * @param $sUsuClave -> Clave del usuario
	 * @return array|false
	 */
	public static function obtenerUsuario($sUsuClave)
	{
		try {

			$sQuery = "SELECT
                            CONCAT_WS(' ', IFNULL(CONCAT(UCASE(LEFT(usu_nombre, 1)), LCASE(SUBSTRING(usu_nombre, 2))), ''), 
                            IFNULL(CONCAT(UCASE(LEFT(usu_paterno, 1)), LCASE(SUBSTRING(usu_paterno, 2))), ''), 
                            IFNULL(CONCAT(UCASE(LEFT(usu_materno, 1)), LCASE(SUBSTRING(usu_materno, 2))), '')) AS usu_nombrecompleto,
                            CONCAT_WS(' ', IFNULL(CONCAT(UCASE(LEFT(rol.rol_nombre, 1)), LCASE(SUBSTRING(rol.rol_nombre, 2))), 'Sin rol asignado'), 
                            IFNULL(CONCAT('-'), ' '), 
                            IFNULL(CONCAT(UCASE(LEFT(sucursal.suc_nombre, 1)), LCASE(SUBSTRING(sucursal.suc_nombre, 2))), '')) AS usu_informacion 
                        FROM
                            usuario USE INDEX(`PRIMARY`)
                        LEFT JOIN
                            usuxsuc USE INDEX(`PRIMARY`) 
                            ON usuario.usu_num_ctrl = usuxsuc.usu_num_ctrl 
                        LEFT JOIN
                            sucursal USE INDEX(`PRIMARY`) 
                            ON usuxsuc.suc_num_ctrl = sucursal.suc_num_ctrl
                        LEFT JOIN
                            usuxrol USE INDEX(`PRIMARY`) 
                            ON usuario.usu_num_ctrl = usuxrol.usu_num_ctrl 
                        LEFT JOIN
                            rol USE INDEX(`PRIMARY`) 
                            ON usuxrol.rol_num_ctrl = rol.rol_num_ctrl
                        WHERE
                            usuario.usu_clave = :usu_clave ";

			$ps = Utils::getInstance()->connectDB()->prepare($sQuery);

			$ps->bindValue(":usu_clave", $sUsuClave);

			$ps->execute();

			return $ps->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $PDOException) {
			if ($PDOException->getMessage() <> "")
				throw new PDOException($PDOException->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			else
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener usuario información, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
		}
	}//obtenerUsuario
}//Usuario