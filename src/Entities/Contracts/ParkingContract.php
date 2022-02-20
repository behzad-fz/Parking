<?php

namespace App\Entities\Contracts;

interface ParkingContract
{
    public function __construct(int $capacity);

    public function park(CarContract $car): string;

    public function unPark(CarContract $car): string;

    public function getAllParkedCars(): array;
}