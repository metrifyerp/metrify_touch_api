<?php
/**
 * Entidad
 * Class Seg09_1m
 */
class Seg09_1m
{
	private $ent_num_ctrl;
	private $ent_clave;
	private $ent_nombre;
	private $ent_descripcion;
	private $ent_inicial;

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
	 * @return Seg09_1m
	 */
	public function setEntNumCtrl($ent_num_ctrl)
	{
		$this->ent_num_ctrl = $ent_num_ctrl;
		return $this;
	}

	/**
	 * Clave de la entidad
	 * @return mixed
	 */
	public function getEntClave()
	{
		return $this->ent_clave;
	}

	/**
	 * Clave de la entidad
	 * @param mixed $ent_clave Clave de la entidad
	 * @return Seg09_1m
	 */
	public function setEntClave($ent_clave)
	{
		$this->ent_clave = $ent_clave;
		return $this;
	}

	/**
	 * Nombre de la entidad
	 * @return mixed
	 */
	public function getEntNombre()
	{
		return $this->ent_nombre;
	}

	/**
	 * Nombre de la entidad
	 * @param mixed $ent_nombre Nombre de la entidad
	 * @return Seg09_1m
	 */
	public function setEntNombre($ent_nombre)
	{
		$this->ent_nombre = $ent_nombre;
		return $this;
	}

	/**
	 * Descripción de la entidad
	 * @return mixed
	 */
	public function getEntDescripcion()
	{
		return $this->ent_descripcion;
	}

	/**
	 * Descripción de la entidad
	 * @param mixed $ent_descripcion Descripción de la entidad
	 * @return Seg09_1m
	 */
	public function setEntDescripcion($ent_descripcion)
	{
		$this->ent_descripcion = $ent_descripcion;
		return $this;
	}

	/**
	 * Iniciales de la entidad
	 * @return mixed
	 */
	public function getEntInicial()
	{
		return $this->ent_inicial;
	}

	/**
	 * Iniciales de la entidad
	 * @param mixed $ent_inicial Iniciales de la entidad
	 * @return Seg09_1m
	 */
	public function setEntInicial($ent_inicial)
	{
		$this->ent_inicial = $ent_inicial;
		return $this;
	}

}//Entidad