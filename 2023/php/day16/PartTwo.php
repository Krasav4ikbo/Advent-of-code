<?php
namespace App\Year2023\Day16;

use App\AdventTaskSplit;

class PartTwo extends AdventTaskSplit
{
    public $count = [];
    public $order = [];

    public $weigth = [];
    public $new = [];
    public $getted = [];
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $item) {
            foreach ($item as $key1 => $value) {
                if(!empty(trim($value))) {
                    $this->new[$key][$key1] = $value;
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $table = [];
            foreach ($this->new as $key => $value) {
                foreach ($value as $strKey => $strValue) {
                    $table[$strKey][count($this->new) - $key - 1] = $strValue;
                }
            }

            foreach ($table as $key => $value) {
                $table[$key] = array_reverse($value);
            }

            $this->new = $table;

            foreach ($this->new[0] as $key => $value) {
                $sides = [];

                if ($key == 0) {
                    switch($value) {
                        case '.':
                            $sides = ['bottom', 'right'];
                            break;
                        case '|':
                            $sides = ['bottom'];
                            break;
                        case '-':
                            $sides = ['right'];
                            break;
                        case '/':
                            $sides = [];
                            break;
                        case "\\":
                            $sides = ['right', 'bottom'];
                            break;
                        default:
                            break;
                    }
                } else if ($key == count($this->new[0]) - 1){
                    switch($value) {
                        case '.':
                            $sides = ['bottom', 'left'];
                            break;
                        case '|':
                            $sides = ['bottom'];
                            break;
                        case '-':
                            $sides = ['left'];
                            break;
                        case '/':
                            $sides = ['left', 'bottom'];
                            break;
                        case "\\":
                            $sides = [];
                            break;
                        default:
                            break;
                    }
                } else {
                    switch($value) {
                        case '|':
                        case '.':
                            $sides = ['bottom'];
                            break;
                        case '-':
                            $sides = ['bottom', 'left'];
                            break;
                        case '/':
                            $sides = ['left'];
                            break;
                        case "\\":
                            $sides = ['right'];
                            break;
                        default:
                            break;
                    }
                }


                foreach ($sides as $sKey => $side) {
                    $this->getted = [];
                    $this->count = [];
                    $this->result = 0;
                    $this->getted[0][$key] = '#';
                    $this->goNext(0, $key, $side);
                    foreach ($this->getted as $keyG => $valueG) {
                        foreach ($valueG as $keyG2 => $itemG) {
                            if ($itemG === '#') {
                                $this->result++;
                            }
                        }
                    }
                    $this->results[] = $this->result;
                }
            }
        }

        rsort($this->results, SORT_DESC);
        $this->result = $this->results[0];
    }

    public function goNext($row, $column, $side)
    {
        switch ($side) {
            case 'right':
                $column++;
                break;
            case 'left':
                $column--;
                break;
            case 'top':
                $row--;
                break;
            case 'bottom':
                $row++;
                break;
        }

        if (empty($this->new[$row][$column])) {
            return;
        }

        if (!empty($this->getted[$row][$column])) {
            if (empty($this->count[$row][$column][$side])) {
                $this->count[$row][$column][$side] = 1;
            } else {
                $this->count[$row][$column][$side]++;
            }
            if ($this->count[$row][$column][$side] > 1) {
                return;
            }
        }
        $this->getted[$row][$column]='#';

        switch($this->new[$row][$column]) {
            case '.':
                $this->goNext($row, $column, $side);
                break;
            case '|':
                if (in_array($side, ['top', 'bottom'])) {
                    $this->goNext($row, $column, $side);
                } else {
                    $this->goNext($row, $column, 'top');
                    $this->goNext($row, $column, 'bottom');
                }
                break;
            case '-':
                if (in_array($side, ['left', 'right'])) {
                    $this->goNext($row, $column, $side);
                } else {
                    $this->goNext($row, $column, 'left');
                    $this->goNext($row, $column, 'right');
                }
                break;
            case '/':
                if ($side == 'left') {
                    $this->goNext($row, $column, 'bottom');
                }
                if ($side == 'right') {
                    $this->goNext($row, $column, 'top');
                }
                if ($side == 'top') {
                    $this->goNext($row, $column, 'right');
                }
                if ($side == 'bottom') {
                    $this->goNext($row, $column, 'left');
                }
                break;
            case "\\":
                if ($side == 'left') {
                    $this->goNext($row, $column, 'top');
                }
                if ($side == 'right') {
                    $this->goNext($row, $column, 'bottom');
                }
                if ($side == 'top') {
                    $this->goNext($row, $column, 'left');
                }
                if ($side == 'bottom') {
                    $this->goNext($row, $column, 'right');
                }
                break;
            default:
                break;
        }
    }
}