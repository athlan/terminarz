<?php

namespace ModuleModelTest\Model\Util;

use ModuleModelTest\Bootstrap;

abstract class AbstractModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \ModuleModel\Model\UserModel
     */
    public function getModelUser() {
        return Bootstrap::getServiceManager()->get('ModuleModel\User');
    }
    
    /**
     * @return \ModuleModel\Model\CompanyModel
     */
    public function getModelCompany() {
        return Bootstrap::getServiceManager()->get('ModuleModel\Company');
    }
    
    /**
     * @return \ModuleModel\Model\ScheduleModel
     */
    public function getModelSchedule() {
        return Bootstrap::getServiceManager()->get('ModuleModel\Schedule');
    }
}
