<?php

namespace Tests\unit;

use App\Entities\Car;
use App\Entities\Contracts\CarContract;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    /**
     * Test if can create a new car
     */
    public function test_create_new_car()
    {
        $car = new Car();
        $this->assertIsObject($car);
        $this->isInstanceOf(CarContract::class);
    }

    /**
     * Test if can set license plate for car and retrieve it
     */
    public function test_set_and_get_license_plate()
    {
        $car = new Car();
        $car->setLicensePlate('AB 12 CD');
        $this->assertEquals($car->getLicensePlate(), 'AB 12 CD');
    }
}
