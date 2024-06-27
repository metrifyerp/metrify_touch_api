<?php
/**
 * Dato Control
 * Class Seg15_1m
 */
class Seg15_1m
{
	private $ctr_num_ctrl;
	private $ent_num_ctrl;
	private $ctr_origen;
	private $ctr_actividad;
	private $usu_num_ctrl;
	private $ctr_fechora;
	private $ctr_observa;


	/**
	 * Número de control del dato de control
	 * @return mixed
	 */
	public function getCtrNumCtrl()
	{
		return $this->ctr_num_ctrl;
	}

	/**
	 * Número de control del dato de control
	 * @param mixed $ctr_num_ctrl Número de control del dato de control
	 * @return Seg15_1m
	 */
	public function setCtrNumCtrl($ctr_num_ctrl)
	{
		$this->ctr_num_ctrl = $ctr_num_ctrl;
		return $this;
	}

	/**
	 * Número de control de la entidad
	 * @return mixed
	 */
	public function getEntNumCtrl()
	{
		return $this->ent_num_ctrl;
	}

	/**
	 * Número de control de la entidad
	 * @param mixed $ent_num_ctrl Número de control de la entidad
	 * @return Seg15_1m
	 */
	public function setEntNumCtrl($ent_num_ctrl)
	{
		$this->ent_num_ctrl = $ent_num_ctrl;
		return $this;
	}

	/**
	 * Número de control del registro origen
	 * @return mixed
	 */
	public function getCtrOrigen()
	{
		return $this->ctr_origen;
	}

	/**
	 * Número de control del registro origen
	 * @param mixed $ctr_origen Número de control del registro origen
	 * @return Seg15_1m
	 */
	public function setCtrOrigen($ctr_origen)
	{
		$this->ctr_origen = $ctr_origen;
		return $this;
	}

	/**
	 * Tipo de actividad realizada(tomada de VALXCAM)
	 * @return mixed
	 */
	public function getCtrActividad()
	{
		return $this->ctr_actividad;
	}

	/**
	 * Tipo de actividad realizada(tomada de VALXCAM)
	 * @param mixed $ctr_actividad Tipo de actividad realizada(tomada de VALXCAM)
	 * @return Seg15_1m
	 */
	public function setCtrActividad($ctr_actividad)
	{
		$this->ctr_actividad = $ctr_actividad;
		return $this;
	}

	/**
	 * Número de control del usuario que realizó la actividad
	 * @return mixed
	 */
	public function getUsuNumCtrl()
	{
		return $this->usu_num_ctrl;
	}

	/**
	 * Número de control del usuario que realizó la actividad
	 * @param mixed $usu_num_ctrl Número de control del usuario que realizó la actividad
	 * @return Seg15_1m
	 */
	public function setUsuNumCtrl($usu_num_ctrl)
	{
		$this->usu_num_ctrl = $usu_num_ctrl;
		return $this;
	}

	/**
	 * Fecha y hora de la actividad
	 * @return mixed
	 */
	public function getCtrFechora()
	{
		return $this->ctr_fechora;
	}

	/**
	 * Fecha y hora de la actividad
	 * @param mixed $ctr_fechora Fecha y hora de la actividad
	 * @return Seg15_1m
	 */
	public function setCtrFechora($ctr_fechora)
	{
		$this->ctr_fechora = $ctr_fechora;
		return $this;
	}

	/**
	 * Observaciones de la actividad realizada
	 * @return mixed
	 */
	public function getCtrObserva()
	{
		return $this->ctr_observa;
	}

	/**
	 * Observaciones de la actividad realizada
	 * @param mixed $ctr_observa Observaciones de la actividad realizada
	 * @return Seg15_1m
	 */
	public function setCtrObserva($ctr_observa)
	{
		$this->ctr_observa = $ctr_observa;
		return $this;
	}
}//Dato Control