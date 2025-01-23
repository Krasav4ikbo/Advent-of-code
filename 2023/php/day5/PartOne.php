<?php
namespace App\Year2023\Day5;

use App\AdventTask;

class PartOne extends AdventTask
{
    public array $checks = [];
    public array $used = [];
    public array $seeds = [];

    public function execute(): void
    {
        $seeds = explode(': ', $this->table[0]);
        $this->seeds = explode(' ', $seeds[1]);

        foreach ($this->table as $key => $row) {
            if ($key != 0) {
                if (strpos($row, ':')) {
                    $this->convert();
                    $this->checks = [];
                    $this->used = [];
                } else {
                    $this->checks []=$row;
                }
            }
        }

        $this->convert();
    }

    public function convert(): void
    {
        foreach ($this->checks as $check) {
            $row = explode(' ', $check);
            if (count($row) > 1) {
                foreach ($this->seeds as $seedKey => $seed) {
                    $res = $seed - $row[1];
                    if ($res >= 0 && $res < $row[2] && !in_array($seedKey, $this->used)) {
                        $this->seeds[$seedKey] = $seed + (int)$row[0] - (int)$row[1];
                        $this->used[]=$seedKey;
                    }
                }
            }
        }
        sort($this->seeds);
        $this->result = $this->seeds[0];
    }
}