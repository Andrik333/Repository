<?php

namespace zadanie_5;

include_once "GeometricalFigures.php";

class Rectangle extends GeometricalFigures
{
    private $height;
    private $width;

    public function __construct(float $height, float $width, string $figureColor = null)
    {
        parent::__construct('прямоугольник', $figureColor);
        $this->height = $height;
        $this->width = $width;
        $this->square();
        $this->perimeter();
    }

    public function square()
    {
        $this->square = $this->height * $this->width;
    
        return $this;
    }

    public function perimeter()
    {
        $this->perimeter = ($this->height + $this->width) * 2;
    
        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setWidth(float $width)
    {
        $this->width = $width;

        return $this;
    }

    public function setHeight(float $height)
    {
        $this->height;

        return $this;
    }
}
