<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company")
 */
class CompanyEntity extends Util\AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \ModuleModel\Entity\UserEntity
     * @ORM\OneToOne(targetEntity="ModuleModel\Entity\UserEntity", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $owner;
    
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
     * @return \ModuleModel\Entity\UserEntity
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * @param \ModuleModel\Entity\UserEntity $owner
     */
    public function setOwner($owner)
    {
        if(null === $owner) {
            $this->owner = null;
            return;
        }
        
        if(!$owner instanceof UserEntity)
            throw new \Exception('$owner have to be instance of UserEntity');
        
        $this->owner = $owner;
    }
}
