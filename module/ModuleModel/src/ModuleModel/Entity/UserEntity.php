<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserEntity extends Util\AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @ORM\Column(type="string");
     */
    protected $username;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $type;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $scope;
    
    public function __construct() {
    }
    
	/**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
	/**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

	/**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

	/**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

	/**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

	/**
     * @return int
     */
    public function getScope()
    {
        return $this->scope;
    }

	/**
     * @param int $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    
}
