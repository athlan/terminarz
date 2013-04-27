<?php

namespace ModuleModel\Model;

class ScheduleModel extends Util\AbstractDoctrineModel
{
    private $entity = 'ModuleModel\Entity\ScheduleEntity';
    
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
}
