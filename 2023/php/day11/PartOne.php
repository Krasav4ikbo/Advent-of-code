<?php
namespace App\Year2023\Day11;

use App\AdventTaskSplit;

class PartOne extends AdventTaskSplit
{
    public $start = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $value) {
            foreach ($value as $keyValue => $item) {
                if (empty(trim($item))) {
                    unset($this->table[$key][$keyValue]);
                }
            }

        }
        $expanded = [];
        for($i = 0; $i < count($this->table); $i++) {
            $exist = 0;
            for($j = 0; $j < count($this->table[0]); $j++) {
                if($this->table[$i][$j] == '#')
                {
                    $exist++;
                }
            }
            if ($exist === 0) {
                $expanded[] = $this->table[$i];
            }
            $expanded[] = $this->table[$i];
        }

        $expanded2 = [];
        for($i = 0; $i < count($expanded[0]); $i++) {
            $exist = 0;
            for($j = 0; $j < count($expanded); $j++) {
                if($expanded[$j][$i] == '#')
                {
                    $exist++;
                }
            }
            for($j = 0; $j < count($expanded); $j++) {
                $expanded2[$j][]= $expanded[$j][$i];
                if ($exist == 0) {
                    $expanded2[$j][]= $expanded[$j][$i];
                }
            }
        }

        $coordinates = [];
        foreach ($expanded2 as $key => $value) {
            foreach ($value as $valueLKey => $item) {
                if ($item == '#') {
                    $coordinates[] = [$key, $valueLKey];
                }
            }
        }
        for ($i = 0; $i < count($coordinates); $i++) {
            for ($j = $i + 1; $j < count($coordinates); $j++) {
                $res = abs($coordinates[$i][0] - $coordinates[$j][0]) + abs ($coordinates[$i][1] - $coordinates[$j][1]);
                $this->result+=$res;
            }
        }
    }
}