<?php
/**
 * Sucursal
 * Class Erp03_1m
 */
class Erp03_1m
{
	private $suc_num_ctrl;
	private $suc_clave;
	private $suc_nombre;
	private $suc_calle;
	private $suc_numero_exterior;
	private $suc_colonia;
	private $suc_ciudad;
	private $suc_principal;
	private $emp_num_ctrl;
	private $est_num_ctrl;
	private $suc_serie;
	private $suc_telefono;
	private $suc_hora_entrada;
	private $suc_hora_salida;
	private $suc_estatus;
	private $cpo_num_ctrl;
	private $suc_orden;
	private $axp_num_ctrl;

	/**Número de control de la sucursal
	 * @return mixed
	 */
	public function getSucNumCtrl()
	{
		return $this->suc_num_ctrl;
	}

	/**Número de control de la sucursal
	 * @param mixed $suc_num_ctrl Número de control de la sucursal
	 * @return Erp03_1m
	 */
	public function setSucNumCtrl($suc_num_ctrl)
	{
		$this->suc_num_ctrl = $suc_num_ctrl;
		return $this;
	}

	/**Clave de la sucursal
	 * @return mixed
	 */
	public function getSucClave()
	{
		return $this->suc_clave;
	}

	/**Clave de la sucursal
	 * @param mixed $suc_clave Clave de la sucursal
	 * @return Erp03_1m
	 */
	public function setSucClave($suc_clave)
	{
		$this->suc_clave = $suc_clave;
		return $this;
	}

	/**Nombre de la sucursal
	 * @return mixed
	 */
	public function getSucNombre()
	{
		return $this->suc_nombre;
	}

	/**Nombre de la sucursal
	 * @param mixed $suc_nombre Nombre de la sucursal
	 * @return Erp03_1m
	 */
	public function setSucNombre($suc_nombre)
	{
		$this->suc_nombre = $suc_nombre;
		return $this;
	}

	/**Dirección o calle de la sucursal en donde radica actualmente
	 * @return mixed
	 */
	public function getSucCalle()
	{
		return $this->suc_calle;
	}

	/**Dirección o calle de la sucursal en donde radica actualmente
	 * @param mixed $suc_calle Dirección o calle de la sucursal en donde radica actualmente
	 * @return Erp03_1m
	 */
	public function setSucCalle($suc_calle)
	{
		$this->suc_calle = $suc_calle;
		return $this;
	}

	/**Los números exterior e interior de un domicilio están asociados a la nomenclatura urbana
	 * @return mixed
	 */
	public function getSucNumeroExterior()
	{
		return $this->suc_numero_exterior;
	}

	/**Los números exterior e interior de un domicilio están asociados a la nomenclatura urbana
	 * @param mixed $suc_numero_exterior Los números exterior e interior de un domicilio están asociados a la
	 * nomenclatura urbana
	 * @return Erp03_1m
	 */
	public function setSucNumeroExterior($suc_numero_exterior)
	{
		$this->suc_numero_exterior = $suc_numero_exterior;
		return $this;
	}

	/**Colonia de la sucursal en donde radica actualmente
	 * @return mixed
	 */
	public function getSucColonia()
	{
		return $this->suc_colonia;
	}

	/**Colonia de la sucursal en donde radica actualmente
	 * @param mixed $suc_colonia Colonia de la sucursal en donde radica actualmente
	 * @return Erp03_1m
	 */
	public function setSucColonia($suc_colonia)
	{
		$this->suc_colonia = $suc_colonia;
		return $this;
	}

	/**Ciudad de la sucursal en donde radica actualmente
	 * @return mixed
	 */
	public function getSucCiudad()
	{
		return $this->suc_ciudad;
	}

	/**Ciudad de la sucursal en donde radica actualmente
	 * @param mixed $suc_ciudad Ciudad de la sucursal en donde radica actualmente
	 * @return Erp03_1m
	 */
	public function setSucCiudad($suc_ciudad)
	{
		$this->suc_ciudad = $suc_ciudad;
		return $this;
	}

	/**Sucursal con prioridad para autogenerar todos los folios que existen
	 * @return mixed
	 */
	public function getSucPrincipal()
	{
		return $this->suc_principal;
	}

	/**Sucursal con prioridad para autogenerar todos los folios que existen
	 * @param mixed $suc_principal Sucursal con prioridad para autogenerar todos los folios que existen
	 * @return Erp03_1m
	 */
	public function setSucPrincipal($suc_principal)
	{
		$this->suc_principal = $suc_principal;
		return $this;
	}

	/**Número de control de la empresa
	 * @return mixed
	 */
	public function getEmpNumCtrl()
	{
		return $this->emp_num_ctrl;
	}

	/**Número de control de la empresa
	 * @param mixed $emp_num_ctrl Número de control de la empresa
	 * @return Erp03_1m
	 */
	public function setEmpNumCtrl($emp_num_ctrl)
	{
		$this->emp_num_ctrl = $emp_num_ctrl;
		return $this;
	}

	/**Número de control del estado en donde radica actualmente
	 * @return mixed
	 */
	public function getEstNumCtrl()
	{
		return $this->est_num_ctrl;
	}

	/**Número de control del estado en donde radica actualmente
	 * @param mixed $est_num_ctrl Número de control del estado en donde radica actualmente
	 * @return Erp03_1m
	 */
	public function setEstNumCtrl($est_num_ctrl)
	{
		$this->est_num_ctrl = $est_num_ctrl;
		return $this;
	}

	/**Letra serie para la facturación
	 * @return mixed
	 */
	public function getSucSerie()
	{
		return $this->suc_serie;
	}

	/**Letra serie para la facturación
	 * @param mixed $suc_serie Letra serie para la facturación
	 * @return Erp03_1m
	 */
	public function setSucSerie($suc_serie)
	{
		$this->suc_serie = $suc_serie;
		return $this;
	}

	/**Número de teléfono de la suscursal
	 * @return mixed
	 */
	public function getSucTelefono()
	{
		return $this->suc_telefono;
	}

	/**Número de teléfono de la suscursal
	 * @param mixed $suc_telefono Número de teléfono de la suscursal
	 * @return Erp03_1m
	 */
	public function setSucTelefono($suc_telefono)
	{
		$this->suc_telefono = $suc_telefono;
		return $this;
	}

	/**Hora de entrada de la sucursal
	 * @return mixed
	 */
	public function getSucHoraEntrada()
	{
		return $this->suc_hora_entrada;
	}

	/**Hora de entrada de la sucursal
	 * @param mixed $suc_hora_entrada Hora de entrada de la sucursal
	 * @return Erp03_1m
	 */
	public function setSucHoraEntrada($suc_hora_entrada)
	{
		$this->suc_hora_entrada = $suc_hora_entrada;
		return $this;
	}

	/**Hora de salida de la sucursal
	 * @return mixed
	 */
	public function getSucHoraSalida()
	{
		return $this->suc_hora_salida;
	}

	/**Hora de salida de la sucursal
	 * @param mixed $suc_hora_salida Hora de salida de la sucursal
	 * @return Erp03_1m
	 */
	public function setSucHoraSalida($suc_hora_salida)
	{
		$this->suc_hora_salida = $suc_hora_salida;
		return $this;
	}

	/**
	 * Estatus de la sucursa
	 * @return mixed
	 */
	public function getSucEstatus()
	{
		return $this->suc_estatus;
	}

	/**
	 * Estatus de la sucursa
	 * @param mixed $suc_estatus
	 * @return Erp03_1m
	 */
	public function setSucEstatus($suc_estatus)
	{
		$this->suc_estatus = $suc_estatus;
		return $this;
	}

	/**
	 * Numero de control del codigo postal de la sucursal
	 * @return mixed
	 */
	public function getCpoNumCtrl()
	{
		return $this->cpo_num_ctrl;
	}

	/**
	 * Numero de control del codigo postal de la sucursal
	 * @param mixed $cpo_num_ctrl
	 * @return Erp03_1m
	 */
	public function setCpoNumCtrl($cpo_num_ctrl)
	{
		$this->cpo_num_ctrl = $cpo_num_ctrl;
		return $this;
	}

	/**
	 * Orden en que sera tomado para mostrar la sucursal en reportes, etc.
	 * @return mixed
	 */
	public function getSucOrden()
	{
		return $this->suc_orden;
	}

	/**
	 * Orden en que sera tomado para mostrar la sucursal en reportes, etc.
	 * @param mixed $suc_orden
	 * @return Erp03_1m
	 */
	public function setSucOrden($suc_orden)
	{
		$this->suc_orden = $suc_orden;
		return $this;
	}

	/**
	 * Número de control del precio de lista
	 * @return mixed
	 */
	public function getAxpNumCtrl()
	{
		return $this->axp_num_ctrl;
	}

	/**
	 * Número de control del precio de lista
	 * @param mixed $axp_num_ctrl
	 * @return Erp03_1m
	 */
	public function setAxpNumCtrl($axp_num_ctrl)
	{
		$this->axp_num_ctrl = $axp_num_ctrl;
		return $this;
	}

}//Sucursal