<?php

/**
 * Usuario
 * Class Erp01_1m
 */
class Erp01_1m
{
	private $usu_num_ctrl;
	private $usu_clave;
	private $usu_email;
	private $usu_nombre;
	private $usu_paterno;
	private $usu_materno;
	private $usu_sexo;
	private $usu_pwd;
	private $usu_estatus;
	private $usu_telefono;
	private $usu_calle;
	private $usu_numero_exterior;
	private $usu_colonia;
	private $usu_ciudad;
	private $usu_numero_segsocial;
	private $usu_huella_digital;
	private $usu_contacto;
	private $usu_contacto_parentesco;
	private $usu_contacto_telefono;
	private $usu_archivo;
	private $uhd_num_ctrl;
	private $uhd_nombre;
	private $uhd_fecha;
	private $suc_num_ctrl;

	/**
	 * @return mixed
	 */
	public function getSucNumCtrl()
	{
		return $this->suc_num_ctrl;
	}

	/**
	 * @param mixed $suc_num_ctrl
	 * @return Erp01_1m
	 */
	public function setSucNumCtrl($suc_num_ctrl)
	{
		$this->suc_num_ctrl = $suc_num_ctrl;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUhdNumCtrl()
	{
		return $this->uhd_num_ctrl;
	}

	/**
	 * @param mixed $uhd_num_ctrl
	 * @return Erp01_1m
	 */
	public function setUhdNumCtrl($uhd_num_ctrl)
	{
		$this->uhd_num_ctrl = $uhd_num_ctrl;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUhdNombre()
	{
		return $this->uhd_nombre;
	}

	/**
	 * @param mixed $uhd_nombre
	 * @return Erp01_1m
	 */
	public function setUhdNombre($uhd_nombre)
	{
		$this->uhd_nombre = $uhd_nombre;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUhdFecha()
	{
		return $this->uhd_fecha;
	}

	/**
	 * @param mixed $uhd_fecha
	 * @return Erp01_1m
	 */
	public function setUhdFecha($uhd_fecha)
	{
		$this->uhd_fecha = $uhd_fecha;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUhdHuella()
	{
		return $this->uhd_huella;
	}

	/**
	 * @param mixed $uhd_huella
	 * @return Erp01_1m
	 */
	public function setUhdHuella($uhd_huella)
	{
		$this->uhd_huella = $uhd_huella;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUhdHuellaimg()
	{
		return $this->uhd_huellaimg;
	}

	/**
	 * @param mixed $uhd_huellaimg
	 * @return Erp01_1m
	 */
	public function setUhdHuellaimg($uhd_huellaimg)
	{
		$this->uhd_huellaimg = $uhd_huellaimg;
		return $this;
	}

	private $uhd_huella;
	private $uhd_huellaimg;


	/**
	 * Número de control del usuario
	 * @return mixed
	 */
	public function getUsuNumCtrl()
	{
		return $this->usu_num_ctrl;
	}

	/**
	 * Número de control del usuario
	 * @param mixed $usu_num_ctrl Número de control del usuario
	 * @return Erp01_1m
	 */
	public function setUsuNumCtrl($usu_num_ctrl)
	{
		$this->usu_num_ctrl = $usu_num_ctrl;
		return $this;
	}

	/**
	 * Clave del usuario
	 * @return mixed
	 */
	public function getUsuClave()
	{
		return $this->usu_clave;
	}

	/**
	 * Clave del usuario
	 * @param mixed $usu_clave Clave del usuario
	 * @return Erp01_1m
	 */
	public function setUsuClave($usu_clave)
	{
		$this->usu_clave = $usu_clave;
		return $this;
	}

	/**
	 * Correo electrónico del usuario
	 * @return mixed
	 */
	public function getUsuEmail()
	{
		return $this->usu_email;
	}

	/**
	 * Correo electrónico del usuario
	 * @param mixed $usu_email Correo electrónico del usuario
	 * @return Erp01_1m
	 */
	public function setUsuEmail($usu_email)
	{
		$this->usu_email = $usu_email;
		return $this;
	}

	/**
	 * Nombre del usuario
	 * @return mixed
	 */
	public function getUsuNombre()
	{
		return $this->usu_nombre;
	}

	/**
	 * Nombre del usuario
	 * @param mixed $usu_nombre Nombre del usuario
	 * @return Erp01_1m
	 */
	public function setUsuNombre($usu_nombre)
	{
		$this->usu_nombre = $usu_nombre;
		return $this;
	}

	/**
	 * Apellido paterno del usuario
	 * @return mixed
	 */
	public function getUsuPaterno()
	{
		return $this->usu_paterno;
	}

	/**
	 * Apellido paterno del usuario
	 * @param mixed $usu_paterno Apellido paterno del usuario
	 * @return Erp01_1m
	 */
	public function setUsuPaterno($usu_paterno)
	{
		$this->usu_paterno = $usu_paterno;
		return $this;
	}

	/**
	 * Apellido materno del usuario
	 * @return mixed
	 */
	public function getUsuMaterno()
	{
		return $this->usu_materno;
	}

	/**
	 * Apellido materno del usuario
	 * @param mixed $usu_materno Apellido materno del usuario
	 * @return Erp01_1m
	 */
	public function setUsuMaterno($usu_materno)
	{
		$this->usu_materno = $usu_materno;
		return $this;
	}

	/**
	 * Sexo del usuario
	 * @return mixed
	 */
	public function getUsuSexo()
	{
		return $this->usu_sexo;
	}

	/**
	 * Sexo del usuario
	 * @param mixed $usu_sexo Sexo del usuario
	 * @return Erp01_1m
	 */
	public function setUsuSexo($usu_sexo)
	{
		$this->usu_sexo = $usu_sexo;
		return $this;
	}

	/**
	 * Contraseña de acceso al sistema del usuario
	 * @return mixed
	 */
	public function getUsuPwd()
	{
		return $this->usu_pwd;
	}

	/**
	 * Contraseña de acceso al sistema del usuario
	 * @param mixed $usu_pwd Contraseña de acceso al sistema del usuario
	 * @return Erp01_1m
	 */
	public function setUsuPwd($usu_pwd)
	{
		$this->usu_pwd = $usu_pwd;
		return $this;
	}

	/**
	 * Estatus del usuario
	 * @return mixed
	 */
	public function getUsuEstatus()
	{
		return $this->usu_estatus;
	}

	/**
	 * Estatus del usuario
	 * @param mixed $usu_estatus Estatus del usuario
	 * @return Erp01_1m
	 */
	public function setUsuEstatus($usu_estatus)
	{
		$this->usu_estatus = $usu_estatus;
		return $this;
	}

	/**
	 * Teléfono del usuario
	 * @return mixed
	 */
	public function getUsuTelefono()
	{
		return $this->usu_telefono;
	}

	/**
	 * Teléfono del usuario
	 * @param mixed $usu_telefono Teléfono del usuario
	 * @return Erp01_1m
	 */
	public function setUsuTelefono($usu_telefono)
	{
		$this->usu_telefono = $usu_telefono;
		return $this;
	}

	/**
	 * Dirección del usuario
	 * @return mixed
	 */
	public function getUsuCalle()
	{
		return $this->usu_calle;
	}

	/**
	 * Dirección del usuario
	 * @param mixed $usu_calle Dirección del usuario
	 * @return Erp01_1m
	 */
	public function setUsuCalle($usu_calle)
	{
		$this->usu_calle = $usu_calle;
		return $this;
	}

	/**
	 * Numero exterior de la vivienda del usuario
	 * @return mixed
	 */
	public function getUsuNumeroExterior()
	{
		return $this->usu_numero_exterior;
	}

	/**
	 * Numero exterior de la vivienda del usuario
	 * @param mixed $usu_numero_exterior Numero exterior de la vivienda del usuario
	 * @return Erp01_1m
	 */
	public function setUsuNumeroExterior($usu_numero_exterior)
	{
		$this->usu_numero_exterior = $usu_numero_exterior;
		return $this;
	}

	/**
	 * Colonia de la vivienda del usuario
	 * @return mixed
	 */
	public function getUsuColonia()
	{
		return $this->usu_colonia;
	}

	/**
	 * Colonia de la vivienda del usuario
	 * @param mixed $usu_colonia Colonia de la vivienda del usuario
	 * @return Erp01_1m
	 */
	public function setUsuColonia($usu_colonia)
	{
		$this->usu_colonia = $usu_colonia;
		return $this;
	}

	/**
	 * Ciudad de la vivienda del usuario
	 * @return mixed
	 */
	public function getUsuCiudad()
	{
		return $this->usu_ciudad;
	}

	/**
	 * Ciudad de la vivienda del usuario
	 * @param mixed $usu_ciudad Ciudad de la vivienda del usuario
	 * @return Erp01_1m
	 */
	public function setUsuCiudad($usu_ciudad)
	{
		$this->usu_ciudad = $usu_ciudad;
		return $this;
	}

	/**
	 * Seguro social del usuario
	 * @return mixed
	 */
	public function getUsuNumeroSegsocial()
	{
		return $this->usu_numero_segsocial;
	}

	/**
	 * Seguro social del usuario
	 * @param mixed $usu_numero_segsocial Seguro social del usuario
	 * @return Erp01_1m
	 */
	public function setUsuNumeroSegsocial($usu_numero_segsocial)
	{
		$this->usu_numero_segsocial = $usu_numero_segsocial;
		return $this;
	}

	/**
	 * Huella digital del usuario
	 * @return mixed
	 */
	public function getUsuHuellaDigital()
	{
		return $this->usu_huella_digital;
	}

	/**
	 * Huella digital del usuario
	 * @param mixed $usu_huella_digital Huella digital del usuario
	 * @return Erp01_1m
	 */
	public function setUsuHuellaDigital($usu_huella_digital)
	{
		$this->usu_huella_digital = $usu_huella_digital;
		return $this;
	}

	/**
	 * Contacto en caso de emergencia del usuario
	 * @return mixed
	 */
	public function getUsuContacto()
	{
		return $this->usu_contacto;
	}

	/**
	 * Contacto en caso de emergencia del usuario
	 * @param mixed $usu_contacto Contacto en caso de emergencia del usuario
	 * @return Erp01_1m
	 */
	public function setUsuContacto($usu_contacto)
	{
		$this->usu_contacto = $usu_contacto;
		return $this;
	}

	/**
	 * Parentesco del contacto en caso de emergencia del usuario
	 * @return mixed
	 */
	public function getUsuContactoParentesco()
	{
		return $this->usu_contacto_parentesco;
	}

	/**
	 * Parentesco del contacto en caso de emergencia del usuario
	 * @param mixed $usu_contacto_parentesco Parentesco del contacto en caso de emergencia del usuario
	 * @return Erp01_1m
	 */
	public function setUsuContactoParentesco($usu_contacto_parentesco)
	{
		$this->usu_contacto_parentesco = $usu_contacto_parentesco;
		return $this;
	}

	/**
	 * Teléfono del contacto en caso de emergencia del usuario
	 * @return mixed
	 */
	public function getUsuContactoTelefono()
	{
		return $this->usu_contacto_telefono;
	}

	/**
	 * Teléfono del contacto en caso de emergencia del usuario
	 * @param mixed $usu_contacto_telefono
	 * @return Erp01_1m
	 */
	public function setUsuContactoTelefono($usu_contacto_telefono)
	{
		$this->usu_contacto_telefono = $usu_contacto_telefono;
		return $this;
	}

	/**
	 * Archivos del usuario
	 * @return mixed
	 */
	public function getUsuArchivo()
	{
		return $this->usu_archivo;
	}

	/**
	 * Archivos del usuario
	 * @param mixed $usu_archivo
	 * @return Erp01_1m
	 */
	public function setUsuArchivo($usu_archivo)
	{
		$this->usu_archivo = $usu_archivo;
		return $this;
	}

}//Usuario