<?php

namespace zadanie_7;

class Table
{
    public static function create(array $title, array $data)
    {
        $html = '<table style="border-collapse: collapse"><thead><tr>';
        foreach ($title as $value) {
            $html .= '<th style="border: 1px solid;">' . $value . '</th>';
        }
        $html .= '</tr></thead><tbody>';
        foreach ($data as $tr) {
            $html .= '<tr>';
            foreach ($title as $key => $value) {
                $html .= '<td style="border: 1px solid; padding: 3px 5px">' . $tr[$key] . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        return $html;
    }
}