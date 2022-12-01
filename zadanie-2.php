<?php

function evenNumbers(int $start, int $end, int $count = 2)
{
    if ($start >= $end) return "Начальное значение не может быть больше или равно конечному.";

    $arr = [];
    $res = [];

    for ($start; $start <= $end; $start++) {
        if(!($start % 2)) $arr[] = $start;
    }

    if ((count($arr) < $count)) return "В данном диапазоне меньше $count четный чисел.";
    
    $keys = array_rand($arr, $count);

    foreach ($keys as $key) {
        $res[] = $arr[$key];
    }
    
    return implode(', ', $res);
}

echo "Задание 1 (четные): " . evenNumbers(6, 130) . "</br></br>";

function notEvenNumbers(int $start, int $end, int $count = 2)
{
    if ($start >= $end) return "Начальное значение не может быть больше или равно конечному.";

    $arr = [];
    $res = [];

    for ($start; $start <= $end; $start++) {
        if($start % 2) $arr[] = $start;
    }

    if ((count($arr) < 2)) return "В данном диапазоне меньше $count нечетный чисел.";
    
    $keys = array_rand($arr, $count);

    foreach ($keys as $key) {
        $res[] = $arr[$key];
    }
    
    return implode(', ', $res);
}

echo "Задание 1 (не четные): " . notEvenNumbers(3, 9) . "</br></br>";

function recursEven(int $start, int $end, int $count = 2, array $arr = [])
{

    $i = rand($start, $end);

    if (!($i % 2) and !in_array($i, $arr)) {
        $arr[] = $i;
    }

    if (count($arr) != $count) {
        return recursEven($start, $end, $count, $arr);
    } else {
        return implode(", ", $arr);
    }
    
}

echo "Задание 2 (четные): " . recursEven(15, 69) . "</br></br>";

function recursNotEven(int $start, int $end, int $count = 2, array $arr = [])
{

    $i = rand($start, $end);

    if ($i % 2 and !in_array($i, $arr)) {
        $arr[] = $i;
    }

    if (count($arr) != $count) {
        return recursNotEven($start, $end, $count, $arr);
    } else {
        return implode(", ", $arr);
    }
    
}

echo "Задание 2 (не четные): " . recursNotEven(4, 9) . "</br></br>";

function n3()
{
    return evenNumbers(2, 80, 10);
}

$arr3 = n3();

echo "Задание 3: " . $arr3 . "</br></br>";

function n4(int $start, int $end, $arr)
{
    if ($start > $end) return "Начальное значение не может быть больше конечного.";

    $arr = explode(", ", $arr);

    if (count($arr) < $end) return "Конечное значение выходит за диапозон";

    for ($i = $start-1; $i < $end; $i++) {
        unset($arr[$i]);
    }

    return implode(", ", array_filter($arr));
}

$arr4 = n4(2, 5, $arr3);

echo "Задание 4: " . $arr4 . "</br><br>";

function n5($arr)
{
    $arr = explode(", ", $arr);
    $res = array_shift($arr);

    foreach ($arr as $value) {
        $res -= $value;
    }

    return $res;
}

echo "Задание 5: " . n5($arr4) . "</br></br>";

function n6()
{
    return notEvenNumbers(81, 159, 5);
}

$arr6 = n6();

echo "Задание 6: " . $arr6 . "</br></br>";

function n7($arr1, $arr2)
{
    $arr1 = explode(", ", $arr1);
    $arr2 = explode(", ", $arr2);

    foreach ($arr2 as $value) {
        $arr1[] = $value;
    }

    return implode(", ", $arr1);
}

$arr7 = n7($arr6, $arr4);

echo "Задание 7: " . $arr7 . "</br></br>";

function n8($arr)
{
    $arr = explode(", ", $arr);

    for ($i = 0; $i < count($arr); $i++) {
        for ($l = 0; $l < count($arr); $l++) {
            if($arr[$i] > $arr[$l] and $i != $l) {
                [$arr[$i], $arr[$l]] = [$arr[$l], $arr[$i]];
            }
        }
    }

    return implode(", ", $arr);
}

echo "Задание 8: " . n8($arr7) . "</br></br>";