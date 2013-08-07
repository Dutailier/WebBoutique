<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/customer.php');
include_once(ROOT . 'libs/repositories/users.php');

/**
 * class Customers
 * Gère les différentes méthodes manipulant l'entité Customer.
 */
class Customers
{
	/**
	 * Ajoute un consommateur à la base de donnée.
	 *
	 * @param Customer $customer
	 *
	 * @return Customer
	 * @throws Exception
	 */
	public static function Attach(Customer $customer)
	{
		$user = Users::Attach($customer);

		$query = 'EXEC [addCustomer]';
		$query .= '@userId = \'' . $user->getId() . '\', ';
		$query .= '@greeting = \'' . $customer->getGreeting() . '\', ';
		$query .= '@firstname = \'' . $customer->getFirstname() . '\', ';
		$query .= '@lastname = \'' . $customer->getLastname() . '\', ';
		$query .= '@phone = \'' . $customer->getPhone() . '\', ';
		$query .= '@email = \'' . $customer->getEmail() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_CUSTOMER_WASNT_ADDED);
		}

		return $customer;
	}
}