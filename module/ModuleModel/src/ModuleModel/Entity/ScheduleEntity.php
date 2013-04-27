<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="schedule")
 */
class ScheduleEntity extends Util\AbstractEntity
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
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $type;
    
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $bookingAheadTime;
    
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $calendarGranulationMinMinutes;
    
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
     * @param \ModuleModel\Entity\CompanyEntity $company
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
    public function getBookingAheadTime()
    {
        return $this->bookingAheadTime;
    }

	/**
     * @param int $bookingAheadTime
     */
    public function setBookingAheadTime($bookingAheadTime)
    {
        $this->bookingAheadTime = $bookingAheadTime;
    }
    
	/**
     * @return int
     */
    public function getCalendarGranulationMinMinutes()
    {
        return $this->calendarGranulationMinMinutes;
    }

	/**
     * @param int $calendarGranulationMinMinutes
     */
    public function setCalendarGranulationMinMinutes($calendarGranulationMinMinutes)
    {
        $this->calendarGranulationMinMinutes = $calendarGranulationMinMinutes;
    }


}
