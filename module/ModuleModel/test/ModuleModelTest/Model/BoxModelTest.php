<?php

namespace ModuleModelTest\Model;

use ModuleModelTest\Bootstrap;

class BoxModelTest extends Util\AbstractModelTest
{
    protected $scheduleDefined;
    protected $scheduleUserChoise;
    
    protected function setUp()
    {
        parent::setUp();
        
        // create user...
        $user = new \ModuleModel\Entity\UserEntity();
        $user->setUsername('test@example.com');
        $user->setType(\ModuleModel\Entity\UserTypeEnum::COMPANY);
        $user->setScope(\ModuleModel\Entity\UserScopeEnum::NATIVE);
        
        $this->getModelUser()->save($user);
        
        // create company...
        $company = new \ModuleModel\Entity\CompanyEntity();
        $company->setOwner($user);
        
        $this->getModelCompany()->save($company);
        
        // create schedule...
        $schedule = new \ModuleModel\Entity\ScheduleEntity();
        $schedule->setCompany($company);
        $schedule->setType(\ModuleModel\Entity\ScheduleTypeEnum::DEFINED);
        $schedule->setBookingAheadTime(60 * 60 * 24 * 14); // 2 weeks ahead
        $schedule->setCalendarGranulationMinMinutes(15);
        
        $this->getModelSchedule()->save($schedule);
        $this->scheduleDefined = $schedule;
        
        // create schedule...
        $schedule = new \ModuleModel\Entity\ScheduleEntity();
        $schedule->setCompany($company);
        $schedule->setType(\ModuleModel\Entity\ScheduleTypeEnum::USER_CHOISE);
        $schedule->setBookingAheadTime(60 * 60 * 24 * 14); // 2 weeks ahead
        $schedule->setCalendarGranulationMinMinutes(15);
        
        $this->getModelSchedule()->save($schedule);
        $this->scheduleUserChoise = $schedule;
        
    }
    
    protected function tearDown()
    {
        $model = $this->getModelSchedule();
        foreach ($model->fetchAll() as $entity) {
            $model->remove($entity);
        }
        
        $model = $this->getModelCompany();
        foreach ($model->fetchAll() as $entity) {
            $model->remove($entity);
        }
        
        $model = $this->getModelUser();
        foreach ($model->fetchAll() as $entity) {
            $model->remove($entity);
        }
    }
    
    public function testClearEntities()
    {
        
        $this->assertEquals(0, 1);
    }
}
