<?php

namespace App\Entities;

use App\Entities\Contracts\CarContract;

class Car implements CarContract
{
    private string $licensePlate;

    public function setLicensePlate(string $licensePlate): void
    {
        $this->licensePlate = $licensePlate;
    }

    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }
}