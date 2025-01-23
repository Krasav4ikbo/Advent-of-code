<?php
namespace App\Year2023\Day10;

use App\AdventTaskSplit;

class PartTwo extends AdventTaskSplit
{
    public $start = [];
    public $end = [];

    public $newTable = [];
    public $weigth = [];
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $value) {
            foreach ($value as $valueKey => $valueItem) {
                if ($valueItem == 'S') {
                    $this->start = [$key, $valueKey];
                    $this->end = [$key, $valueKey];
                    $this->newTable[$key][$valueKey] = '*';
                }
            }
        }
        foreach ($this->table as $key => $value) {
            foreach ($value as $valueKey => $valueItem) {
                if (!trim($valueItem)) {
                    unset($this->table[$key][$valueKey]);
                }
            }
        }
        $this->newTable = $this->table;
//bottom
        if (in_array($this->table[$this->start[0] + 1][$this->start[1]], ['|', 'F', '7', 'J'])) {
            $this->predict([$this->start[0] + 1, $this->start[1]], $this->start, 0);
        }
        $this->table[$this->start[0]][$this->start[1]] = 'L';
//        echo '<pre>';
//        print_r($this->newTable);
//        echo '</pre>';

        foreach ($this->table as $key => $value){
            foreach ($value as $valueKey => &$valueItem) {
                if ($this->newTable[$key][$valueKey] != '*') {
                    $valueItem = '.';
                }
            }
//            if ($key == 4) {
//                print_r($value);
//            }
            $str =  implode('', $value);
//            echo $str . "\r\n";
            $str = preg_replace('/F-*7/', '', $str);
            $str = preg_replace('/L-*J/', '', $str);
            $str = preg_replace('/F-*J/', '|', $str);
            $str = preg_replace('/L-*7/', '|', $str);
//            if ($key == 4) {
//                print_r($this->newTable[$key]);
//                print_r($value);
//                echo $str . "\r\n";
//            }
            $corner = 0;
            foreach (str_split($str) as $checkKey => $checkValue) {
                if ($checkValue == '|') {
                    $corner++;
                    continue;
                }
                if ($corner % 2 != 0 && !empty(trim($checkValue)) && $checkValue != 'S') {
                    echo '$key - '. $key . ' $checkValue - '. $checkValue . ' corner - ' . $corner . "\r\n";
                    $this->result++;
                }
            }
        }

        $this->result++;

        foreach ($this->newTable as $key => $value) {
            $rowCorner = 0;
            $corner = 0;
            foreach ($value as $valueKey => $valueItem) {
                if ($valueItem == '*') {
                    $rowCorner++;
                }
            }
//            echo '$key - '. $key . ' $rowCorner - '. $rowCorner . "\r\n";
//            if ($key == 4) {
//                print_r($value);
//            }
            $isGet = false;
            foreach ($value as $valueKey => $valueItem) {
                if ($valueItem == '*') {
                    if (!$isGet) {
                        $corner++;
                    } else {
                        $corner = 0;
                        $isGet = false;
                    }
                    continue;
                }

                if (in_array($valueItem, ['-'])) {
                    continue;
                }
                if ($key == 4) {
                    echo '$key - '. $key . ' $valueKey - '. $valueKey . ' $valueItem - ' . $valueItem . ' corner - ' . $corner . "\r\n";
                }
                if ($rowCorner % 2 === 0 && $corner % 2 != 0 && !empty(trim($valueItem))) {
                    echo '$key - '. $key . ' $valueKey - '. $valueKey . ' $valueItem - ' . $valueItem . ' corner - ' . $corner . "\r\n";
                    $isGet = true;
                    $this->result++;
                }
            }
        }
//        print_r($this->newTable);
    }

    public function predict($current, $previous, $result)
    {
        $result++;
//        if (in_array($this->table[$current[0]][$current[1]], ['|', 'L', 'J', 'F', '7'])) {
            $this->newTable[$current[0]][$current[1]] = '*';
//        }
        $sum = abs($this->start[0] - $current[0]) + abs($this->start[1] - $current[1]);
        $sumEnd = abs($this->start[0] - $this->end[0]) + abs($this->start[1] - $this->end[1]);
        if ($sum > $sumEnd) {
            $this->end = $current;
        }

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
            case '.':
                break;
            default:
                break;
        }
    }

}