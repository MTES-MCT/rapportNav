<?php


namespace App\Form\DataTransformer;


use DateTime;
use Exception;
use Symfony\Component\Form\DataTransformerInterface;
use App\Helper\TimeConvert;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TimeToIntegerTransformer implements DataTransformerInterface {
    /**
     * @param mixed $value
     *
     * @return DateTime|null
     */
    public function transform($value) {

        try {
            $time = TimeConvert::minutesToTime($value);
        } catch(Exception $e) {
            throw new TransformationFailedException("Error transforming ".$value.". Helper returned following error : (".
                $e->getCode().") ".
                $e->getMessage());
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
        /** @var DateTime $time */
        $minutes = (int)$time->format("i") + (int)$time->format("G") * 60;

        return $minutes;
    }

}