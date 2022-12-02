<?php

namespace zadanie_5;

include_once "GeometricalFigures.php";

class Circle extends GeometricalFigures
{
    private $radius;

    public function __construct(float $radius, string $figureColor = null)
    {
        parent::__construct('круг', $figureColor);
        $this->radius = $radius;
        $this->square();
        $this->perimeter();
    }

    public function square()
    {
        $this->square = M_PI * pow($this->radius, 2);

        return $this;
    }

    public function perimeter()
    {
        $this->perimeter = 2 * $this->radius * M_PI;
    
        return $this;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function setRadius(float $radius)
    {
        $this->radius = $radius;

        return $this;
    }
}
