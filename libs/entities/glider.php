<?php

include_once(ROOT . 'libs/entities/product.php');


/**
 * Class Glider
 * Représente une chaise oscillante.
 */
class Glider extends Product
{
	private $modelCode;
	private $finishCode;
	private $fabricCode;
	private $pipingCode;


	/**
	 * Initiliase la chaise oscillante.
	 *
	 * @param $modelCode
	 * @param $finishCode
	 * @param $fabricCode
	 * @param $pipingCode
	 */
	function __construct($modelCode, $finishCode, $fabricCode, $pipingCode = null)
	{
		parent::__construct(TYPE_GLIDER);

		$this->setModelCode($modelCode);
		$this->setFinishCode($finishCode);
		$this->setFabricCode($fabricCode);
		$this->setPipingCode($pipingCode);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés d'une chaise oscillante.
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
	 * Définit le code du modèle de la chaise oscillante.
	 *
	 * @param mixed $modelCode
	 */
	public function setModelCode($modelCode)
	{
		$this->modelCode = $modelCode;
	}


	/**
	 * Retourne le code du modèle de la chaise oscillante.
	 *
	 * @return mixed
	 */
	public function getModelCode()
	{
		return $this->modelCode;
	}


	/**
	 * Définit le code du fini de la chaise oscilannte.
	 *
	 * @param mixed $finishCode
	 */
	public function setFinishCode($finishCode)
	{
		$this->finishCode = $finishCode;
	}


	/**
	 * Retourne le code du fini de la chaise oscillante.
	 *
	 * @return mixed
	 */
	public function getFinishCode()
	{
		return $this->finishCode;
	}


	/**
	 * Définit le code du tissu de la chaise oscillante.
	 *
	 * @param mixed $fabricCode
	 */
	public function setFabricCode($fabricCode)
	{
		$this->fabricCode = $fabricCode;
	}


	/**
	 * Retourne le code du tissu de la chaise osciallante.
	 *
	 * @return mixed
	 */
	public function getFabricCode()
	{
		return $this->fabricCode;
	}


	/**
	 * Définit le code du passpoil de la chaise oscillante.
	 *
	 * @param mixed $pipingCode
	 */
	public function setPipingCode($pipingCode)
	{
		$this->pipingCode = $pipingCode;
	}


	/**
	 * Retourne le code du passpoil de la chaise osciallante.
	 *
	 * @return mixed
	 */
	public function getPipingCode()
	{
		return $this->pipingCode;
	}
}