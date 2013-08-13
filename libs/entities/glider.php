<?php

include_once(ROOT . 'libs/entities/product.php');
include_once(ROOT . 'libs/repositories/models.php');
include_once(ROOT . 'libs/repositories/finishs.php');
include_once(ROOT . 'libs/repositories/fabrics.php');
include_once(ROOT . 'libs/repositories/pipings.php');

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
	 * @param $imageName
	 * @param $price
	 * @param $shippingFee
	 * @param $modelCode
	 * @param $finishCode
	 * @param $fabricCode
	 * @param $pipingCode
	 */
	function __construct($imageName, $price, $shippingFee, $modelCode, $finishCode, $fabricCode, $pipingCode = null)
	{
		parent::__construct(TYPE_GLIDER, $imageName, $price, $shippingFee);

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
		return array_merge(
			parent::getInfoArray(),
			array(
				'modelCode'  => $this->getModelCode(),
				'finishCode' => $this->getModelCode(),
				'fabricCode' => $this->getFabricCode(),
				'pipingCode' => $this->getPipingCode()
			)
		);
	}


	/**
	 * Définit le code du modèle de la chaise oscillante.
	 *
	 * @param mixed $modelCode
	 */
	private function setModelCode($modelCode)
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
	private function setFinishCode($finishCode)
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
	private function setFabricCode($fabricCode)
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
	private function setPipingCode($pipingCode)
	{
		$this->pipingCode = $pipingCode;
	}


	/**
	 * Retourne le code du passpoil de la chaise oscillante.
	 *
	 * @return mixed
	 */
	public function getPipingCode()
	{
		return $this->pipingCode;
	}


	/**
	 * Retourne le modèle de la chaise oscillante.
	 *
	 * @return Model
	 */
	public function getModel()
	{
		return Models::Find($this->getModelCode());
	}


	/**
	 * Retourne le fini de la chaise oscillante.
	 *
	 * @return Finish
	 */
	public function getFinish()
	{
		return Finishs::Find($this->getFinishCode());
	}


	/**
	 * Retourne le tissu de la chaise oscillante.
	 *
	 * @return Fabric
	 */
	public function getFabric()
	{
		return Fabrics::Find($this->getFabricCode());
	}


	/**
	 * Retourne le passepoil de la chaise oscillante.
	 *
	 * @return Piping
	 */
	public function getPiping()
	{
		return Pipings::Find($this->getPipingCode());
	}
}