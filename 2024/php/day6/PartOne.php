<?php
include_once './../AdventTaskSplit.php';
ini_set('xdebug.max_nesting_level', 10000);

class PartOne extends AdventTaskSplit
{
    public array $arrayWas = [];

    public function execute(): void
    {
        foreach ($this->table as $i => $row) {
            foreach ($row as $j => $item) {
                if ($item === '^') {
                    $this->table[$i][$j] = '.';
                    $this->search($i, $j, 0);
                }
            }
        }
    }

    public function search($i, $j, $way): void
    {
        if (empty($this->arrayWas[$i][$j])) {
            $this->arrayWas[$i][$j] = 1;
            $this->result++;
        }

        if ($way == 4) {
            $way = 0;
        }

        list($newI, $newJ) = $this->getNewCoords($i, $j, $way);

        if (empty($this->table[$newI][$newJ])) {
            return;
        }

        if ($this->table[$newI][$newJ] == '#') {
            $this->search($i, $j, $way + 1);
        } else {
            $this->search($newI, $newJ, $way);
        }
    }

    public function getNewCoords($i, $j, $way): array
    {
        switch ($way) {
            case 0:
                $i--;
                break;
            case 1:
                $j++;
                break;
            case 2:
                $i++;
                break;
            default:
                $j--;
                break;
        }

        return [$i, $j];
    }

}