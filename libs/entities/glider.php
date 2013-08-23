<?php

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
	private $modelCodeMatchingOttoman;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
		include_once(DIR . 'libs/entities/product.php');
	}


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
	 * @param $modelCodeMatchingOttoman
	 */
	function __construct($imageName, $price, $shippingFee, $modelCode, $finishCode, $fabricCode, $pipingCode, $modelCodeMatchingOttoman)
	{
		parent::__construct(TYPE_GLIDER, $imageName, $price, $shippingFee);

		$this->setModelCode($modelCode);
		$this->setFinishCode($finishCode);
		$this->setFabricCode($fabricCode);
		$this->setPipingCode($pipingCode);
		$this->setModelCodeMatchingOttoman($modelCodeMatchingOttoman);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés d'une chaise oscillante.
	 */
	public function getInfoArray()
	{
		return array_merge(
			parent::getInfoArray(),
			array(
				'modelCode'                => $this->getModelCode(),
				'finishCode'               => $this->getFinishCode(),
				'fabricCode'               => $this->getFabricCode(),
				'pipingCode'               => $this->getPipingCode(),
				'modelCodeMatchingOttoman' => $this->getModelCodeMatchingOttoman()
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
	 * Définit la valeur de la propriété nommée modelCodeMatchingOttoman.
	 *
	 * @param mixed $modelCodeMatchingOttoman
	 */
	public function setModelCodeMatchingOttoman($modelCodeMatchingOttoman)
	{
		$this->modelCodeMatchingOttoman = $modelCodeMatchingOttoman;
	}


	/**
	 * Retourne la valeur de la propriété nommée modelCodeMatchingOttoman.
	 *
	 * @return mixed
	 */
	public function getModelCodeMatchingOttoman()
	{
		return $this->modelCodeMatchingOttoman;
	}


	/**
	 * Retourne le modèle de la chaise oscillante.
	 *
	 * @return Model
	 */
	public function getModel()
	{
		include_once(DIR . 'libs/repositories/models.php');

		return Models::Find($this->getModelCode());
	}


	/**
	 * Retourne le fini de la chaise oscillante.
	 *
	 * @return Finish
	 */
	public function getFinish()
	{
		include_once(DIR . 'libs/repositories/finishs.php');

		return Finishs::Find($this->getFinishCode());
	}


	/**
	 * Retourne le tissu de la chaise oscillante.
	 *
	 * @return Fabric
	 */
	public function getFabric()
	{
		include_once(DIR . 'libs/repositories/fabrics.php');

		return Fabrics::Find($this->getFabricCode());
	}


	/**
	 * Retourne le passepoil de la chaise oscillante.
	 *
	 * @return Piping
	 */
	public function getPiping()
	{
		include_once(DIR . 'libs/repositories/pipings.php');

		return Pipings::Find($this->getPipingCode());
	}


	/**
	 * Retourne le tabouret correspondant.
	 *
	 * @return Glider|Ottoman|Pilow
	 */
	public function getMatchingOttoman()
	{
		include_once(DIR . 'libs/repositories/products.php');

		return Products::FindByComponent(
			$this->getModelCodeMatchingOttoman(),
			$this->getFinishCode(),
			$this->getFabricCode(),
			$this->getPipingCode()
		);
	}
}