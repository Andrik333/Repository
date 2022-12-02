<?php

namespace zadanie_6;

class Calculate
{
    private $n1;
    private $n2;

    public function __construct(float $n1, float $n2)
    {
        $this->n1 = $n1;
        $this->n2 = $n2;
    }

    public function summa()
    {
        return $this->n1 + $this->n2;
    }

    public function altSumma()
    {
        $n1 = $this->n1;
        $n2 = $this->n2;

        $sum = 0;

        for($i = 1; $i <= $n1; $i++)
        {
            $sum++;
        }

        for($i = 1; $i <= $n2; $i++)
        {
            $sum++;
        }

        return $sum;
    }

    public function proizvedenie()
    {
        return $this->n1 * $this->n2;
    }

    public function raznica()
    {
        return $this->n1 - $this->n2;
    }

    public function delenie()
    {
        if ($this->n2 == 0) {
            return "Деление на 0";
        } else {
            return $this->n1 / $this->n2;
        }
    }
}