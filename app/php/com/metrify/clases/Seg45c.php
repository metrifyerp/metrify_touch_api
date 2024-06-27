<?php
date_default_timezone_set ("America/Monterrey");

/**
 * Asistencia
 * Class Seg45_1m
 */
class Seg45c
{
	/**
	 * Carga la datatable de la vista principal
	 * @param $usuNumCtrl Int Número de control del usuario.
	 * @param $dtFechaHora DateTime Fecha y hora a validar.
	 * @return int Número de registro 0 = Usuario sin horario para la fecha seleccionada, 1 = Entrada, 2 = Salida Desc., 3 = Entrada Desc., 4 = Salida.
	 */
	public static function horxdetObtenerRegistro($usuNumCtrl, $dtFechaHora)
	{
		try {
			$Seg42DAO = new Seg42DAO();

			//Obtenemos el día de la semana primero obteniendo el timestamp de la fecha y hora.
			$tsFechaHora = strtotime($dtFechaHora->format('Y-m-d H:i:s'));
			$diaSemana = date("N", $tsFechaHora);
			$sFecha = date_format($dtFechaHora, 'Y-m-d');

			$oHorxDet = $Seg42DAO->obtenerHorarioxUsuario($usuNumCtrl, $diaSemana, $sFecha);

			//No se encontro un horario en la fecha definida.
			if ($oHorxDet == false) {
				return 0;
			}

			//Validamos si el horario tiene descanso.
			if ($oHorxDet->hxd_descanso == 1) { //El horario tiene descansos.

				//Obtenemos los DateTime del horario.
				$dtHxdEntrada = new DateTime($oHorxDet->hxd_entrada);
				$dtHxdSalidaDesc = new DateTime($oHorxDet->hxd_salida_desc);
				$dtHxdEntradaDesc = new DateTime($oHorxDet->hxd_entrada_desc);
				$dtHxdSalida = new DateTime($oHorxDet->hxd_salida);

				//Convertimos los DateTime del horario a int.
				$iEntrada = strtotime($dtHxdEntrada->format('Y-m-d H:i:s'));
				$iSalidaDesc = strtotime($dtHxdSalidaDesc->format('Y-m-d H:i:s'));
				$iEntradaDesc = strtotime($dtHxdEntradaDesc->format('Y-m-d H:i:s'));
				$iSalida = strtotime($dtHxdSalida->format('Y-m-d H:i:s'));

				//Obtenemos las diferencias en minutos entre las diferentes horas del horario.
				$difEntradaSalidaDesc = round((abs($iSalidaDesc - $iEntrada) / 60 / 2));
				$difEntradaDescSalidaDesc = round((abs($iEntradaDesc - $iSalidaDesc) / 60 / 2));
				$difEntradaDescSalida = round((abs($iSalida - $iEntradaDesc) / 60 / 2));

				//Creamos los TimeIntervals para crear los rangos del horario.
				//Mitad de los min. de diferencia entre Entrada y Salida Desc.
				$diEntradaSalidaDesc = new DateInterval('PT' . $difEntradaSalidaDesc . 'M');
				//Mitad de los min. de diferencia entre Entrada Desc. y Salida Desc.
				$diEntradaDescSalidaDesc = new DateInterval('PT' . $difEntradaDescSalidaDesc . 'M');
				//Mitad de los min. de diferencia entre Entrada Desc. y Salida.
				$diEntradaDescSalida = new DateInterval('PT' . $difEntradaDescSalida . 'M');

				//Clonamos los DateTime para obtener los rangos del horario.
				$dtHxdEntradaFin = clone $dtHxdEntrada;
				$dtHxdSalidaDescFin = clone $dtHxdSalidaDesc;
				$dtHxdEntradaDescFin = clone $dtHxdEntradaDesc;

				//Ajustamos los rangos sumando y restando los minutos correspondientes.
				$dtHxdEntradaFin->add($diEntradaSalidaDesc);
				$dtHxdSalidaDescFin->add($diEntradaDescSalidaDesc);
				$dtHxdEntradaDescFin->add($diEntradaDescSalida);

				//Al crear los rangos se dividio el horario laboral para poder identificar el registro.
				if ($dtFechaHora < $dtHxdEntradaFin) {
					$nRegistro = 1; //Entrada
				} elseif ($dtFechaHora < $dtHxdSalidaDescFin) {
					$nRegistro = 2; //Salida Desc.
				} elseif ($dtFechaHora < $dtHxdEntradaDescFin) {
					$nRegistro = 3; //Entrada Desc.
				} else {
					$nRegistro = 4; //Salida
				}
			} else { //El horario no tiene descansos.

				//Obtenemos el DateTime de entrada del horario.
				$dtHxdEntrada = new DateTime($oHorxDet->hxd_entrada);
				$dtHxdSalida = new DateTime($oHorxDet->hxd_salida);

				//Convertimos los DateTime del horario a int.
				$iEntrada = strtotime($dtHxdEntrada->format('Y-m-d H:i:s'));
				$iSalida = strtotime($dtHxdSalida->format('Y-m-d H:i:s'));

				//Obtenemos las diferencias en minutos entre las diferentes horas del horario.
				$difEntradaSalida = round((abs($iSalida - $iEntrada) / 60 / 2));

				//Creamos el TimeIntervals para crear el rango del horario.
				//Mitad de los min. de diferencia entre Entrada y Salida.
				$diEntradaSalida = new DateInterval('PT' . $difEntradaSalida . 'M');

				//Clonamos el DateTime para obtener los rangos del horario.
				$dtHxdEntradaFin = clone $dtHxdEntrada;

				//Ajustamos los rangos sumando y restando los minutos correspondientes.
				$dtHxdEntradaFin->add($diEntradaSalida);

				//Al crear el rango se dividio el horario laboral para poder identificar el registro.
				if ($dtFechaHora < $dtHxdEntradaFin) {
					$nRegistro = 1;//Entrada
				} else {
					$nRegistro = 4;//Salida
				}
			}

			return $nRegistro;

		} catch (PDOException|Exception $Exception) {
			if ($Exception->getMessage() <> "") {
				throw new PDOException($Exception->getMessage(), Constantes::LOG_TIPOERROR_FATALERROR);
			} else {
				throw new PDOException(Constantes::LOG_ERROR_FATAL_ERROR . " - Obtener detalle horario, " . Constantes::LOG_MSG_ERROR_TRANSACCION, Constantes::LOG_TIPOERROR_FATALERROR);
			}
		}
	}//horxdetObtenerRegistro
}//Seg45c