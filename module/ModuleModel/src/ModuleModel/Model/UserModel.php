<?php

namespace ModuleModel\Model;

class UserModel extends Util\AbstractDoctrineModel
{
    private $entity = 'ModuleModel\Entity\UserEntity';
    
    /**
     * @param int $id
     * @return \ModuleModel\Entity\UserEntity
     */
    public function get($id)
    {
        return $this->em()->find($this->entity, $id);
    }
    
    /**
     * @return array[\ModuleModel\Entity\UserEntity]
     */
    public function fetchAll(array $params = [])
    {
        return $this->em()->getRepository($this->entity)->findAll();
    }
}
