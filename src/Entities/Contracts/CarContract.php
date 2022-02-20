<?php

namespace App\Entities\Contracts;

interface CarContract
{
    public function setLicensePlate(string $licensePlate): void;

    public function getLicensePlate(): string;
}