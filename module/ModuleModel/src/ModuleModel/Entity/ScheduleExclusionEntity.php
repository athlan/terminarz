<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="schedule_exclusion")
 */
class ScheduleExclusionEntity extends Util\AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \ModuleModel\Entity\ScheduleEntity
     * @ORM\ManyToOne(targetEntity="ModuleModel\Entity\ScheduleEntity")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $schedule;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="date");
     */
    protected $date;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true);
     */
    protected $durationStart;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true);
     */
    protected $durationStop;
    
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
     * @return \ModuleModel\Entity\ScheduleEntity
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
    
    /**
     * @param \ModuleModel\Entity\ScheduleEntity $schedule
     */
    public function setSchedule($schedule)
    {
        if(null === $schedule) {
            $this->schedule = null;
            return;
        }
        
        if(!$schedule instanceof ScheduleEntity)
            throw new \Exception('$schedule have to be instance of ScheduleEntity');
        
        $this->schedule = $schedule;
    }
    
    /**
     * @return \ModuleModel\Entity\ServiceEntity
     */
    public function getService()
    {
        return $this->service;
    }
    
    /**
     * @param \ModuleModel\Entity\ServiceEntity $service
     */
    public function setService($service)
    {
        if(null === $service) {
            $this->service = null;
            return;
        }
    
        if(!$service instanceof ServiceEntity)
            throw new \Exception('$schedule have to be instance of ServiceEntity');
    
        $this->service = $service;
    }
    
    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        if(null === $date) {
            $this->date = null;
            return;
        }
        
        if(!$date instanceof \DateTime)
            throw new \Exception('$date have to be instance of DateTime');
        
        $this->date = $date;
    }
    
    /**
     * @return \DateTime
     */
    public function getDurationStart()
    {
        return $this->durationStart;
    }
    
    /**
     * @param \DateTime $date
     */
    public function setDurationStart($date)
    {
        if(null === $date) {
            $this->durationStart = null;
            return;
        }
    
        if(!$date instanceof \DateTime)
            throw new \Exception('$date have to be instance of DateTime');
    
        $this->durationStart = $date;
    }
    
    /**
     * @return \DateTime
     */
    public function getDurationStop()
    {
        return $this->durationStop;
    }
    
    /**
     * @param \DateTime $date
     */
    public function setDurationStop($date)
    {
        if(null === $date) {
            $this->durationStop = null;
            return;
        }
    
        if(!$date instanceof \DateTime)
            throw new \Exception('$date have to be instance of DateTime');
    
        $this->durationStop = $date;
    }
    
}
