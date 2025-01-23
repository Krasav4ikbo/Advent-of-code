<?php
namespace App\Year2015\Day2;

use App\AdventTask;

class PartOne extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $row) {
            $nums = explode('x', $row);
            $pairs = [
                $nums[0] * $nums[1],
                $nums[0] * $nums[2],
                $nums[1] * $nums[2],
            ];
            foreach ($pairs as $num) {
                $this->result+=2*$num;
            }

            $this->result+=min($pairs);
        }
    }
}