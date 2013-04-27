<?php

namespace ModuleModel\Entity;

class UserScopeEnum
{
    const NATIVE = 0x00;
    const FACEBOOK = 0x01;
    
    public static function valueOf($value) {
        switch (strtoupper($value)) {
            case 'NATIVE' :
                return self::NATIVE;
            case 'FACEBOOK' :
                return self::FACEBOOK;
        }
    
        return null;
    }
    
    public static function valueOfString($value) {
        switch ($value) {
            case self::NATIVE :
                return 'NATIVE';
            case self::FACEBOOK :
                return 'FACEBOOK';
        }
    
        return null;
    }
    
    public static function toString($value) {
        switch ($value) {
            case self::NATIVE :
                return 'Native';
            case self::FACEBOOK :
                return 'Facebook';
        }
        
        return null;
    }
}
