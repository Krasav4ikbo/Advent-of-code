<?php
namespace App\Year2023\Day9;

use App\AdventTask;

class PartOne extends AdventTask
{
    public $cards = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $value) {
            $this->result+= (int) $this->predict(explode(' ', $value));
//            echo 'res - ' . $current[count($current) - 1] . "\r\n";
//            $isFinish = false;
//            $current = $value;
//            while (!$isFinish) {
//                $new = [];
//                $isFinish = true;
//                for ($i = 0; $i < count($current) - 1; $i++) {
//                    $check = $current[$i+1] - $current[$i];
//                    $new[]= $check;
//                    if ($check  != 0 ) {
//                        $isFinish = false;
//                    }
//                }
//                $this->result+=$new[count($new) - 1];
//                $current = $new;
//                print_r($current);
//            }
//            $this->result+=$new[count($new) - 1];
        }

//        print_r($find);
    }

    public function predict($current)
    {
        $isFinish = true;
        $new = [];
        for ($i = 0; $i < count($current) - 1; $i++) {
            $check = (int)$current[$i+1] - (int)$current[$i];
            $new[]= $check;
            if ($check  != 0 ) {
                $isFinish = false;
            }
        }

        if (!$isFinish) {
            $current[] = (int)$current[count($current) - 1] + $this->predict($new);
        }

        return (int)$current[count($current) - 1];
    }

}