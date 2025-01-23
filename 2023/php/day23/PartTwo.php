<?php
namespace App\Year2023\Day23;

use App\AdventTaskSplit;

class PartTwo extends AdventTaskSplit
{
    public $results = [0];

    public function execute(): void
    {
        foreach ($this->table as $key => $item) {
            foreach ($item as $iK => $iV) {
                if ($iV == '.') {
                    $visited = [];
                    $this->getPath($key, $iK, $visited, 0);
                    $this->result = max($this->results);
                    return;
                }
            }
        }


    }

    public function getPath($x, $y, $visited, $result)
    {
        if (!empty($this->table[$x][$y]) && $this->table[$x][$y] != '#' && empty($visited[$x][$y])) {
            if ($x == (count($this->table) - 1) && $result > max($this->results)) {
                $this->results []=$result;
                return;
            }

            $result++;
            $visited[$x][$y] = true;
            $this->getPath($x + 1, $y, $visited, $result);
            $this->getPath($x - 1, $y, $visited, $result);
            $this->getPath($x, $y - 1, $visited, $result);
            $this->getPath($x, $y + 1, $visited, $result);

        }
    }



}