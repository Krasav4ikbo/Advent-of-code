<?php
include_once './../AdventTaskSplit.php';
class Part_1 extends AdventTaskSplit
{
    public $currentPos = [0,0];
    public function execute(): void
    {
        $rules = false;
        $rulesArr = [];
        foreach ($this->table as $i => $row) {
            if (empty($row)) {
                $rules = true;
            }
            foreach ($row as $j => $item) {
                if ($rules) {
                    $rulesArr []= $item;
                }
                if ($item == '@') {
                    $this->table[$i][$j] = '.';
                    $this->currentPos = [$i, $j];
                }
            }
        }

        foreach ($rulesArr as $rule) {
            $this->nextStep($this->currentPos[0], $this->currentPos[1], $rule);
        }

        foreach ($this->table as $i => $row) {
            foreach ($row as $j => $item) {
                if ($item == 'O') {
                    $this->result+= $i*100 + $j;
                }
            }
        }
    }

    public function nextStep($i, $j, $way): void
    {
        switch ($way) {
            case ">":
                $j++;
                break;
            case "<":
                $j--;
                break;
            case "^":
                $i--;
                break;
            default:
                $i++;
                break;
        }

        if ($this->table[$i][$j] == 'O') {
            if ($this->move($i,$j, $way)) {
                $this->table[$i][$j] = '.';
            }
        }

        if ($this->table[$i][$j] == '.') {
            $this->currentPos = [$i, $j];
        }
    }

    public function move($i, $j, $way)
    {
        switch ($way) {
            case ">":
                $j++;
                break;
            case "<":
                $j--;
                break;
            case "^":
                $i--;
                break;
            default:
                $i++;
                break;
        }

        if ($this->table[$i][$j] == 'O') {
            if ($this->move($i,$j, $way)) {
                $this->table[$i][$j] = '.';
            }
        }

        if ($this->table[$i][$j] == '.') {
            $this->table[$i][$j] = 'O';
            return true;
        }

        return false;
    }
}
