<?php

namespace Rahmat\Intellipin;

use Rahmat\Intellipin\Models\Pin;


class RandomPin{

    private static $length = 4;

    public static function generate($length=4){
        if($length<4){
            return response()->json(['error' => "Minimum pin character length is 4"]);
        }
        if($length>12){
            return response()->json(['error' => "Maximum pin character length is 12"]);
        }
        self::$length = $length;
        $random_pin = self::generateRandomNumber(self::$length);
        $random_pin = intval($random_pin);
        $pin = self::pinValidate($random_pin);
        $utilised = Pin::where('pin',$random_pin)->first();
        if($utilised){
            self::generate(self::$length);
        }
        else{
            Pin::create(['pin'=>$random_pin]);
            return $random_pin;
        }
    }

    private static function pinValidate($random_pin){
        $validated_pin = self::palindromeCheck($random_pin);
        if($random_pin==$validated_pin){
            self::generate(self::$length);
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
    
    public static function generateRandomNumber($length) {
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
}