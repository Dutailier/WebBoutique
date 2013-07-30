<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/product.php');

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
	 *
	 * @return Glider|Ottoman|Pilow
	 * @throws Exception
	 */
	public static function Find($sku)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getProductBySku]';
		$query .= '@sku = "' . trim($sku) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			// TODO : Implémenter l'erreur.
			throw new Exception(ERROR_PRODUCT_DOESNT_EXIST);
		}

		$product = null;
		switch ($rows[0]['typeCode']) {
			case TYPE_GLIDER:
				$product = new Glider (
					$rows[0]['modelCode'],
					$rows[0]['finishCode'],
					$rows[0]['fabricCode'],
					$rows[0]['pipingCode']
				);
				break;

			case TYPE_OTTOMAN:
				$product = new Ottoman (
					$rows[0]['modelCode'],
					$rows[0]['finishCode'],
					$rows[0]['fabricCode'],
					$rows[0]['pipingCode']
				);
				break;

			case TYPE_PILOW:
				$product = new Pilow (
					$rows[0]['modelCode'],
					$rows[0]['fabricCode']
				);
				break;

			default:
				// TODO : Implémenter l'erreur.
				throw new Exception(ERROR_TYPE_INVALID);
		}

		$product->setSku($sku);

		return $product;
	}
}