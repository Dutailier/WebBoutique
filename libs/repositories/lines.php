<?php

include_once(ROOT . 'libs/entities/line.php');

/**
 * Class Lines
 * Gère les méthodes manipulant l'entité Line.
 */
class Lines
{
	/**
	 * Ajoute une ligne de commande à la base de données.
	 *
	 * @param Line $line
	 *
	 * @return Line
	 * @throws Exception
	 */
	public static function Attach(Line $line)
	{
		$query = 'EXEC [addLine]';
		$query .= '@orderId = "' . $line->getOrderId() . '", ';
		$query .= '@productSku = "' . $line->getProductSku() . '", ';
		$query .= '@quantity = "' . $line->getQuantity() . '", ';
		$query .= '@unitPrice = "' . $line->getUnitPrice() . '", ';
		$query .= '@grossPrice = "' . $line->getGrossPrice() . '"';

		$rows = Database::Execute($query);

		if (Empty($rows)) {
			throw new Exception(ERROR_LINE_WASNT_ADDED);
		}

		$line->setId($rows[0]['id']);

		return $line;
	}


	/**
	 * Retourne la ligne.
	 *
	 * @param $id
	 *
	 * @return Line
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getLineById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_LINE_DOESNT_EXIST);
		}

		$line = new Line(
			$rows[0]['productSku'],
			$rows[0]['quantity'],
			$rows[0]['unitPrice'],
			$rows[0]['grossPrice']
		);

		$line->setId($rows[0]['id']);
		$line->setOrderId($rows[0]['orderId']);

		return $line;
	}


	/**
	 * Retourne les lignes d'une commande.
	 *
	 * @param $orderId
	 *
	 * @return array
	 */
	public static function FilterByOrderId($orderId)
	{
		$query = 'EXEC [getLinesByOrderId]';
		$query .= '@orderId = "' . intval($orderId) . '"';

		$rows = Database::Execute($query);

		$lines = array();
		foreach ($rows as $row) {
			$line = new Line(
				$row['productSku'],
				$row['quantity'],
				$row['unitPrice'],
				$row['grossPrice']
			);

			$line->setId($row['id']);
			$line->setOrderId($row['orderId']);

			$lines[] = $line;
		}

		return $lines;
	}
}