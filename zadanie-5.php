<?php

include_once "zadanie_5/Square.php";
include_once "zadanie_5/Rectangle.php";
include_once "zadanie_5/Circle.php";

use zadanie_5\Square;
use zadanie_5\Rectangle;
use zadanie_5\Circle;

echo 'Квадрат</br>' . (new Square(13))->setSideLength(456)->perimeter()->returnData() . '</br></br>';
echo 'Круг</br>' . (new Circle(46))->setRadius(12)->setFigureColor('red')->square()->returnData() . '</br></br>';
echo 'Прямоугольник</br>' . (new Rectangle(46, 22, 'white'))->setHeight(12)->square()->perimeter()->returnData() . '</br></br>';