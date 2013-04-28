<?php
namespace ModuleModel\Model\Util;

class DateUtil
{
    /**
     * @param \DateTime $date
     * @return \DateTime
     */
    public static function getDateOnlyHours(\DateTime $date)
    {
        return self::convertHoursToDate($date->format("H:i:s"));
    }
    
    /**
     * @param string $hours
     * @return \DateTime
     */
    public static function convertHoursToDate($hours)
    {
        return new \DateTime("1970-01-01 " . $hours);
    }
    
    /**
     * @param string $hours
     * @return \DateTime
     */
    public static function fillDateByHour(\DateTime $date, $hourDate)
    {
        if(!$hourDate instanceof \DateTime) {
            $hourDate = self::convertHoursToDate($hourDate);
        }
        
        return new \DateTime($date->format("Y-m-d ") . $hourDate->format("H:i:s"));
    }
}
