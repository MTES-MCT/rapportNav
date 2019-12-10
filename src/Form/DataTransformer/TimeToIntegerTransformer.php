<?php


namespace App\Form\DataTransformer;


use DateTimeImmutable;
use Symfony\Component\Form\DataTransformerInterface;

class TimeToIntegerTransformer implements DataTransformerInterface {
    /**
     * @param mixed $value
     *
     * @return DateTimeImmutable|null
     */
    public function transform($value) {
        if(null === $value) {
            return null;
        }
        $hours = floor($value / 60);
        $minutes = $value - $hours * 60;
        $dateString = "t".$this->intHourToString($hours).":".$this->intHourToString($minutes);
        try {
            $time = new DateTimeImmutable($dateString);
        } catch(\Exception $e) {
            return null;
        }
        return $time;
    }

    /**
     * @param $time
     *
     * @return int|void
     */
    public function reverseTransform($time) {
        if(null === $time) {
            return null;
        }
        /** @var \DateTime $time */
        $minutes = (int)$time->format("i") + (int)$time->format("G") * 60;

        return $minutes;
    }

    /**
     * Helper to transform an int to a 2 char string containing the value
     *
     * eg. 2 => "02", 15 => "15"
     *
     * @param int $hour
     *
     * @return string
     */
    private function intHourToString($hour) {
        $text = (string)((int)$hour);
        if(mb_strlen($text) < 2) {
            $text = "0".$text;
        }
        return $text;
    }

}