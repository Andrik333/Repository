<?php

include_once "zadanie-2.php";

ob_clean();

function arrayRand(int $count, int $min = 1, int $max = 100)
{
    $arr = [];

    for ($i = 0; $i < $count; $i++) {
        $n = rand($min, $max);
        if (in_array($n, $arr)) {
            $i--;
        } else {
            $arr[] = $n;
        }
        
    }

    return $arr;
}

function createArrays(int $countArrays, int $count, int $min = 1, int $max = 10)
{
    $arrays = [];

    while ($countArrays > 0) {
        $arrays[] = arrayRand($count, $min, $max);
        $countArrays--;
    }

    return $arrays;
}

function n1()
{
    $sum = 0;
    $arr = arrayRand(15);

    foreach ($arr as $key => $value) {
        if ($key % 2) {
            continue;
        }
        $sum += $key;
    }

    return $sum;
}

echo "Задание 1: " . n1() . "</br></br>";

function n2(int $k)
{
    $arr = arrayRand(25);
    $sum = 0;

    if ($k < 50) {
        $k = 51;
    } else if (!($k % 2)) {
        $k++;
    }

    foreach ($arr as $value) {
        if ($value > $k) {
            $sum += $value;
        }
    }

    return $sum;
}

echo "Задание 2: " . n2(52) . "</br></br>";

function n3_3()
{
    $arrays = createArrays(7, 5, 1, 10);
    $sum = 0;

    foreach ($arrays as $array) {
        $sum = array_sum($array);
    }

    return $sum;
}

echo "Задание 3: " . n3_3() . "</br></br>";

function arraySorts(array $arrays)
{
    foreach ($arrays as $key => &$array) {
        if($key % 2) {
            usort($array, function($a, $b) {
                return ($a < $b) ? 1 : -1;
            });
        } else {
            usort($array, function($a, $b) {
                return ($a < $b) ? -1 : 1;
            });
        }
    }

    return $arrays;
}

function createTable($arrays)
{
    $html = "<table><tbody>";

    foreach ($arrays as $array) {
        $html .= "<tr>";
        foreach ($array as $item) {
            $html .= "<td style =\"border: 1px solid; padding: 5px;\">$item</td>";
        }
        $html .= "</tr>";
    }

    $html .= "</tbody></table>";

    return $html;
}

echo createTable(arraySorts(createArrays(6, 6, 1, 10)));