<?php
include_once './../AdventTaskSplit.php';

class Part_1 extends AdventTaskSplit
{
    public $sum = [];

    public function execute():void
    {
//        $this->calculate(0, 0, 0, 0, 'right', []);
        $this->calculate(0, 0, 0, 0, 'bottom', []);
        print_r($this->sum);
    }

    public function calculate($row, $column, $step, $result, $side, $getted)
    {
        if (empty($this->table[$row][$column]) || !empty($getted[$row][$column])) {
            return;
        }
//        $getted[$row][$column] = "was";
        $result += $this->table[$row][$column];
//        print_r($getted);
//        sleep(1);
        if ($row == count($this->table) - 1 && $column == count($this->table[0]) - 1) {
//            sleep(1);
//            echo "row - " . $row . " column - " . $column . " side - " . $side . " result - " . $result ."\r\n";

            $this->sum[]=$result;
            return;
        }

//        if ($step+1 == 4) {
            $getted[$row][$column] = "was";
//        }

        switch ($side) {
            case 'right':
                if ($step+1 == 4) {
                    $this->calculate($row + 1, $column, 0, $result, 'bottom', $getted);
                    $this->calculate($row - 1, $column, 0, $result, 'top', $getted);
                } else {
                    $this->calculate($row, $column+1, $step + 1, $result, $side, $getted);
                    $this->calculate($row + 1, $column, 0, $result, 'bottom', $getted);
                    $this->calculate($row - 1, $column, 0, $result, 'top', $getted);
                }
                break;
            case 'top':
                if ($step+1 == 4) {
                    $this->calculate($row, $column + 1, 0, $result, 'right', $getted);
                    if ($column == count($this->table[0]) - 1) {
                        $this->calculate($row, $column - 1, 0, $result, 'left', $getted);
                    }
                } else {
                    $this->calculate($row - 1, $column, $step + 1, $result, $side, $getted);
                    $this->calculate($row, $column + 1, 0, $result, 'right', $getted);
                    if ($column == count($this->table[0]) - 1) {
                        $this->calculate($row, $column - 1, 0, $result, 'left', $getted);
                    }
                }
                break;
            case 'bottom':
                if ($step+1 == 4) {
                    $this->calculate($row, $column + 1, 0, $result, 'right', $getted);
                    if ($column == count($this->table[0]) - 1) {
                        $this->calculate($row, $column - 1, 0, $result, 'left', $getted);
                    }
                } else {
                    $this->calculate($row + 1, $column, $step + 1, $result, $side, $getted);
                    $this->calculate($row, $column + 1, 0, $result, 'right', $getted);
                    if ($column == count($this->table[0]) - 1) {
                        $this->calculate($row, $column - 1, 0, $result, 'left', $getted);
                    }
                }
                break;
            case 'left':
//                if ($step+1 == 4) {
                    $this->calculate($row + 1, $column, 0, $result, 'bottom', $getted);
                    $this->calculate($row - 1, $column, 0, $result, 'top', $getted);
//                } else {
//                    $this->calculate($row, $column - 1, $step + 1, $result, $side, $getted);
//                    $this->calculate($row + 1, $column, 0, $result, 'bottom', $getted);
//                    $this->calculate($row - 1, $column, 0, $result, 'top', $getted);
//                }
                break;
        }
    }
}