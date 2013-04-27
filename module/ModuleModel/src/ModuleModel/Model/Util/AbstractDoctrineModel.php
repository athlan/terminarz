<?php

namespace ModuleModel\Model\Util;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractDoctrineModel implements ServiceLocatorAwareInterface
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * 
     * @var ServiceLocatorInterface
     */
    private $services;
    
    /**
     * (non-PHPdoc)
     * @see Zend\ServiceManager.ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
    }
    
    /**
     * (non-PHPdoc)
     * @see Zend\ServiceManager.ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->services;
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    protected function em()
    {
        return $this->getEntityManager();
    }
    
    public function save($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->flush();
    }
    
    public function merge($entity)
    {
        $this->getEntityManager()->merge($entity);
        $this->flush();
    }
    
    public function remove($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->flush();
    }
    
    public function refresh($entity)
    {
        $this->getEntityManager()->refresh($entity);
        $this->flush();
    }
    
    public function flush()
    {
        return $this->getEntityManager()->flush();
    }
}
