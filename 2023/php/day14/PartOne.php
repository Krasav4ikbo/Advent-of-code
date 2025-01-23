<?php
namespace App\Year2023\Day14;

use App\AdventTaskSplit;

class PartOne extends AdventTaskSplit
{
    public function execute(): void
    {
        $new = $this->table;

        foreach ($new as $key => $value) {
            if($key== 0) {
                continue;
            }
            foreach ($value as $valKey => $item) {
                if($item == 'O') {
                    $check = false;
                    $i = 1;
                    while ($key - $i >= 0) {
                        if(in_array($new[$key - $i][$valKey], ['O', '#'])) {
                            $new[$key][$valKey] = '.';
                            $new[$key - $i + 1][$valKey] = 'O';
                            $check = true;
                            break;
                        }
                        $i++;
                    }
                    if (!$check) {
                        $new[$key][$valKey] = '.';
                        $new[$key - $i + 1][$valKey] = 'O';
                    }
                }
            }
        }

        foreach ($new as $key => $value) {
            $res = 0;
            foreach ($value as $item) {
                if($item == 'O') {
                    $res++;
                }
            }
            $this->result += $res * (count($new) - $key);
        }
    }
}