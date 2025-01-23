<?php
namespace App\Year2023\Day5;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public array $checks = [];

    public array $seeds = [];

    public array $maps = [];


    public function execute(): void
    {
        $seeds = explode(': ', $this->table[0]);
        $seeds = explode(' ', $seeds[1]);
        foreach ($seeds as $key => $seed) {
            if ($key % 2 == 0) {
                $this->seeds []= [$seed, (int)$seed + (int)$seeds[$key + 1]];
            }
        }

        foreach ($this->table as $key => $row) {
            if ($key != 0) {
                if (strpos($row, ':')) {
                    $this->maps[]=$this->checks;
                    $this->checks = [];
                } else {
                    $this->checks []=$row;
                }
            }
        }

        $this->maps[]=$this->checks;

        $i = 0;
        while ($this->result == 0) {
            $seed = $i;
            for ($j=count($this->maps) - 1; $j >= 0; $j--) {
                $finded = false;
                foreach ($this->maps[$j] as $check) {
                    if ($finded) {
                        break;
                    }
                    $row1 = explode(' ', $check);
                    if (count($row1) > 1) {
                        if ($seed >= $row1[0]) {
                            $res = $seed - $row1[0];
                            if ($res >= 0 && $res < $row1[2]) {
                                $seed = $seed - (int)$row1[0] + (int)$row1[1];
                                $finded = true;
                            }
                        }
                    }
                }
            }

            foreach ($this->seeds as $pair) {
                if ($seed >= $pair[0] && $seed <= $pair[1]) {
                    $this->result = $i;
                    return;
                }
            }

            $i++;
        }
    }
}