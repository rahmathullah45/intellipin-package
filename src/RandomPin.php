<?php

namespace Rahmat\Intellipin;

use Rahmat\Intellipin\Models\Pin;


class RandomPin{

    public static function generate(){
        $random_pin = self::generateRandomNumber();
        $random_pin = intval($random_pin);
        $pin = self::pinValidate($random_pin);
        $utilised = Pin::where('pin',$random_pin)->first();
        if($utilised){
            self::generate();
        }
        else{
            Pin::create(['pin'=>$random_pin]);
            return $random_pin;
        }
    }

    private static function pinValidate($random_pin){
        $validated_pin = self::palindromeCheck($random_pin);
        if($random_pin==$validated_pin){
            self::generate();
        }
        else{
            return $random_pin;
        }
    }

    private static function palindromeCheck($n){  
        $number = $n;  
        $sum = 0;  

        while(floor($number)) {  
            $rem = $number % 10;  
            $sum = $sum * 10 + $rem;  
            $number = $number/10;  
        }  

        return $sum;  
    }
    
    public static function generateRandomNumber($length = 4) {
        $number = '';
        $prev = '';
    
        while (strlen($number) < $length) {
            $digit = mt_rand(1, 9);
            if ($prev != $digit && $prev != $digit - 1) {
                $number .= $digit;
                $prev = $digit;
            }
        }
    
        return $number;
    }

    //tested method
    /*public static function generateRandomNumber($length = 4) {
        $digits = range(1, 9);
           shuffle($digits);
           $pin = '';
           while (strlen($pin) < $length) {
               // Get a random digit from the shuffled array
               $digit = array_pop($digits);
               // Check if the digit would create a sequence with the last digit in the pin
               if (strlen($pin) > 0 && ($digit == $pin[strlen($pin) - 1] - 1 || $digit == $pin[strlen($pin) - 1] + 1)) {
                   // Skip this digit and shuffle the array again
                   shuffle($digits);
               } elseif (strlen($pin) == 0 || !in_array($digit, str_split($pin))) {
                   // Add the digit to the pin if it is not already in the pin
                   $pin .= $digit;
               }
           }
           return $pin;
    }*/
}