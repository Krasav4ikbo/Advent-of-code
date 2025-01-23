<?php
namespace App\Year2023\Day10;

use App\AdventTaskSplit;

class PartOne extends AdventTaskSplit
{
    public int $result = 0;
    public $start = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $value) {
            foreach ($value as $valueKey => $valueItem) {
                if ($valueItem == 'S') {
                    $this->start = [$key, $valueKey];
                }
            }
        }
//bottom
        if (in_array($this->table[$this->start[0] + 1][$this->start[1]], ['|', 'F', '7'])) {
            $this->predict([$this->start[0] + 1, $this->start[1]], $this->start, 0);
        }
    }

    public function predict($current, $previous, $result)
    {
        $result++;
        echo 'val - '. $this->table[$current[0]][$current[1]] . ' res - ' . $result . "\r\n";
        switch ($this->table[$current[0]][$current[1]]){
            case '|':
                $this->predict([$current[0] + ($current[0] - $previous[0]), $current[1]], $current, $result);
                break;
            case '-':
                $this->predict([$current[0], $current[1] + ($current[1] - $previous[1])], $current, $result);
                break;
            case 'L':
                if ($current[0] - $previous[0] > 0) {
                    $this->predict([$current[0], $current[1] + 1], $current, $result);
                } else {
                    $this->predict([$current[0] - 1, $current[1]], $current, $result);
                }
                break;
            case 'J':
                if ($current[0] - $previous[0] > 0) {
                    $this->predict([$current[0], $current[1] - 1], $current, $result);
                } else {
                    $this->predict([$current[0] - 1, $current[1]], $current, $result);
                }
                break;
            case '7':
                if ($current[0] - $previous[0] < 0) {
                    $this->predict([$current[0], $current[1] - 1], $current,$result);
                } else {
                    $this->predict([$current[0] + 1, $current[1]], $current,$result);
                }
                break;
            case 'F':
                if ($current[0] - $previous[0] < 0) {
                    $this->predict([$current[0], $current[1] + 1], $current,$result);
                } else {
                    $this->predict([$current[0] + 1, $current[1]], $current,$result);
                }
                break;
//            case '.':
//                if ($this->result < $result) {
//                    $this->result = $result;
//                }
//                break;
            default:
                if ($this->result < $result) {
                    $this->result = $result;
                }
                break;
        }
    }

}