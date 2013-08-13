<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/product.php');
include_once(ROOT . 'libs/entities/glider.php');
include_once(ROOT . 'libs/entities/ottoman.php');
include_once(ROOT . 'libs/entities/pilow.php');

/**
 * class Products
 * Gère les différentes méthodes manipulant l'entité Product.
 */
class Products
{
	/**
	 * Retourne le produit.
	 *
	 * @param $sku
	 * @param $userId
	 *
	 * @return Glider|Ottoman|Pilow
	 * @throws Exception
	 */
	public static function Find($sku, $userId)
	{
		$query = 'EXEC [getProductBySku]';
		$query .= '@sku = \'' . $sku . '\', ';
		$query .= '@userId = \'' . $userId . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_PRODUCT_DOESNT_EXIST);
		}

		$product = null;
		switch ($rows[0]['typeCode']) {
			case TYPE_GLIDER:
				$product = new Glider (
					$rows[0]['imageName'],
					$rows[0]['price'],
					$rows[0]['shippingFee'],
					$rows[0]['modelCode'],
					$rows[0]['finishCode'],
					$rows[0]['fabricCode'],
					$rows[0]['pipingCode']
				);
				break;

			case TYPE_OTTOMAN:
				$product = new Ottoman (
					$rows[0]['imageName'],
					$rows[0]['price'],
					$rows[0]['shippingFee'],
					$rows[0]['modelCode'],
					$rows[0]['finishCode'],
					$rows[0]['fabricCode'],
					$rows[0]['pipingCode']
				);
				break;

			case TYPE_PILOW:
				$product = new Pilow (
					$rows[0]['imageName'],
					$rows[0]['price'],
					$rows[0]['shippingFee'],
					$rows[0]['modelCode'],
					$rows[0]['fabricCode']
				);
				break;

			default:
				throw new Exception(ERROR_TYPE_INVALID);
		}

		$product->setSku($sku);

		return $product;
	}


	public static function FindByComponent($modelCode, $finishCode, $fabricCode, $pipingCode, $userId)
	{
		$query = 'EXEC [getProductByComponent]';
		$query .= '@modelCode = \'' . $modelCode . '\', ';

		if (!empty($finishCode)) {
			$query .= '@finishCode = \'' . $finishCode . '\', ';
		}

		$query .= '@fabricCode = \'' . $fabricCode . '\', ';

		if (!empty($pipingCode)) {
			$query .= '@pipingCode = \'' . $pipingCode . '\', ';
		}

		$query .= '@userId = \'' . $userId . '\', ';
		$query .= '@LanguageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_PRODUCT_DOESNT_EXIST);
		}

		$product = null;
		switch ($rows[0]['typeCode']) {
			case TYPE_GLIDER:
				$product = new Glider (
					$rows[0]['imageName'],
					$rows[0]['price'],
					$rows[0]['shippingFee'],
					$rows[0]['modelCode'],
					$rows[0]['finishCode'],
					$rows[0]['fabricCode'],
					$rows[0]['pipingCode']
				);
				break;

			case TYPE_OTTOMAN:
				$product = new Ottoman (
					$rows[0]['imageName'],
					$rows[0]['price'],
					$rows[0]['shippingFee'],
					$rows[0]['modelCode'],
					$rows[0]['finishCode'],
					$rows[0]['fabricCode'],
					$rows[0]['pipingCode']
				);
				break;

			case TYPE_PILOW:
				$product = new Pilow (
					$rows[0]['imageName'],
					$rows[0]['price'],
					$rows[0]['shippingFee'],
					$rows[0]['modelCode'],
					$rows[0]['fabricCode']
				);
				break;

			default:
				throw new Exception(ERROR_TYPE_INVALID);
		}

		$product->setSku($rows[0]['sku']);

		return $product;
	}
}