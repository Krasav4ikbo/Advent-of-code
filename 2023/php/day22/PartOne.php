<?php
namespace App\Year2023\Day22;

use App\AdventTaskSplit;

class PartOne extends AdventTaskSplit
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
    }
}
