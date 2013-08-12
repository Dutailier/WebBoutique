<?php

include_once(ROOT . 'libs/entities/product.php');
include_once(ROOT . 'libs/repositories/models.php');
include_once(ROOT . 'libs/repositories/fabrics.php');

/**
 * Class Pilow
 * Représente un coussin lombaire.
 */
class Pilow extends Product
{
	private $modelCode;
	private $fabricCode;


	/**
	 * Initialise le coussin lombaire.
	 *
	 * @param imageName
	 * @param $modelCode
	 * @param $fabricCode
	 */
	function __construct($imageName, $modelCode, $fabricCode)
	{
		parent::__construct(TYPE_PILOW, $imageName);

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
		return array(
			'sku'        => parent::getSku(),
			'typeCode'   => parent::getTypeCode(),
			'imageName'  => parent::getImageName(),
			'modelCode'  => $this->getModelCode(),
			'fabricCode' => $this->getFabricCode()
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
		return Models::Find($this->getModelCode());
	}


	/**
	 * Retourne le tissu du coussin lombaire.
	 *
	 * @return Fabric
	 */
	public function getFabric()
	{
		return Fabrics::Find($this->getFabricCode());
	}
}