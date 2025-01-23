<?php
namespace App\Year2023\Day14;

use App\AdventTaskSplit;

class PartTwo extends AdventTaskSplit
{
    public function execute(): void
    {
        $new = $this->check($this->table);

        for ($a = 0; $a < 1000; $a++) {
            for ($j = 0; $j < 4; $j++) {
                $table = [];
                foreach ($new as $key => $value) {
                    foreach ($value as $strKey => $strValue) {
                        if (!empty(trim($strValue))) {
                            $table[$strKey][count($new) - $key - 1] = $strValue;
                        }
                    }
                }

                foreach ($table as $key => $value) {
                    $table[$key] = array_reverse($value);
                }

                $new = $this->check($table);
            }
        }

        foreach ($table as $key => $value) {
            $res = 0;
            foreach ($value as $item) {
                if($item == 'O') {
                    $res++;
                }
            }
            $this->result += $res * (count($table) - $key);
        }
    }

    public function check($table)
    {
        $new = $table;

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
        return $new;
    }
}