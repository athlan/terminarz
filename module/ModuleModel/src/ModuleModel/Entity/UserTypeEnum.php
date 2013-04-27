<?php

namespace ModuleModel\Entity;

class UserTypeEnum
{
    const INDIVIDUAL = 0x00;
    const COMPANY = 0x01;
    
    public static function valueOf($value) {
        switch (strtoupper($value)) {
            case 'INDIVIDUAL' :
                return self::INDIVIDUAL;
            case 'COMPANY' :
                return self::COMPANY;
        }
    
        return null;
    }
    
    public static function valueOfString($value) {
        switch ($value) {
            case self::INDIVIDUAL :
                return 'INDIVIDUAL';
            case self::COMPANY :
                return 'COMPANY';
        }
    
        return null;
    }
    
    public static function toString($value) {
        switch ($value) {
            case self::INDIVIDUAL :
                return 'Individual';
            case self::COMPANY :
                return 'Company';
        }
        
        return null;
    }
}
