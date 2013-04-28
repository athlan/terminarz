<?php

namespace ModuleModel\Model;

use ModuleModel\Entity\UserEntity;

use Zend\Cache\Storage\Event;

use ModuleModel\Entity\EventOccurenceEntity;

use ModuleModel\Model\Util\DateUtil;

use ModuleModel\Entity\EventEntity;

class EventModel extends Util\AbstractDoctrineModel
{
    private $entity = 'ModuleModel\Entity\EventEntity';
    
    /**
     * @param int $id
     * @return \ModuleModel\Entity\EventEntity
     */
    public function get($id)
    {
        return $this->em()->find($this->entity, $id);
    }
    
    /**
     * @return array[\ModuleModel\Entity\EventEntity]
     */
    public function fetchAll(array $params = [])
    {
        return $this->em()->getRepository($this->entity)->findAll();
    }
    
    /**
     *
     * @param UserEntity $user
     * @return \ModuleModel\Entity\EventOccurenceEntity
     */
    public function createEventOccurence(EventEntity $event, UserEntity $user, \DateTime $date = null)
    {
        $occurence = new EventOccurenceEntity();
        $occurence->setService($event->getService());
        $occurence->setSchedule($event->getSchedule());
        $occurence->setUser($user);
        $occurence->setEvent($event);
        
        if(null === $date) {
            $occurence->setDurationStart($event->getDurationStart());
            $occurence->setDurationStop($event->getDurationStop());
        }
        else {
            if($event->getRepeatWeekday() != $date->format("w"))
                throw new \Exception("Cannot join an repeatable event to the non existsing repeatable weeday");
            
            $occurence->setDurationStart(DateUtil::fillDateByHour($date, $event->getRepeatDateStart()));
            $occurence->setDurationStop(DateUtil::fillDateByHour($date, $event->getRepeatDateStop()));
        }
        
        $occurence->setPrice($event->getPrice());
        $occurence->setQuantity($event->getQuantity());
        
        return $occurence;
    }
    
    public function saveToScheduleUserChoise(EventEntity $event)
    {
        if($event->getDurationStop()->format("Y-m-d") != $event->getDurationStart()->format("Y-m-d"))
            throw new \Exception("Events with durtion within two days are not supported");
        
        $modelSchedule = $this->getModelSchedule();
        
        $weekday = $event->getDurationStart()->format('w');
        $availability = $modelSchedule->getScheduleWeekdayAvailibility($event->getSchedule(), $weekday);
        
        $hourStart = DateUtil::getDateOnlyHours($event->getDurationStart())->getTimestamp();
        $hourStop = DateUtil::getDateOnlyHours($event->getDurationStop())->getTimestamp();
        
        // check time coverage
        $tempCurrentStart = DateUtil::getDateOnlyHours($event->getDurationStart())->getTimestamp();
        
        foreach($availability as $scheduleAvailability) {
            /* @var $scheduleAvailability \ModuleModel\Entity\ScheduleAvailabilityEntity */
            if($scheduleAvailability->getDurationStart()->getTimestamp() > $hourStart)
                throw new \Exception("Event is planned to early");
            
            if($scheduleAvailability->getDurationStop()->getTimestamp() < $hourStop)
                throw new \Exception("Event is planned to late");
            
            $tempCurrentStart = $scheduleAvailability->getDurationStop()->getTimestamp();
        }
        
        $this->save($event);
    }
    
    /**
     * @return \ModuleModel\Model\ScheduleModel
     */
    public function getModelSchedule() {
        return $this->getServiceLocator()->get('ModuleModel\Schedule');
    }
    
}
