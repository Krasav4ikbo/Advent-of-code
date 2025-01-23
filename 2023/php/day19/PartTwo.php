<?php
namespace App\Year2023\Day19;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public $new = [];
    public $mainRules = [];

    public $steps = [];

    public function execute(): void
    {
        $rules = [];
        $isRule = true;
        foreach ($this->table as $key => $item) {
            if (empty(trim($item))) {
                $isRule = false;
                continue;
            }
            if ($isRule) {
                $rules[] = $item;
            }
        }

        foreach ($rules as $key => $rule) {
            $temp = explode('{', $rule);
            $rKey = $temp[0];
            $this->mainRules[$rKey] = substr($temp[1], 0, strlen($temp[1]) - 1);
        }

        $this->checkRule('in');
    }

    public function checkRule($current, $options = ['x' => [1, 4000], 's' => [1, 4000], 'm' => [1, 4000], 'a' => [1, 4000]])
    {
        if ($current == 'A') {
            $count = 1;
            foreach ($options as $k => $v) {
                $count *= abs($v[1] - $v[0] + 1);
            }
            if ($count > 0) {
                $this->result += $count;
                $this->results[] = $options;
            }
            return;
        }

        if ($current == 'R') {
            return;
        }

        $rule = $this->mainRules[$current];
        $this->steps[] = ['current' => $current, 'rule' => $rule,];
        $arr = explode(',', $rule);
        foreach ($arr as $aK => $av) {
            $c = explode(':', $av);
            if (count($c) > 1) {
                $rK = substr($c[0], 0, 1);
                $if = substr($c[0], 1, 1);
                $number = substr($c[0], 2, strlen($c[0]) - 2);
                switch ($if) {
                    case '>':
                        $tempOption = $options;
                        if ($tempOption[$rK][0] < $number) {
                            $tempOption[$rK][0] = $number + 1;
                            $this->checkRule($c[1], $tempOption);
                        }

                        if ($options[$rK][1] > $number) {
                            $options[$rK][1] = $number;
                        }
                        break;
                    case '<':
                        $tempOption = $options;
                        if ($tempOption[$rK][1] > $number) {
                            $tempOption[$rK][1] = $number - 1;
                            $this->checkRule($c[1], $tempOption);
                        }

                        if ($options[$rK][0] < $number) {
                            $options[$rK][0] = $number;
                        }
                        break;
                }
            } else {
                $this->checkRule($c[0], $options);
            }
        }
    }
}