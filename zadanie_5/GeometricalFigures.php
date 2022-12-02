<?php

namespace zadanie_5;

class GeometricalFigures
{
    protected $figureName;
    protected $figureColor;
    protected $square;
    protected $perimeter;

    public function __construct($figureName, $figureColor)
    {
        $this->figureName = $figureName;
        $this->figureColor = ($figureColor ? $figureColor : "black");
    }

    // public function __get($name)
    // {
    //     if (isset($this->$name)) {
    //         return $this->$name;
    //     }
    // }

    // public function __set($name, $value)
    // {
    //     if (isset($this->$name)) {
    //         $this->$name = $value;
    //     }
    // }

    public function getFigureName()
    {
        return $this->figureName;
    }

    public function getFigureColor()
    {
        return $this->figureColor;
    }

    public function getSquare()
    {
        return $this->square;
    }

    public function getPerimeter()
    {
        return $this->perimeter;
    }

    public function setFigureName(string $name)
    {
        $this->figureName = $name;

        return $this;
    }

    public function setFigureColor(string $figureColor)
    {
        $this->figureColor = $figureColor;

        return $this;
    }

    public function returnData()
    {
        $data = get_object_vars($this);
        $names = [
            'figureName' => 'Название',
            'figureColor' => 'Цвет',
            'square' => 'Площадь',
            'perimeter' => 'Периметр'
        ];
        $html = '';
        foreach ($data as $key => $value) {
            $name = (isset($names[$key]) ? $names[$key] : $key);
            $html .= "$name : $value </br>";
        }
        return $html;
    }
}
