<?php
include_once './../AdventTaskSplit.php';
class PartOne extends AdventTaskSplit
{
    public function execute(): void
    {
        $results = [];
        foreach ($this->table[0] as $i => $value) {
            $val = ".";
            if ($i == 0 || $i % 2 == 0) {
                $val = $i / 2;
            }

            for ($j = 0; $j < $value; $j++) {
                $results[]=$val;
            }
        }


        $reverseCount = count($results) - 1;

        for ($i = 0; $i < count($results); $i++) {
            if ($results[$i] == ".") {
                while ($results[$reverseCount] == "." && $i< $reverseCount) {
                    $reverseCount--;
                }

                if ($i > $reverseCount) {
                    break;
                }

                $results[$i] = $results[$reverseCount];
                $results[$reverseCount] = ".";
                $reverseCount--;
            }
        }

        foreach ($results as $i => $value) {
            if ($value != ".") {
                $this->result += $i * $value;
            }
        }
    }
}