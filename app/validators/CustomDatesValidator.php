<?php

class CustomDatesValidator extends Illuminate\Validation\Validator
{

    public function validateFoo($attribute, $value, $parameters)
    {
        $date1 = date_create(date("Y-m-d", strtotime($value)));
        $date2 = date();
        $diff = date_diff($date1, $date2);
        if ($diff < 0) {
            $return = false;
            echo 'Start Date can not be less than today';
        }
        $return = true;

        return $return;
    }

}
