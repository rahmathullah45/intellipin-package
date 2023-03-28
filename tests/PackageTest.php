<?php

namespace Rahmat\Intellipin\Tests;


use Tests\TestCase;
use Rahmat\Intellipin\Models\Pin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Rahmat\Intellipin\RandomPin;

class PackageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_package_database()
    {
        $random_pin=Pin::create(['pin' => mt_rand(1111,9999)]);

        $this->assertNotEmpty($random_pin);
    }

    public function test_pin_length(){
        $random_pin = RandomPin::generate(6);
        $this->assertSame(strlen((string)$random_pin),6);
    }

    public function test_palindrome(){

        $random_pin = RandomPin::generate();
        $number = $random_pin;  
        $sum = 0;  

        while(floor($number)) {  
            $rem = $number % 10;  
            $sum = $sum * 10 + $rem;  
            $number = $number/10;  
        }  

        $this->assertTrue($random_pin != $sum);
    }
}
