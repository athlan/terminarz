<?php

namespace ModuleModel\Model;

class CompanyModel extends Util\AbstractDoctrineModel
{
    private $entity = 'ModuleModel\Entity\CompanyEntity';
    
    /**
     * @param int $id
     * @return \ModuleModel\Entity\CompanyEntity
     */
    public function get($id)
    {
        return $this->em()->find($this->entity, $id);
    }
    
    /**
     * @return array[\ModuleModel\Entity\CompanyEntity]
     */
    public function fetchAll(array $params = [])
    {
        return $this->em()->getRepository($this->entity)->findAll();
    }
}
