<?php

namespace App\Entities;

use App\Entities\Contracts\CarContract;
use App\Entities\Contracts\ParkingContract;

class Parking implements ParkingContract
{
    const SUCCESSFULLY_PARKED_MESSAGE = "Car is parked!";
    const SUCCESSFULLY_UN_PARKED_MESSAGE = "Car is un parked!";
    const FAILED_DUE_TO_FULL_CAPACITY_MESSAGE = "Capacity is full! Failed to park the car!";
    const CAR_NOT_FOUND = "This car does not exist in the parking!";

    private int $capacity;
    private array $parkingLots = [];
    private array $freeSpots;

    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->freeSpots = range(1, $capacity);
    }

    public function park(CarContract $car): string
    {
        if ($this->isFull()) {
            return self::FAILED_DUE_TO_FULL_CAPACITY_MESSAGE;
        }

        // park it in a random free spot
        $this->parkingLots[$this->getARandomFreeSpot()] = $car;
        $this->capacity--;

        return self::SUCCESSFULLY_PARKED_MESSAGE;
    }

    public function unPark(CarContract $car): string
    {
        foreach ($this->parkingLots as $key => $parkedCar) {
            if ($parkedCar->getLicensePlate() === $car->getLicensePlate()) {
                // remove the unparking car from parking
                unset($this->parkingLots[$key]);
                // add the freed spot to free spot list
                array_push($this->freeSpots, $key);
                $this->capacity++;

                return self::SUCCESSFULLY_UN_PARKED_MESSAGE;
            }
        }

        return self::CAR_NOT_FOUND;
    }

    public function getAllParkedCars(): array
    {
        return $this->parkingLots;
    }

    private function isFull(): bool
    {
        return $this->capacity < 1;
    }

    private function getARandomFreeSpot(): int
    {
        if (count($this->parkingLots) === $this->capacity) {
            return 0;
        }

        $randomKey = array_rand($this->freeSpots);
        $spot = $this->freeSpots[$randomKey];
        // remove the spot from free spot list
        unset($this->freeSpots[$randomKey]);

        return $spot;
    }
}