<?php
namespace App\Year2023\Day19;

use App\AdventTask;

class PartOne extends AdventTask
{
    public $new = [];

    public function execute(): void
    {
        $parts = [];
        $rules = [];
        $isRule = true;
        foreach ($this->table as $key => $item) {
            if(empty(trim($item))) {
                $isRule = false;
                continue;
            }
            if($isRule) {
                $rules[]=$item;
            } else {
                $parts[]=$item;
            }
        }

        $mainRules = [];
        foreach ($rules as $key => $rule) {
            $temp = explode('{', $rule);
            $rKey = $temp[0];
            $mainRules[$rKey] = substr($temp[1], 0, strlen($temp[1]) - 1);
        }

        $mainParts = [];
        foreach ($parts as $partKey => $part) {
            $temp = substr($part, 1, strlen($part) - 2);
            $each = explode(',', $temp);
            foreach ($each as $k => $v) {
                $t = explode('=', $v);
                $mainParts[$partKey][$t[0]]=$t[1];
            }
        }

        foreach ($mainParts as $key => $mainPart) {
            $current = 'in';
            while($current != 'A' && $current != 'R') {
                $check = $mainRules[$current];
                $arr = explode(',', $check);
                $changed = false;
                foreach ($arr as $aK => $av) {
                    if($changed) {
                        break;
                    }
                    $c = explode(':', $av);
                    if (count($c) > 1) {
                        $rK = substr($c[0], 0, 1);
                        $if = substr($c[0], 1, 1);
                        $number = substr($c[0], 2, strlen($c[0]) - 2);

                        switch ($if){
                            case '>':
                                if($mainPart[$rK] > $number) {
                                    $current = $c[1];
                                    $changed = true;
                                }
                                break;
                            case '<':
                                if($mainPart[$rK] < $number) {
                                    $current = $c[1];
                                    $changed = true;
                                }
                                break;
                        }
                    } else {
                        $current = $c[0];
                        $changed = true;
                    }
                }
            }
            if ($current == 'A') {
                $this->result+=array_sum($mainPart);
            }
        }
    }

}