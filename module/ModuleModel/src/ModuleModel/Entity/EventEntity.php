<?php

namespace ModuleModel\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event")
 * @ORM\HasLifecycleCallbacks
 */
class EventEntity extends Util\AbstractEntity
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
     * @var \ModuleModel\Entity\ServiceEntity
     * @ORM\ManyToOne(targetEntity="ModuleModel\Entity\ServiceEntity")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $service;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true);
     */
    protected $repeatDateStart;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true);
     */
    protected $repeatDateStop;
    
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
     * @ORM\Column(type="integer", nullable=true);
     */
    protected $repeatWeekday;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true);
     */
    protected $durationStart;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true);
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
    public function getRepeatDateStart()
    {
        return $this->repeatDateStart;
    }
    
    /**
     * @param \DateTime $date
     */
    public function setRepeatDateStart($date)
    {
        if(null === $date) {
            $this->repeatDateStart = null;
            return;
        }
    
        if(!$date instanceof \DateTime)
            throw new \Exception('$date have to be instance of DateTime');
    
        $this->repeatDateStart = $date;
    }
    
    /**
     * @return \DateTime
     */
    public function getRepeatDateStop()
    {
        return $this->repeatDateStop;
    }
    
    /**
     * @param \DateTime $date
     */
    public function setRepeatDateStop($date)
    {
        if(null === $date) {
            $this->repeatDateStop = null;
            return;
        }
    
        if(!$date instanceof \DateTime)
            throw new \Exception('$date have to be instance of DateTime');
        
        $this->repeatDateStop = $date;
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
     * @return int
     */
    public function getRepeatWeekday()
    {
        return $this->repeatWeekday;
    }

	/**
     * @param int $repeatWeekday
     */
    public function setRepeatWeekday($repeatWeekday)
    {
        $this->repeatWeekday = $repeatWeekday;
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
    
    /**
     * @ORM\PrePersist
     */
    public function prePersistAction()
    {
        if(null === $this->getPrice())
            $this->setPrice($this->getService()->getPrice());
        
        if(null === $this->getQuantity())
            $this->setQuantity($this->getService()->getQuantity());
    }
}
