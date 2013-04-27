<?php

namespace ModuleModel\InputFilter;

use Zend\InputFilter\BaseInputFilter;

use Zend\InputFilter\Factory as InputFactory;

class ModuleInputFilter extends BaseInputFilter
{
    public function __construct(array $options = [])
    {
        $factory = new InputFactory();
        
        $this->add($factory->createInput([
            'name'     => 'id',
            'required' => false,
            'validators'  => [
                ['name' => 'Digits'],
            ],
        ]));
        
        $this->add($factory->createInput([
            'name'     => 'name',
            'required' => true,
            'validators'  => [
            //                 ['name' => 'Explode']
            ],
        ]));
        
        $this->add($factory->createInput([
            'name'     => 'content',
            'required' => true,
            'validators'  => [
            //                 ['name' => 'Explode']
            ],
        ]));
        
        $this->add($factory->createInput([
            'name'     => 'slug',
            'required' => true,
            'validators'  => [
            ],
        ]));
        
    }
}
