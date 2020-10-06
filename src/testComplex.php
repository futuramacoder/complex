<?php

require __DIR__.'/../vendor/autoload.php';

use Complex\Complex as Complex;
use Complex\ComplexOperation;

$complexOperation = new ComplexOperation();

$values = [
    new Complex(123),
    new Complex(456, 123),
];

foreach ($values as $value) {
    echo $value, PHP_EOL;
}

echo 'Addition', PHP_EOL;

$result = $complexOperation->add(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;

echo '==================================================================', PHP_EOL;

echo PHP_EOL;

echo 'Divide', PHP_EOL;

$result = $complexOperation->divide(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;

echo '==================================================================', PHP_EOL;

echo PHP_EOL;

echo 'Substract', PHP_EOL;

$result = $complexOperation->subtract(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;

echo '==================================================================', PHP_EOL;

echo PHP_EOL;

echo 'Multiply', PHP_EOL;

$result = $complexOperation->multiply(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;