<?php
include_once './PartOne.php';
ini_set('xdebug.max_nesting_level', 20000);
class PartTwo extends PartOne
{
    public array $arrayWas = [];
    public function execute(): void
    {
        $start = [];
        foreach ($this->table as $i => $row) {
            foreach ($row as $j => $item) {
                if ($item === '^') {
                    $start = [$i,$j];
                    $this->table[$i][$j] = '.';
                    $this->search($i,$j, 0);
                }
            }
        }

        $this->result = 0;

        foreach ($this->arrayWas as $i => $row) {
            foreach ($row as $j => $item) {
                if (($i != $start[0] || $j != $start[1]) && $this->table[$i][$j] !== '#') {
                    $searchTable = $this->table;
                    $searchTable[$i][$j] = "#";
                    $this->searchExtra($start[0], $start[1], 0, $searchTable, []);
                    unset($searchTable);
                }
            }
        }
    }

    public function searchExtra($i,$j,$way, $table, $arrayWas): void
    {
        if (empty($arrayWas[$i][$j])) {
            $arrayWas[$i][$j] = 1;
        } else {
            $arrayWas[$i][$j]++;
        }

        if ($arrayWas[$i][$j] > 5)
        {
            $this->result++;
            return;
        }

        if ($way == 4) {
            $way=0;
        }

        list($newI, $newJ) = $this->getNewCoords($i, $j, $way);

        if (empty($table[$newI][$newJ])){
            return;
        }

        if ($table[$newI][$newJ] == '#') {
            $this->searchExtra($i,$j,$way + 1, $table, $arrayWas);
        } else {
            $this->searchExtra($newI,$newJ,$way, $table, $arrayWas);
        }
    }
}