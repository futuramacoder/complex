<?php

namespace Complex;

use Complex\Complex as Complex;
use Exception;

class ComplexOperation
{
    public function validateComplexArgument($complex): Complex
    {
        if (is_scalar($complex) || is_array($complex)) {
            $complex = new Complex($complex);
        } elseif (!is_object($complex) || !($complex instanceof Complex)) {
            throw new Exception('Value is not a valid complex number');
        }

        return $complex;
    }

    public function add(...$complexNumbers): Complex
    {
        if (count($complexNumbers) < 2) {
            throw new \Exception('This function requires at least 2 arguments');
        }

        $base = array_shift($complexNumbers);
        $result = clone $this->validateComplexArgument($base);

        foreach ($complexNumbers as $complex) {
            $complex = $this->validateComplexArgument($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Suffix Mismatch');
            }

            $real = $result->getReal() + $complex->getReal();
            $imaginary = $result->getImaginary() + $complex->getImaginary();

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }

    function divide(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('This function requires at least 2 arguments');
        }

        $base = array_shift($complexValues);
        $result = clone $this->validateComplexArgument($base);

        foreach ($complexValues as $complex) {
            $complex = $this->validateComplexArgument($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Suffix Mismatch');
            }
            if ($complex->getReal() == 0.0 && $complex->getImaginary() == 0.0) {
                throw new \InvalidArgumentException('Division by zero');
            }

            $delta1 = ($result->getReal() * $complex->getReal()) +
                ($result->getImaginary() * $complex->getImaginary());
            $delta2 = ($result->getImaginary() * $complex->getReal()) -
                ($result->getReal() * $complex->getImaginary());
            $delta3 = ($complex->getReal() * $complex->getReal()) +
                ($complex->getImaginary() * $complex->getImaginary());

            $real = $delta1 / $delta3;
            $imaginary = $delta2 / $delta3;

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }

    function subtract(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('This function requires at least 2 arguments');
        }

        $base = array_shift($complexValues);
        $result = clone $this->validateComplexArgument($base);

        foreach ($complexValues as $complex) {
            $complex = $this->validateComplexArgument($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Suffix Mismatch');
            }

            $real = $result->getReal() - $complex->getReal();
            $imaginary = $result->getImaginary() - $complex->getImaginary();

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }

    function multiply(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('This function requires at least 2 arguments');
        }

        $base = array_shift($complexValues);
        $result = clone $this->validateComplexArgument($base);

        foreach ($complexValues as $complex) {
            $complex = $this->validateComplexArgument($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Suffix Mismatch');
            }

            $real = ($result->getReal() * $complex->getReal()) -
                ($result->getImaginary() * $complex->getImaginary());
            $imaginary = ($result->getReal() * $complex->getImaginary()) +
                ($result->getImaginary() * $complex->getReal());

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }
}