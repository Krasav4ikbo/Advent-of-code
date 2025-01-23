<?php
namespace App\Year2023\Day16;

use App\AdventTaskSplit;

class PartOne extends AdventTaskSplit
{
    public $count = [];
    public $order = [];

    public $weigth = [];
    public $new = [];
    public $getted = [];



    public function execute():void
    {
        foreach ($this->table as $key => $item) {
            foreach ($item as $key1 => $value) {
                if(!empty(trim($value))) {
                    $this->new[$key][$key1] = $value;
                }
            }
        }

        $this->getted[0][0]='#';
        $side = '';
        switch($this->new[0][0]) {
            case '-':
            case '.':
                $side = 'right';
                break;
            case "\\":
            case '|':
                $side = 'bottom';
                break;
            case '/':
                $side = 'top';
                break;
            default:
                break;
        }

        $this->goNext(0, 0, $side);
        foreach ($this->getted as $key => $value) {
            foreach ($value as $key1 => $item) {
                if ($item === '#') {
                    $this->result++;
                }
            }
        }
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
            if ($this->count[$row][$column][$side] > 10) {
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