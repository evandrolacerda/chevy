<?php
namespace App\Services\Util;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendar
 *
 * @author evandro
 */
class Calendar {

    public static function getFirstBussinnesDayFrom($month, $year) {
        $timeString = "first day of {$month} {$year}";

        $firstDay = new \Carbon\Carbon($timeString);
        
        if( self::isBussinessDay($firstDay) ){
            return $firstDay;
        }else{
            
            while ( true )
            {
                $nextDate = $firstDay->addDay();
                if( self::isBussinessDay($nextDate)){
                    return $nextDate;
                }
                
            }
        }
            
    }

    public static function isBussinessDay(\Carbon\Carbon $date) {

        if ($date->isWeekend() || self::isHoliday($date)) {
            return false;
        }
        
        return true;
    }

    public static function isHoliday(\Carbon\Carbon $date) {
        $hollydays = ['2018-01-03','2018-01-08','2018-01-01', 
            '2018-02-02', '2018-02-05', '2018-03-01', '2018-03-02'];
        
        if(in_array($date->toDateString(), $hollydays)){
            return true;
        }
        return false;
    }
    
    public static function getAllBussinnesDayFrom( int $month, int $year )
    {
        $bussinnesDays = [];
        
        $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        for( $day = 1; $day <= $totalDaysInMonth; $day++)
        {
            $date = \Carbon\Carbon::create( $year, $month, $day );
            
            if( self::isBussinessDay($date))
            {
                $bussinnesDays[] = $date;
            }
        }
        
        return $bussinnesDays;
    }

}
