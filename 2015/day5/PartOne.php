<?php
namespace App\Year2015\Day5;

use App\AdventTask;

class PartOne extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $value)
        {
            preg_match_all('~ab|cd|pq|xy~', $value, $matches);
            if (count($matches[0]) > 0) {
                continue;
            }

            preg_match_all('~[aeiou]~', $value, $matches);
            if (count($matches[0]) < 3) {
                continue;
            }

            preg_match_all('~aa|bb|cc|dd|ee|ff|gg|hh|ii|jj|kk|ll|mm|nn|oo|pp|qq|rr|ss|tt|uu|vv|ww|xx|yy|zz~', $value, $matches);
            if (count($matches[0]) == 0) {
                continue;
            }

            $this->result++;
        }
    }
}