<?php

/**
 * Class Database
 * Gère les méthodes d'accès à la base de données du projet.
 */
class Database
{
	/**
	 * Retourne un tableau associatif des résultats de la requête SQL passée.
	 *
	 * @param $query
	 *
	 * @return array
	 * @throws Exception
	 */
	public static function Execute($query)
	{
		$conn = self::getConnection();

		$result = odbc_exec($conn, $query);

		if (odbc_error($result)) {
			throw new Exception(ERROR_DB_EXECUTION_FAILED);
		}

		// On doit obligatoirement insérer ligne par ligne dans un tableau
		// chaque élément du résultat car les fonctions prédéfinies de ODBC
		// ne fonctionne pas correctement.
		$rows = array();
		while (odbc_fetch_row($result)) {

			$row = array();
			for ($i = 1; $i <= odbc_num_fields($result); $i++) {
				$column       = odbc_field_name($result, $i);
				$row[$column] = odbc_result($result, $column);
			}
			$rows[] = $row;
		}

		odbc_close($result);

		return $rows;
	}


	/**
	 * Retourne une connexion à la base de données.
	 *
	 * @return resource
	 * @throws Exception
	 */
	private static function getConnection()
	{
		$conn = odbc_connect(
			DB_DSN,
			DB_USERNAME,
			DB_PASSWORD
		);

		if (odbc_error($conn)) {
			throw new Exception(ERROR_DB_CONNECTION_FAILED);
		}

		return $conn;
	}
}
