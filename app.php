<?php

use App\Entities\Parking;
use App\Entities\Car;

// create a parking with the capacity of 10 spots
$parking = new Parking(10);

// try to park 11 cars in row
for ($i = 1; $i <= 11; $i++) {
    $car = new Car();
    $car->setLicensePlate(sprintf('AM %s NL', $i));

    echo $parking->park($car);
    echo "\n";
}

// remove 2 random cars from parking
$cars = $parking->getAllParkedCars();
$randomKeys = array_rand($cars, 2);

echo $parking->unPark($cars[$randomKeys[0]]);
echo "\n";
echo $parking->unPark($cars[$randomKeys[1]]);
echo "\n";

// try to park 3 cars in row
for ($i = 1; $i <= 3; $i++) {
    $car = new Car();
    $car->setLicensePlate(sprintf('UT %s NL', $i));

    echo $parking->park($car);
    echo "\n";
}
