<?php

/**
 * Class Ottoman
 * Représente un tabouret oscillant.
 */
class Ottoman extends Product
{
	private $modelCode;
	private $finishCode;
	private $fabricCode;
	private $pipingCode;


	/**
	 * Initiliase le tabouret oscillant.
	 *
	 * @param $typeCode
	 * @param $modelCode
	 * @param $finishCode
	 * @param $fabricCode
	 * @param $pipingCode
	 */
	function __construct($typeCode, $modelCode, $finishCode = null, $fabricCode, $pipingCode = null)
	{
		parent::__construct($typeCode);

		$this->setModelCode($modelCode);
		$this->setFinishCode($finishCode);
		$this->setFabricCode($fabricCode);
		$this->setPipingCode($pipingCode);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés d'un tabouret oscillant.
	 */
	public function getInfoArray()
	{
		return array(
			'sku'        => parent::getSku(),
			'typeCode'   => parent::getTypeCode(),
			'modelCode'  => $this->getModelCode(),
			'finishCode' => $this->getModelCode(),
			'fabricCode' => $this->getFabricCode(),
			'pipingCode' => $this->getPipingCode()
		);
	}


	/**
	 * Définit le code du modèle du tabouret oscillant.
	 *
	 * @param mixed $modelCode
	 */
	public function setModelCode($modelCode)
	{
		$this->modelCode = $modelCode;
	}


	/**
	 * Retourne le code du modèle du tabouret oscillant.
	 *
	 * @return mixed
	 */
	public function getModelCode()
	{
		return $this->modelCode;
	}


	/**
	 * Définit le code du fini du tabouret oscillant.
	 *
	 * @param mixed $finishCode
	 */
	public function setFinishCode($finishCode)
	{
		$this->finishCode = $finishCode;
	}


	/**
	 * Retourne le code du fini du tabouret oscillant.
	 *
	 * @return mixed
	 */
	public function getFinishCode()
	{
		return $this->finishCode;
	}


	/**
	 * Définit le code du tissu du tabouret oscillant.
	 *
	 * @param mixed $fabricCode
	 */
	public function setFabricCode($fabricCode)
	{
		$this->fabricCode = $fabricCode;
	}


	/**
	 * retourne le code du tissu du tabouret oscillant.
	 *
	 * @return mixed
	 */
	public function getFabricCode()
	{
		return $this->fabricCode;
	}


	/**
	 * Définit le code du passepoil du tabouret oscillant.
	 *
	 * @param mixed $pipingCode
	 */
	public function setPipingCode($pipingCode)
	{
		$this->pipingCode = $pipingCode;
	}


	/**
	 * Retourne le code du passepoil du tabouret oscillant.
	 *
	 * @return mixed
	 */
	public function getPipingCode()
	{
		return $this->pipingCode;
	}
}