<?php
include_once './../AdventTask.php';

class PartOne extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $row) {
            $numbers = explode( ' ', $row);

            $safe = true;

            if ($numbers[0] - $numbers[1] < 0) {
                $path = true;
            } else {
                $path = false;
            }

            foreach ($numbers as $key => $number) {
                if (count($numbers) - 1 == $key) {
                    continue;
                }

                $diff = $number - $numbers[$key+1];

                if (($diff < 0 && !$path)
                    || ($diff > 0 && $path)
                    || $diff == 0
                    || abs($diff) > 3
                ) {
                    $safe = false;
                    break;
                }
            }

            if ($safe === true) {
                $this->result++;
            }
        }
    }
}