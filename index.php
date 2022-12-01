<?php

function n1(int $x, int $y, int $z)
{
    $pow = pow($x, $z);
    $del = $y / $z;
    $sum = $y + $x;
    $proizv = $del * $sum;
    $raz = $pow - $proizv;

    return $raz;
}

echo "Задание 1: " . n1(5, 3, 8) . "</br></br>";

function n2(int $x)
{
    if ($x < 0) return "Число должно быть положительным.";

    if ($x % 2) {
        $res = pow(2, ($x - $x));
    } else {
        $res = ($x + $x) / 2;
    }

    return $res;
}

echo "Задание 2: " . n2(6) . "</br></br>";

function n3(int $x)
{
    if ($x < 0) return "Число должно быть положительным.";

    $res = 0;

    for($i = 1; $i <= $x; $i++) {
        $res += $i;
    }

    return $res;
}

echo "Задание 3: " . n3(4) . "</br></br>";
