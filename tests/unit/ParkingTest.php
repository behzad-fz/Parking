<?php

namespace Tests\unit;

use App\Entities\Car;
use App\Entities\Contracts\CarContract;
use App\Entities\Contracts\ParkingContract;
use App\Entities\Parking;
use PHPUnit\Framework\TestCase;

class ParkingTest extends TestCase
{
    private CarContract $car;

    public function setUp(): void
    {
        parent::setUp();

        $this->car = new Car();
        $this->car->setLicensePlate('AB 12 CD');
    }
    /**
     * Test if can create a new parking without passing capacity
     */
    public function test_create_new_parking_without_passing_capacity()
    {
        $this->expectError();

        $parking = new Parking();
    }

    /**
     * Test if can create a new parking
     */
    public function test_create_new_parking()
    {
        $parking = new Parking(500);
        $this->assertIsObject($parking);
        $this->isInstanceOf(ParkingContract::class);
    }

    /**
     * Test if can park a car
     */
    public function test_park_a_car()
    {
        $parking = new Parking(500);

        $this->assertEquals("Car is parked!", $parking->park($this->car));
        $this->assertCount(1, $parking->getAllParkedCars());
    }

    /**
     * Test if shows a failed message if can't park
     */
    public function test_park_a_car_when_there_is_no_free_spot()
    {
        $parking = new Parking(0);

        $this->assertEquals("Capacity is full! Failed to park the car!", $parking->park($this->car));
    }

    /**
     * Test if shows a failed message if can't find the car
     */
    public function test_unpark_a_car_which_has_not_been_parked_in_parking()
    {
        $parking = new Parking(5);

        $car1 = new Car();
        $car1->setLicensePlate('AAAAA');

        $car2 = new Car();
        $car2->setLicensePlate('BBBBB');

        $this->assertCount(0, $parking->getAllParkedCars());

        $parking->park($car1);
        $this->assertCount(1, $parking->getAllParkedCars());

        $this->assertEquals("This car does not exist in the parking!", $parking->unPark($car2));
        $this->assertCount(1, $parking->getAllParkedCars());
    }

    /**
     * Test if can un park a car
     */
    public function test_un_park_a_car()
    {
        $parking = new Parking(5);

        $car = new Car();
        $car->setLicensePlate('AAAAA');

        $this->assertCount(0, $parking->getAllParkedCars());

        $parking->park($car);

        $this->assertCount(1, $parking->getAllParkedCars());

        $this->assertEquals("Car is un parked!", $parking->unPark($car));
        $this->assertCount(0, $parking->getAllParkedCars());
    }
}
