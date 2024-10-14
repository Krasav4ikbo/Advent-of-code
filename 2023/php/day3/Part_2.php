<?php
include_once './../AdventTask.php';

class Part_2 extends AdventTask
{
    public $used = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $row) {
            foreach ($row as $charKey => $charValue) {
                if ($charValue == '*') {
                    $this->findNumbers($key, $charKey);
                }

            }
        }
    }

    public function findNumbers($currentRow, $currentColumn): void
    {
        $numbers = [];
        $check = trim($this->table[$currentRow][$currentColumn - 1]);
        if(is_numeric($check)) {
            $number = $this->getNumber($currentRow, $currentColumn - 1);
            if ($number > 0) {
                $numbers[] = $number;
            }
            $this->used[$currentRow][$currentColumn - 1] = true;
        }

        $check = trim($this->table[$currentRow][$currentColumn + 1]);
        if(is_numeric($check)) {
            $number = $this->getNumber($currentRow, $currentColumn + 1);
            if ($number > 0) {
                $numbers[] = $number;
            }
            $this->used[$currentRow][$currentColumn + 1] = true;
        }
        if ($currentRow != 0) {
            for ($i=$currentColumn - 1; $i <= $currentColumn + 1; $i++) {
                $check = trim($this->table[$currentRow - 1][$i]);
                if(is_numeric($check)) {
                    $number = $this->getNumber($currentRow - 1, $i);
                    if ($number > 0) {
                        $numbers[] = $number;
                    }
                    $this->used[$currentRow - 1][$i] = true;
                }
            }
        }

        if ($currentRow != count($this->table) - 1) {
            for ($i=$currentColumn -1; $i <= $currentColumn + 1; $i++) {
                $check = trim($this->table[$currentRow + 1][$i]);
                if(is_numeric($check)) {
                    $number = $this->getNumber($currentRow + 1, $i);
                    if ($number > 0) {
                        $numbers[] = $number;
                    }
                    $this->used[$currentRow + 1][$i] = true;
                }
            }
        }

        if (count($numbers) == 2)
        {
            $this->result += $numbers[0] * $numbers[1];
        }
    }

    public function getNumber($row, $column): int
    {
        while($column >= 0 && is_numeric($this->table[$row][$column])) {
            $column--;
        }

        $column++;
        $replacedRow = 0;
        $isUsed = false;
        while(is_numeric($this->table[$row][$column])) {
            if (!empty($this->used[$row][$column])) {
                $isUsed = true;
            }
            $replacedRow = $replacedRow*10 + $this->table[$row][$column];
            $column++;
        }

        if ($isUsed) {
            return 0;
        }

        return $replacedRow;
    }
}