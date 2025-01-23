<?php
namespace App\Year2023\Day21;

use App\AdventTaskSplit;

class PartTwo extends AdventTaskSplit
{
    public $queue = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $item) {
            foreach ($item as $iK => $iV) {
                if ($iV == 'S') {
                    $this->queue[0][]=[$key, $iK];
                    break;
                }
            }
        }

        $this->result++;
        $steps = 131*2+65;
        $step = 0;
        $vals = [];
        while(count($this->queue[0]) > 0 && $step < $steps) {
            $add = [];
            $currentStep = array_shift($this->queue);
            $res = [];
            foreach ($currentStep as $current) {
                if (!empty($this->table[$current[0] + 1][$current[1]]) && $this->table[$current[0] + 1][$current[1]] == '.')
                {
                    $temp = implode('-', [$current[0] + 1, $current[1]]);
                    if (!in_array($temp, $res)) {
                        $res[]=$temp;
                        $add[]=[$current[0] + 1, $current[1]];
                    }
                }

                if (!empty($this->table[$current[0] - 1][$current[1]]) && $this->table[$current[0] - 1][$current[1]] == '.')
                {
                    $temp = implode('-', [$current[0] - 1, $current[1]]);
                    if (!in_array($temp, $res)) {
                        $res[]=$temp;
                        $add[]=[$current[0] - 1, $current[1]];
                    }
                }

                if (!empty($this->table[$current[0]][$current[1] + 1]) && $this->table[$current[0]][$current[1] + 1] == '.')
                {
                    $temp = implode('-', [$current[0], $current[1] + 1]);
                    if (!in_array($temp, $res)) {
                        $res[]=$temp;
                        $add[]=[$current[0], $current[1] + 1];
                    }
                }

                if (!empty($this->table[$current[0]][$current[1] - 1]) && $this->table[$current[0]][$current[1] - 1] == '.')
                {
                    $temp = implode('-', [$current[0], $current[1] - 1]);
                    if (!in_array($temp, $res)) {
                        $res[]=$temp;
                        $add[]=[$current[0], $current[1] - 1];
                    }
                }
            }
            $step++;
            $this->queue[]=$add;

            $this->result = count($res);

        }
    }
}