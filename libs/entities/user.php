<?php

include_once(ROOT . 'libs/entity.php');
include_once(ROOT . 'libs/repositories/roles.php');

/**
 * Class User
 * Représente un utilisateur.
 */
class User extends Entity
{
    private $username;
    private $password;
    private $languageId;

    /**
     * Initialise l'utilisateur.
     * @param $username
     * @param $languageId
     */
    function __construct($username, $password, $languageId)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setLanguageId($languageId);
    }


    /**
     * Retourne un tableau contenant les informations de l'utilisateur.
     * @return array|mixed
     */
    public function getArray()
    {
        return array(
            'id' => $this->getId(),
            'username' => $this->getUsername()
        );
    }


    /**
     * Retourne le nom d'utilisateur.
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Définit le nom d'utilisteur.
     * @param $username
     * @throws Exception
     */
    private function setUsername($username)
    {
        if (strlen($username) > 20) {
            throw new Exception('The length of the username is too long.');
        }

        $this->username = strtolower($username);
    }

    /**
     * Définit le password d'un utilisateur.
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Retourne le password d'un utilisateur.
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Définit la langue de l'utilisateur.
     * @param mixed $id
     */
    public function setLanguageId($id)
    {
        $this->languageId = intval($id);
    }

    /**
     * Retourne la langue de l'utilisateur.
     * @return mixed
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }


    /**
     * Retourne les rôles de l'utilisateur.
     * @return array
     */
    public function getRoles()
    {
        return Roles::FilterByUserId($this->getId());
    }
}