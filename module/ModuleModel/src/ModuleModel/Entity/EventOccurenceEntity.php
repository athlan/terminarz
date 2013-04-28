<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_occurence")
 */
class EventOccurenceEntity extends Util\AbstractEntity
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
     * @ORM\ManyToOne(targetEntity="ModuleModel\Entity\UserEntity")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $user;
    
    /**
     * @var \ModuleModel\Entity\ScheduleEntity
     * @ORM\ManyToOne(targetEntity="ModuleModel\Entity\ScheduleEntity")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $schedule;
    
    /**
     * @var \ModuleModel\Entity\ServiceEntity
     * @ORM\ManyToOne(targetEntity="ModuleModel\Entity\ServiceEntity")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $service;
    
    /**
     * @var \ModuleModel\Entity\EventEntity
     * @ORM\ManyToOne(targetEntity="ModuleModel\Entity\EventEntity")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $event;
    
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
     * @var \DateTime
     * @ORM\Column(type="datetime");
     */
    protected $durationStart;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime");
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
     * @return \ModuleModel\Entity\UserEntity
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * @param \ModuleModel\Entity\UserEntity $user
     */
    public function setUser($user)
    {
        if(null === $user) {
            $this->user = null;
            return;
        }
    
        if(!$user instanceof UserEntity)
            throw new \Exception('$user have to be instance of UserEntity');
    
        $this->user = $user;
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
     * @return \ModuleModel\Entity\EventEntity
     */
    public function getEvent()
    {
        return $this->event;
    }
    
    /**
     * @param \ModuleModel\Entity\EventEntity $event
     */
    public function setEvent($event)
    {
        if(null === $event) {
            $this->event = null;
            return;
        }
    
        if(!$event instanceof EventEntity)
            throw new \Exception('$event have to be instance of EventEntity');
    
        $this->event = $event;
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
     * @return int
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
