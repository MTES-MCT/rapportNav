<?php


namespace App\Helper;


use DateTime;
use Exception;

class TimeConvert {
    /**
     * @param int|null $minutes
     *
     * @return DateTime|null
     * @throws Exception
     */
    static public function minutesToTime(?int $minutes): ?DateTime {
        if(null === $minutes) {
            return null;
        }

        $hour = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;


        try {
            $time = new DateTime($hour.":".$remainingMinutes);
        } catch(Exception $e) {
            throw new Exception($e->getCode()." : ".$e->getMessage().
                "Transforming {$minutes} minutes to {$hour}:{$remainingMinutes} as a Time : ".
                $e->getTraceAsString());
        }
        return $time;
    }

}