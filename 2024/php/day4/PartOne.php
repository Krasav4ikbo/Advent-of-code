<?php
include_once './../AdventTaskSplit.php';

class PartOne extends AdventTaskSplit
{
    public $letters = ['X', 'M', 'A', 'S'];

    public function execute(): void
    {
        foreach ($this->table as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($cell == $this->letters[0]) {
                    for ($a = 0; $a < 8; $a++) {
                        $this->search($i, $j, 0, $a);
                    }
                }
            }
        }
    }

    public function search($i, $j, $currentLetter, $way)
    {
        if ($currentLetter === count($this->letters) - 1) {
            $this->result++;
            return;
        }

        switch ($way) {
            case 0:
                $i++;
                break;
            case 1:
                $i--;
                break;
            case 2:
                $j++;
                break;
            case 3:
                $j--;
                break;
            case 4:
                $i++;
                $j++;
                break;
            case 5:
                $i--;
                $j--;
                break;
            case 6:
                $i++;
                $j--;
                break;
            default:
                $i--;
                $j++;
                break;
        }

        if (!empty($this->table[$i][$j]) && $this->table[$i][$j] == $this->letters[$currentLetter + 1]) {
            $this->search($i, $j, $currentLetter + 1, $way);
        }
    }
}