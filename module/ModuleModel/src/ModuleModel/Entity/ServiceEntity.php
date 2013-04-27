<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="service")
 */
class ServiceEntity extends Util\AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \ModuleModel\Entity\CompanyEntity
     * @ORM\OneToOne(targetEntity="ModuleModel\Entity\CompanyEntity")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $company;
    
    /**
     * @var string
     * @ORM\Column(type="string");
     */
    protected $name;
    
    /**
     * @var float
     * @ORM\Column(type="float");
     */
    protected $price;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $quantity;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $durationInMinutes;
    
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
     * @return \ModuleModel\Entity\CompanyEntity
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * @param \ModuleModel\Entity\CompanyEntity $owner
     */
    public function setCompany($company)
    {
        if(null === $company) {
            $this->company = null;
            return;
        }
        
        if(!$company instanceof CompanyEntity)
            throw new \Exception('$company have to be instance of CompanyEntity');
        
        $this->company = $company;
    }
    
	/**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

	/**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

	/**
     * @return int $quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

	/**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

	/**
     * @return int
     */
    public function getDurationInMinutes()
    {
        return $this->durationInMinutes;
    }

	/**
     * @param int $durationInMinutes
     */
    public function setDurationInMinutes($durationInMinutes)
    {
        $this->durationInMinutes = $durationInMinutes;
    }
}
