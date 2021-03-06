<?php

/**
 * Class Pilow
 * Représente un coussin lombaire.
 */
class Pilow extends Product
{
	private $modelCode;
	private $fabricCode;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
		include_once(DIR . 'libs/entities/product.php');
	}


	/**
	 * Initialise le coussin lombaire.
	 *
	 * @param $imageName
	 * @param $price
	 * @param $shippingFee
	 * @param $modelCode
	 * @param $fabricCode
	 */
	function __construct($imageName, $price, $shippingFee, $modelCode, $fabricCode)
	{
		parent::__construct(TYPE_PILLOW, $imageName, $price, $shippingFee);

		$this->setModelCode($modelCode);
		$this->setFabricCode($fabricCode);
	}


	/**
	 * Retourne un tableau contenant les propriétés du coussin lombaire.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array_merge(
			parent::getInfoArray(),
			array(
				'modelCode'  => $this->getModelCode(),
				'fabricCode' => $this->getFabricCode()
			)
		);
	}


	/**
	 * Définit le code du modèle.
	 *
	 * @param mixed $modelCode
	 */
	private function setModelCode($modelCode)
	{
		$this->modelCode = $modelCode;
	}


	/**
	 * Retourne le code du modèle.
	 *
	 * @return mixed
	 */
	public function getModelCode()
	{
		return $this->modelCode;
	}


	/**
	 * Définit le code du tissu du coussin lombaire.
	 *
	 * @param mixed $fabricCode
	 */
	private function setFabricCode($fabricCode)
	{
		$this->fabricCode = $fabricCode;
	}


	/**
	 * Retourne le code du tissu du coussin lombaire.
	 *
	 * @return mixed
	 */
	public function getFabricCode()
	{
		return $this->fabricCode;
	}


	/**
	 * Retourne le modèle du coussin lombaire.
	 *
	 * @return Model
	 */
	public function getModel()
	{
		include_once(DIR . 'libs/repositories/models.php');

		return Models::Find($this->getModelCode());
	}


	/**
	 * Retourne le tissu du coussin lombaire.
	 *
	 * @return Fabric
	 */
	public function getFabric()
	{
		include_once(DIR . 'libs/repositories/fabrics.php');

		return Fabrics::Find($this->getFabricCode());
	}
}