<?php
include_once './../AdventTaskSplit.php';

class Part_1 extends AdventTaskSplit
{
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $item) {
            foreach ($item as $iK => $iV) {
                if ($iV == '.') {
                    $visited = [];
                    $this->getPath($key, $iK, $visited, 0);
                    break;
                }
            }
        }

        $this->result = max($this->results);
    }

    public function getPath($x, $y, $visited, $result)
    {
        if ($x == (count($this->table[0]) - 1)) {
            $this->results []=$result;
            return;
        }

        if (!empty($this->table[$x][$y]) && $this->table[$x][$y] != '#' && empty($visited[$x][$y])) {
            $result++;
            $visited[$x][$y] = true;

            switch ($this->table[$x][$y]) {
                case '>':
                    $this->getPath($x, $y + 1, $visited, $result);
                    break;
                case '<':
                    $this->getPath($x, $y - 1, $visited, $result);
                    break;
                case '^':
                    $this->getPath($x - 1, $y, $visited, $result);
                    break;
                case 'v':
                    $this->getPath($x + 1, $y, $visited, $result);
                    break;
                case '.':
                    $this->getPath($x + 1, $y, $visited, $result);
                    $this->getPath($x - 1, $y, $visited, $result);
                    $this->getPath($x, $y - 1, $visited, $result);
                    $this->getPath($x, $y + 1, $visited, $result);
                    break;
                default:
                    break;
            }

        }
    }
}