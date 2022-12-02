<?php

namespace zadanie_5;

include_once "GeometricalFigures.php";

class Square extends GeometricalFigures
{
    private $sideLength;

    public function __construct(float $sideLength, string $figureColor = null)
    {
        parent::__construct('квадрат', $figureColor);
        $this->sideLength = $sideLength;
        $this->square();
        $this->perimeter();
    }

    public function square()
    {
        $this->square = pow($this->sideLength, 2);
    
        return $this;
    }

    public function perimeter()
    {
        $this->perimeter = $this->sideLength * 4;

        return $this;
    }

    public function getSideLength()
    {
        return $this->sideLength;
    }

    public function setSideLength(float $sideLength)
    {
        $this->sideLength = $sideLength;

        return $this;
    }
}
