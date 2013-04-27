<?php

namespace ModuleModel\Entity;

class ScheduleTypeEnum
{
    const DEFINED = 0x00;
    const USER_CHOISE = 0x01;
    
    public static function valueOf($value) {
        switch (strtoupper($value)) {
            case 'DEFINED' :
                return self::DEFINED;
            case 'USER_CHOISE' :
                return self::USER_CHOISE;
        }
    
        return null;
    }
    
    public static function valueOfString($value) {
        switch ($value) {
            case self::DEFINED :
                return 'DEFINED';
            case self::USER_CHOISE :
                return 'USER_CHOISE';
        }
    
        return null;
    }
    
    public static function toString($value) {
        switch ($value) {
            case self::DEFINED :
                return 'Defined';
            case self::USER_CHOISE :
                return 'User choise';
        }
        
        return null;
    }
}
