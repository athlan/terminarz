<?php

namespace ModuleModelTest\Model;

use ModuleModel\Entity\ScheduleAvailabilityEntity;

use ModuleModelTest\Bootstrap;

class BoxModelTest extends Util\AbstractModelTest
{
    protected $scheduleDefined;
    protected $scheduleUserChoise;
    protected $serviceList;
    
    public function testClearEntities()
    {
        $this->assertEquals(0, 1);
    }
    
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
        $schedule->setName('Terminarz zamkniety');
        $schedule->setBookingAheadTime(60 * 60 * 24 * 14); // 2 weeks ahead
        $schedule->setCalendarGranulationMinMinutes(15);
        
        $this->getModelSchedule()->save($schedule);
        $this->scheduleDefined = $schedule;
        
        // create schedule...
        $schedule = new \ModuleModel\Entity\ScheduleEntity();
        $schedule->setCompany($company);
        $schedule->setName('Terminarz otwarty');
        $schedule->setType(\ModuleModel\Entity\ScheduleTypeEnum::USER_CHOISE);
        $schedule->setBookingAheadTime(60 * 60 * 24 * 14); // 2 weeks ahead
        $schedule->setCalendarGranulationMinMinutes(15);
        
        $this->getModelSchedule()->save($schedule);
        $this->scheduleUserChoise = $schedule;
        
        // create services
        $this->serviceList = [];
        $serviceMockups = [
            ['Siłownia 60min', 9.99, 1, 60],
            ['Siłownia 90min', 12.99, 1, 90],
        ];
        
        foreach ($serviceMockups as $row) {
            $service = new \ModuleModel\Entity\ServiceEntity();
            $service->setCompany($company);
            $service->setName($row[0]);
            $service->setPrice($row[1]);
            $service->setQuantity($row[2]);
            $service->setDurationInMinutes($row[3]);
            
            $this->getModelCompany()->save($service);
            
            $this->serviceList[] = $service;
        }
        
        // configure hours
        foreach (range(1,6) as $day) {
            $scheduleAvailability = new \ModuleModel\Entity\ScheduleAvailabilityEntity();
            $scheduleAvailability->setSchedule($this->scheduleDefined);
            $scheduleAvailability->setRepeatWeekday($day);
            
            if($day != 6) {
                $scheduleAvailability->setDurationStart(new \DateTime("1970-01-01 08:00:00"));
                $scheduleAvailability->setDurationStop(new \DateTime("1970-01-01 16:00:00"));
            }
            else {
                $scheduleAvailability->setDurationStart(new \DateTime("1970-01-01 09:00:00"));
                $scheduleAvailability->setDurationStop(new \DateTime("1970-01-01 13:00:00"));
            }
            
            $this->getModelSchedule()->save($scheduleAvailability);
        }
    }
    
    protected function tearDown()
    {
        parent::tearDown();
        
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
}
