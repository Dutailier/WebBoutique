<?php

include_once(ROOT . 'libs/entity.php');

/**
 * Class Role
 * Représente un rôle.
 */
class Role extends Entity
{
    private $name;


    /**
     * Constructeur par défaut.
     * @param $name
     */
    function __construct($name)
    {
        $$this->setName($name);
    }


    /**
     * Retourne un tableau contenant les propriétés de l'objet.
     * @return array
     */
    public function getArray()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName()
        );
    }


    /**
     * Retourne le nom du rôle.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Définit le nom du rôle.
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = trim($name);
    }
}