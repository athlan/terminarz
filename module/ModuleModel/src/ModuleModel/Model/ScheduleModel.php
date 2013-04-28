<?php

namespace ModuleModel\Model;

use ModuleModel\Entity\ScheduleTypeEnum;

use ModuleModel\Entity\ScheduleEntity;

class ScheduleModel extends Util\AbstractDoctrineModel
{
    private $entity = 'ModuleModel\Entity\ScheduleEntity';
    private $entityAvailability = 'ModuleModel\Entity\ScheduleAvailabilityEntity';
    
    /**
     * @param int $id
     * @return \ModuleModel\Entity\ScheduleEntity
     */
    public function get($id)
    {
        return $this->em()->find($this->entity, $id);
    }
    
    /**
     * @return array[\ModuleModel\Entity\ScheduleEntity]
     */
    public function fetchAll(array $params = [])
    {
        return $this->em()->getRepository($this->entity)->findAll();
    }
    
    public function getScheduleAvailibilityWeekday(ScheduleEntity $schedule, $weekday)
    {
        return $this->em()
            ->getRepository($this->entityAvailability)->findBy([
                'schedule' => $schedule->getId(),
                'repeatWeekday' => $weekday,
            ], [
                'durationStart' => 'ASC',
            ]);
    }
    
    public function getScheduleAvailibilityWeekly(ScheduleEntity $schedule)
    {
        return $this->em()
            ->getRepository($this->entityAvailability)->findBy([
                'schedule' => $schedule->getId(),
            ], [
                'repeatWeekday' => 'ASC',
                'durationStart' => 'ASC',
            ]);
    }
}
