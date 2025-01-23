<?php
namespace App\Year2015\Day3;

use App\AdventTask;

class PartOne extends AdventTask
{
    public function execute(): void
    {
        $symbols = str_split($this->table[0]);
        $map = [];
        $i= 0;
        $j = 0;
        foreach ($symbols as $symbol) {
            $map[$i][$j] = 1;
            switch ($symbol) {
                case '^':
                    $i--;
                    break;
                case '>':
                    $j++;
                    break;
                case 'v':
                    $i++;
                    break;
                case '<':
                    $j--;
                    break;
                default:
                    break;
            }
        }

        foreach ($map as $key => $value) {
            $this->result += array_sum($value);
        }
    }
}