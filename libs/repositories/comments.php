<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/comment.php');

/**
 * Class Comments
 * Gère les différentes méthodes manipulant l'entité Comment.
 */
class Comments
{
	/**
	 * Ajoute un commentaire à la base de données.
	 *
	 * @param Comment $comment
	 *
	 * @return Comment
	 * @throws Exception
	 */
	public static function Attach(Comment $comment)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [addComment]';
		$query .= '@userId = "' . $comment->getUserId() . '", ';
		$query .= '@orderId = "' . $comment->getOrderId() . '", ';
		$query .= '@text = "' . $comment->getText() . '", ';
		$query .= '@commentId = "' . $comment->getCommentId() . '"';

		$rows = Database::Execute($query);

		if (Empty($rows)) {
			// TODO : Implémenter l'erreur.
			throw new Exception(ERROR_COMMENT_WASNT_ADDED);
		}

		$comment->setId($rows[0]['id']);
		$comment->setDatetime($rows[0]['datetime']);

		return $comment;
	}


	/**
	 * Retourne le commentaire.
	 *
	 * @param $id
	 *
	 * @return Comment
	 * @throws Exception
	 */
	public static function Find($id)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getCommentById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			// TODO : Implémenter l'erreur.
			throw new Exception(ERROR_COMMENT_DOESNT_EXIST);
		}

		$comment = new Comment(
			$rows[0]['userId'],
			$rows[0]['orderId'],
			$rows[0]['text'],
			$rows[0]['commentId']
		);

		$comment->setId($rows[0]['id']);
		$comment->setDatetime($rows[0]['datetime']);

		return $comment;
	}


	/**
	 * Retourne les commentaires d'une commande.
	 */
	public static function FilterByOrderId($orderId)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getCommentsByOrderId]';
		$query .= '@orderId = "' . intval($orderId) . '"';

		$rows = Database::Execute($query);

		$comments = array();
		foreach ($rows as $row) {
			$comment = new Comment(
				$row['userId'],
				$row['orderId'],
				$row['text'],
				$row['commentId']
			);

			$comment->setId($row['id']);
			$comment->setDatetime($row['datetime']);

			$comments[] = $comment;
		}

		return $comments;
	}


	/**
	 * Retourne tous les commentaire répondant au commentaire.
	 *
	 * @param $commentId
	 *
	 * @return array
	 */
	public static function FilterByCommentId($commentId)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getCommentsByCommentId]';
		$query .= '@orderId = "' . intval($commentId) . '"';

		$rows = Database::Execute($query);

		$comments = array();
		foreach ($rows as $row) {
			$comment = new Comment(
				$row['userId'],
				$row['orderId'],
				$row['text'],
				$row['commentId']
			);

			$comment->setId($row['id']);
			$comment->setDatetime($row['datetime']);

			$comments[] = $comment;
		}

		return $comments;
	}
}