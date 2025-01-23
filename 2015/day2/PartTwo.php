<?php
namespace App\Year2015\Day2;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $row) {
            $nums = explode('x', $row);
            $max = max($nums);
            $this->result+=$nums[0] * $nums[1] * $nums[2];
            $maxs = [];
            foreach ($nums as $num) {
                if($num != $max) {
                    $this->result+=2*$num;
                } else {
                    $maxs []= $num;
                }
            }

            if (count($maxs) > 1) {
                $this->result+=2*$maxs[0] * (count($maxs) - 1);
            }
        }
    }
}