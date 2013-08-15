<?php

include_once(ROOT . 'libs/entities/product.php');
include_once(ROOT . 'libs/repositories/models.php');
include_once(ROOT . 'libs/repositories/finishs.php');
include_once(ROOT . 'libs/repositories/fabrics.php');
include_once(ROOT . 'libs/repositories/pipings.php');

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
		parent::__construct(TYPE_OTTOMAN, $imageName, $price, $shippingFee);

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
		return array_merge(
			parent::getInfoArray(),
			array(
				'modelCode'  => $this->getModelCode(),
				'finishCode' => $this->getFinishCode(),
				'fabricCode' => $this->getFabricCode(),
				'pipingCode' => $this->getPipingCode()
			)
		);
	}


	/**
	 * Définit le code du modèle du tabouret oscillant.
	 *
	 * @param mixed $modelCode
	 */
	private function setModelCode($modelCode)
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
	private function setFinishCode($finishCode)
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
	private function setFabricCode($fabricCode)
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
	private function setPipingCode($pipingCode)
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


	/**
	 * Retourne le modèle du tabouret oscillant.
	 *
	 * @return Model
	 */
	public function getModel()
	{
		return Models::Find($this->getModelCode());
	}


	/**
	 * Retourne le fini du tabouret oscillant.
	 *
	 * @return Finish
	 */
	public function getFinish()
	{
		return Finishs::Find($this->getFinishCode());
	}


	/**
	 * Retourne le tissu du tabouret oscillant.
	 *
	 * @return Fabric
	 */
	public function getFabric()
	{
		return Fabrics::Find($this->getFabricCode());
	}


	/**
	 * Retourne le passepoil du tabouret oscillant.
	 *
	 * @return Piping
	 */
	public function getPiping()
	{
		return Pipings::Find($this->getPipingCode());
	}
}