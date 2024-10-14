<?php
include_once './../AdventTaskSplit.php';

class Part_1 extends AdventTaskSplit
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
        $step = 1;
        $resSteps = [];
        $resSteps[0] = 1;
        while(count($this->queue[0]) > 0 && $step < 7) {
            $add = [];
            $resSteps[$step] = 0;
            $currentStep = array_shift($this->queue);
            $res = [];
            $steps = [];
            foreach ($currentStep as  $item) {
                $temp = implode('-', $item);
                if (!in_array($temp, $res)) {
                    $res[]=$temp;
                    $steps[]=$item;
                }
            }
            foreach ($steps as $current) {
                if (!empty($this->table[$current[0] + 1][$current[1]]) && $this->table[$current[0] + 1][$current[1]] == '.')
                {
                    $add[]=[$current[0] + 1, $current[1]];
                    $resSteps[$step]++;
                }

                if (!empty($this->table[$current[0] - 1][$current[1]]) && $this->table[$current[0] - 1][$current[1]] == '.')
                {
                    $add[]=[$current[0] - 1, $current[1]];
                    $resSteps[$step]++;
                }

                if (!empty($this->table[$current[0]][$current[1] + 1]) && $this->table[$current[0]][$current[1] + 1] == '.')
                {
                    $add[]=[$current[0], $current[1] + 1];
                    $resSteps[$step]++;
                }

                if (!empty($this->table[$current[0]][$current[1] - 1]) && $this->table[$current[0]][$current[1] - 1] == '.')
                {
                    $add[]=[$current[0], $current[1] - 1];
                    $resSteps[$step]++;
                }
            }
            $step++;
            $this->queue[]=$add;
        }

        $res = [];

        foreach ($this->queue[count($this->queue) - 1] as  $item) {
            $temp = implode('-', $item);
            if (!in_array($temp, $res)) {
                $res[]=$temp;
            }
        }

       $this->result = count($res) + 1;
    }
}