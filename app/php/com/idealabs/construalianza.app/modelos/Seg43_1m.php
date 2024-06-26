<?php

/**
 * AsixReg
 * Class Seg43_1m
 */
class Seg43_1m
{
    private $arg_num_ctrl;
    private $arg_hora;
    private $arg_tipo;
    private $arg_observacion;
    private $suc_num_ctrl;

    /**
     * @return mixed
     */
    public function getArgNumCtrl()
    {
        return $this->arg_num_ctrl;
    }

    /**
     * @param mixed $arg_num_ctrl
     * @return Seg43_1m
     */
    public function setArgNumCtrl($arg_num_ctrl)
    {
        $this->arg_num_ctrl = $arg_num_ctrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArgHora()
    {
        return $this->arg_hora;
    }

    /**
     * @param mixed $arg_hora
     * @return Seg43_1m
     */
    public function setArgHora($arg_hora)
    {
        $this->arg_hora = $arg_hora;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArgTipo()
    {
        return $this->arg_tipo;
    }

    /**
     * @param mixed $arg_tipo
     * @return Seg43_1m
     */
    public function setArgTipo($arg_tipo)
    {
        $this->arg_tipo = $arg_tipo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArgObservacion()
    {
        return $this->arg_observacion;
    }

    /**
     * @param mixed $arg_observacion
     * @return Seg43_1m
     */
    public function setArgObservacion($arg_observacion)
    {
        $this->arg_observacion = $arg_observacion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSucNumCtrl()
    {
        return $this->suc_num_ctrl;
    }

    /**
     * @param mixed $suc_num_ctrl
     * @return Seg43_1m
     */
    public function setSucNumCtrl($suc_num_ctrl)
    {
        $this->suc_num_ctrl = $suc_num_ctrl;
        return $this;
    }
}