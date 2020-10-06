<?php
namespace Complex;
class Complex {
    private float $real = 0.0;

    private float $imaginary = 0.0;

    private ?string $suffix;

    public function __construct($real = 0.0, $imaginary = null, $suffix = 'i')
    {
        if(isset($imaginary)) {
            $this->imaginary = floatval($imaginary);
        }

        if ($imaginary != 0.0 && empty($suffix)) {
            $suffix = 'i';
        } elseif ($imaginary == 0.0 && !empty($suffix)) {
            $suffix = '';
        }

        $this->real = floatval($real);
        $this->suffix = $suffix;
    }

    public function getReal(): float
    {
        return $this->real;
    }

    public function getImaginary(): float
    {
        return $this->imaginary;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    public function isReal(): bool
    {
        return $this->imaginary == 0.0;
    }

    public function isComplex(): bool
    {
        return !$this->isReal();
    }

    public function format(): string
    {
        $str = "";
        if ($this->imaginary != 0.0) {
            if (\abs($this->imaginary) != 1.0) {
                $str .= $this->imaginary . $this->suffix;
            } else {
                $str .= (($this->imaginary < 0.0) ? '-' : '') . $this->suffix;
            }
        }
        if ($this->real != 0.0) {
            if (($str) && ($this->imaginary > 0.0)) {
                $str = "+" . $str;
            }
            $str = $this->real . $str;
        }
        if (!$str) {
            $str = "0.0";
        }

        return $str;
    }

    public function __toString(): string
    {
        return $this->format();
    }
}