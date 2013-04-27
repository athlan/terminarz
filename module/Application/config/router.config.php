<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

return array(
    'home' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
            'route'    => '/',
            'defaults' => array(
                'controller' => 'Application\Controller\Index',
                'action' => 'index',
            ),
        ),
    ),
    
    'dashboard' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
            'route' => '/dashboard',
            'defaults' => array(
                'controller' => 'Application\Controller\Dashboard',
                'action'     => 'index',
            ),
        ),
    ),
    
    'setLanguage' => array(
        'type' => 'segment',
        'options' => array(
            'route'    => '/language/:lang',
            'defaults' => array(
                'controller' => 'Application\Controller\Language',
                'action' => 'setLanguage',
            ),
        ),
    ),
    
    'fixtures' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
            'route'    => '/fixtures',
            'defaults' => array(
                'controller' => 'Application\Controller\IndexFixtures',
                'action' => 'index',
            ),
        ),
    ),
);
