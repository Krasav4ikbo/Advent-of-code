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
    }
}
