<?php

namespace ModuleModelTest\Model;

use ModuleModel\Model\Util\DateUtil;

use ModuleModel\Entity\EventEntity;

use ModuleModel\Entity\ScheduleAvailabilityEntity;

use ModuleModelTest\Bootstrap;

class EventModelTest extends Util\AbstractModelTest
{
    protected $userCompany;
    protected $userIndividual;
    
    protected $scheduleDefined;
    protected $scheduleUserChoise;
    protected $serviceList;
    
    protected $scheduledEvents;
    
    public function testAddEventTooEarly()
    {
        $event = new EventEntity();
        $event->setSchedule($this->scheduleUserChoise);
        $event->setService($this->serviceList[0]);
        $event->setDurationStart(new \DateTime("2013-05-01 03:00:00")); // it is thursday
        $event->setDurationStop(new \DateTime("2013-05-01 05:00:00"));
        
        $model = $this->getModelEvent();
    
        try {
            $model->saveToScheduleUserChoise($event);
        }
        catch(\Exception $e) {
            $this->assertEquals("Event is planned to early", $e->getMessage());
            return;
        }
    
        $this->fail("An exception expected");
    }
    
    public function testAddEventTooEarlyIntersect()
    {
        $event = new EventEntity();
        $event->setSchedule($this->scheduleUserChoise);
        $event->setService($this->serviceList[0]);
        $event->setDurationStart(new \DateTime("2013-05-01 03:00:00")); // it is thursday
        $event->setDurationStop(new \DateTime("2013-05-01 15:00:00"));
        
        $model = $this->getModelEvent();
        
        try {
            $model->saveToScheduleUserChoise($event);
        }
        catch(\Exception $e) {
            $this->assertEquals("Event is planned to early", $e->getMessage());
            return;
        }
    
        $this->fail("An exception expected");
    }
    
    public function testAddEventTooLate()
    {
        $event = new EventEntity();
        $event->setSchedule($this->scheduleUserChoise);
        $event->setService($this->serviceList[0]);
        $event->setDurationStart(new \DateTime("2013-05-01 19:00:00")); // it is thursday
        $event->setDurationStop(new \DateTime("2013-05-01 20:00:00"));
    
        $model = $this->getModelEvent();
    
        try {
            $model->saveToScheduleUserChoise($event);
        }
        catch(\Exception $e) {
            $this->assertEquals("Event is planned to late", $e->getMessage());
            return;
        }
    
        $this->fail("An exception expected");
    }
    
    public function testAddEventTooLateIntersect()
    {
        $event = new EventEntity();
        $event->setSchedule($this->scheduleUserChoise);
        $event->setService($this->serviceList[0]);
        $event->setDurationStart(new \DateTime("2013-05-01 14:00:00")); // it is thursday
        $event->setDurationStop(new \DateTime("2013-05-01 20:00:00"));
    
        $model = $this->getModelEvent();
    
        try {
            $model->saveToScheduleUserChoise($event);
        }
        catch(\Exception $e) {
            $this->assertEquals("Event is planned to late", $e->getMessage());
            return;
        }
    
        $this->fail("An exception expected");
    }
    
    public function testAddEventProperly()
    {
        $event = new EventEntity();
        $event->setSchedule($this->scheduleUserChoise);
        $event->setService($this->serviceList[0]);
        $event->setDurationStart(new \DateTime("2013-05-01 14:00:00")); // it is thursday
        $event->setDurationStop(new \DateTime("2013-05-01 15:00:00"));
    
        $model = $this->getModelEvent();
    
        $model->saveToScheduleUserChoise($event);
    
        $eventOccurecne = $model->createEventOccurence($event, $this->userIndividual);
        $model->save($eventOccurecne);
    
        $this->assertNotEmpty($event->getId());
        $this->assertNotEmpty($eventOccurecne->getId());
    }
    
    public function testAddEventDefinedOnIncorrectWeekday()
    {
        $model = $this->getModelEvent();
    
        $event = $this->scheduledEvents[0];
        
        try {
            // on monday
            $eventOccurecne = $model->createEventOccurence($event, $this->userIndividual, new \DateTime("2013-04-29 00:00:00"));
            
            $model->save($eventOccurecne);
        }
        catch(\Exception $e) {
            $this->assertEquals("Cannot join an repeatable event to the non existsing repeatable weeday", $e->getMessage());
            return;
        }
        
        $this->fail("An exception expected");
    }
    
    public function testAddEventDefinedProperly()
    {
        $model = $this->getModelEvent();
        
        $event = $this->scheduledEvents[0];
        
        $eventOccurecne = $model->createEventOccurence($event, $this->userIndividual, new \DateTime("2013-05-02 00:00:00"));
        $model->save($eventOccurecne);
        
        $this->assertNotEmpty($eventOccurecne->getId());
    }
    
    public function setUp()
    {
        parent::setUp();
        
        // create user...
        $user = new \ModuleModel\Entity\UserEntity();
        $user->setUsername('test@example.com');
        $user->setType(\ModuleModel\Entity\UserTypeEnum::COMPANY);
        $user->setScope(\ModuleModel\Entity\UserScopeEnum::NATIVE);
        
        $this->getModelUser()->save($user);
        $this->userCompany = $user;
        
        // create user...
        $user = new \ModuleModel\Entity\UserEntity();
        $user->setUsername('test@example.com');
        $user->setType(\ModuleModel\Entity\UserTypeEnum::INDIVIDUAL);
        $user->setScope(\ModuleModel\Entity\UserScopeEnum::NATIVE);
        
        $this->getModelUser()->save($user);
        $this->userIndividual = $user;
        
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
            // user choice schedule open hours
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
            
            // user choice schedule open hours
            $scheduleAvailability = new \ModuleModel\Entity\ScheduleAvailabilityEntity();
            $scheduleAvailability->setSchedule($this->scheduleUserChoise);
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
        
        // create scheduled events
        $this->scheduledEvents = [];
        
        $event = new EventEntity();
        $event->setSchedule($this->scheduleDefined);
        $event->setService($this->serviceList[0]);
        $event->setRepeatDateStart(DateUtil::getDateOnlyHours(new \DateTime("2013-05-01 14:00:00"))); // it is thursday
        $event->setRepeatDateStop(DateUtil::getDateOnlyHours(new \DateTime("2013-05-01 15:00:00"))); // it is thursday
        $event->setRepeatWeekday(4);
        
        $this->getModelEvent()->save($event);
        $this->scheduledEvents[0] = $event;
    }
    
    public function tearDown()
    {
        parent::tearDown();
        
//         $model = $this->getModelSchedule();
//         foreach ($model->fetchAll() as $entity) {
//             $model->remove($entity);
//         }
        
//         var_dump($model->fetchAll());
        
//         die('CHUJJJJJ');
//         var_dump($entity);
//         $model = $this->getModelCompany();
        
//         foreach ($model->fetchAll() as $entity) {
//             $model->remove($entity);
//         }
        
        $model = $this->getModelUser();
        foreach ($model->fetchAll() as $entity) {
            $model->remove($entity);
        }
    }
}
