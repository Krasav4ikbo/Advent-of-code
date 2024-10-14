<?php
include_once './../AdventTask.php';

class Part_1 extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $row) {
            $numbers = preg_replace('/[^0-9]/', '', $row);

            $res = $numbers[0] * 10 + $numbers[strlen($numbers) - 1];

            $this->result += $res;
        }
    }
}