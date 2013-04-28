<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ModuleModel;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    
    'service_manager' => array(
        'invokables' => array(
            'ModuleModel\User' => 'ModuleModel\Model\UserModel',
            'ModuleModel\Company' => 'ModuleModel\Model\CompanyModel',
            'ModuleModel\Schedule' => 'ModuleModel\Model\ScheduleModel',
            'ModuleModel\Event' => 'ModuleModel\Model\EventModel',
        ),
    ),
    
);
