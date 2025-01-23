<?php
namespace App\Year2015\Day3;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public function execute(): void
    {
        $symbols = str_split($this->table[0]);
        $map = [];
        $mapSanta = [];
        $i= 0;
        $j = 0;
        $iSanta = 0;
        $jSanta = 0;
        $map[0][0] = 1;
        foreach ($symbols as $key => $symbol) {
            if ($key % 2 == 0) {
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
            } else {
                $map[$iSanta][$jSanta] = 1;
                switch ($symbol) {
                    case '^':
                        $iSanta--;
                        break;
                    case '>':
                        $jSanta++;
                        break;
                    case 'v':
                        $iSanta++;
                        break;
                    case '<':
                        $jSanta--;
                        break;
                    default:
                        break;
                }
            }
        }

        $map[$i][$j] = 1;
        $map[$iSanta][$jSanta] = 1;

        foreach ($map as $key => $value) {
            $this->result += array_sum($value);
        }
    }
}