<?php

namespace App\Traits;

use Exception;

trait RegexRange
{
    protected function regex_range(int $from, int $to)
    {
        if ($from < 0 || $to < 0) {
            throw new Exception("Negative values not supported");
        }

        if ($from > $to) {
            return false;
        }

        $ranges = array($from);
        $increment = 1;
        $next = $from;
        $higher = true;

        while (true) {

            $next += $increment;

            if ($next + $increment > $to) {
                if ($next <= $to) {
                    $ranges[] = $next;
                }
                $increment /= 10;
                $higher = false;
            } else if ($next % ($increment * 10) === 0) {
                $ranges[] = $next;
                $increment = $higher ? $increment * 10 : $increment / 10;
            }

            if (!$higher && $increment < 10) {
                break;
            }
        }

        $ranges[] = $to + 1;

        $regex = '\\b(';

        for ($i = 0; $i < sizeof($ranges) - 1; $i++) {
            $str_from = (string)($ranges[$i]);
            $str_to = (string)($ranges[$i + 1] - 1);

            for ($j = 0; $j < strlen($str_from); $j++) {
                if ($str_from[$j] == $str_to[$j]) {
                    $regex .= $str_from[$j];
                } else {
                    $regex .= "[" . $str_from[$j] . "-" . $str_to[$j] . "]";
                }
            }
            $regex .= "|";
        }

        return substr($regex, 0, strlen($regex) - 1) . ')\\b';
    }
}
