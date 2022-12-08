<?php

namespace src;

class Components
{
    public static function formatDate(string $date = 'now', string $format = 'Y.m.d H:i') : string
    {
        return (new \DateTime($date))->format($format);
    }

    public static function dateDB(string $date = 'now') : string
    {
        return (new \DateTime($date))->format('Y-m-d H:i:s');
    }

    public static function getValue($value, string $levels = null, $returnIsNull = null)
    {
        if ($levels) {
            $levels = explode('.', $levels);

            foreach ($levels as $level) {
                if (is_object($value)) {
                    $value = isset($value->$level) ? $value->$level : $returnIsNull;
                } else if (is_array($value)) {
                    $value = isset($value[$level]) ? $value[$level] : $returnIsNull;
                }
            }
        } else {
            $value = isset($value) ? $value : $returnIsNull;
        }

        return $value;
    }
}