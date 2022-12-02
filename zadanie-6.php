<?php

include_once "zadanie_6/Calculate.php";

use zadanie_6\Calculate;

$n1 = 23;
$n2 = 54;
$calc = new Calculate($n1, $n2);

echo "Сумма: " . $calc->summa() . '</br></br>';

echo "Сумма по единице: " . $calc->altSumma() . '</br></br>';

echo "Умножение: " . $calc->proizvedenie() . '</br></br>';

echo "Вычитание: " . $calc->raznica() . '</br></br>';

echo "Деление: " . $calc->delenie() . '</br></br>';