<?php

/**
 * Asistencia
 * Class Seg40_1m
 */
class Seg40_1m
{
	private $asi_num_ctrl;
	private $asi_fecha;
	private $arg_entrada;
	private $arg_salida_desc;
	private $arg_entrada_desc;
	private $arg_salida;
	private $asi_hor_entrada;
	private $asi_hor_salida_desc;
	private $asi_hor_entrada_desc;
	private $asi_hor_salida;
	private $asi_hor_descanso;
	private $asi_hor_tolerancia;
	private $usu_num_ctrl;

	/**
	 * @return mixed
	 */
	public function getAsiNumCtrl()
	{
		return $this->asi_num_ctrl;
	}

	/**
	 * @param mixed $asi_num_ctrl
	 * @return Seg40_1m
	 */
	public function setAsiNumCtrl($asi_num_ctrl)
	{
		$this->asi_num_ctrl = $asi_num_ctrl;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiFecha()
	{
		return $this->asi_fecha;
	}

	/**
	 * @param mixed $asi_fecha
	 * @return Seg40_1m
	 */
	public function setAsiFecha($asi_fecha)
	{
		$this->asi_fecha = $asi_fecha;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArgEntrada()
	{
		return $this->arg_entrada;
	}

	/**
	 * @param mixed $arg_entrada
	 * @return Seg40_1m
	 */
	public function setArgEntrada($arg_entrada)
	{
		$this->arg_entrada = $arg_entrada;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArgSalidaDesc()
	{
		return $this->arg_salida_desc;
	}

	/**
	 * @param mixed $arg_salida_desc
	 * @return Seg40_1m
	 */
	public function setArgSalidaDesc($arg_salida_desc)
	{
		$this->arg_salida_desc = $arg_salida_desc;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArgEntradaDesc()
	{
		return $this->arg_entrada_desc;
	}

	/**
	 * @param mixed $arg_entrada_desc
	 * @return Seg40_1m
	 */
	public function setArgEntradaDesc($arg_entrada_desc)
	{
		$this->arg_entrada_desc = $arg_entrada_desc;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArgSalida()
	{
		return $this->arg_salida;
	}

	/**
	 * @param mixed $arg_salida
	 * @return Seg40_1m
	 */
	public function setArgSalida($arg_salida)
	{
		$this->arg_salida = $arg_salida;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiHorEntrada()
	{
		return $this->asi_hor_entrada;
	}

	/**
	 * @param mixed $asi_hor_entrada
	 * @return Seg40_1m
	 */
	public function setAsiHorEntrada($asi_hor_entrada)
	{
		$this->asi_hor_entrada = $asi_hor_entrada;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiHorSalidaDesc()
	{
		return $this->asi_hor_salida_desc;
	}

	/**
	 * @param mixed $asi_hor_salida_desc
	 * @return Seg40_1m
	 */
	public function setAsiHorSalidaDesc($asi_hor_salida_desc)
	{
		$this->asi_hor_salida_desc = $asi_hor_salida_desc;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiHorEntradaDesc()
	{
		return $this->asi_hor_entrada_desc;
	}

	/**
	 * @param mixed $asi_hor_entrada_desc
	 * @return Seg40_1m
	 */
	public function setAsiHorEntradaDesc($asi_hor_entrada_desc)
	{
		$this->asi_hor_entrada_desc = $asi_hor_entrada_desc;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiHorSalida()
	{
		return $this->asi_hor_salida;
	}

	/**
	 * @param mixed $asi_hor_salida
	 * @return Seg40_1m
	 */
	public function setAsiHorSalida($asi_hor_salida)
	{
		$this->asi_hor_salida = $asi_hor_salida;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiHorDescanso()
	{
		return $this->asi_hor_descanso;
	}

	/**
	 * @param mixed $asi_hor_descanso
	 * @return Seg40_1m
	 */
	public function setAsiHorDescanso($asi_hor_descanso)
	{
		$this->asi_hor_descanso = $asi_hor_descanso;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAsiHorTolerancia()
	{
		return $this->asi_hor_tolerancia;
	}

	/**
	 * @param mixed $asi_hor_tolerancia
	 * @return Seg40_1m
	 */
	public function setAsiHorTolerancia($asi_hor_tolerancia)
	{
		$this->asi_hor_tolerancia = $asi_hor_tolerancia;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUsuNumCtrl()
	{
		return $this->usu_num_ctrl;
	}

	/**
	 * @param mixed $usu_num_ctrl
	 * @return Seg40_1m
	 */
	public function setUsuNumCtrl($usu_num_ctrl)
	{
		$this->usu_num_ctrl = $usu_num_ctrl;
		return $this;
	}
}