<?php
namespace App\Year2023\Day9;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public $cards = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function check()
    {
        foreach ($this->table as $key => $value) {
            $this->result+= $this->predict($value);
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
            $check = $current[$i+1] - $current[$i];
            $new[]= $check;
            if ($check  != 0 ) {
                $isFinish = false;
            }
        }

        if (!$isFinish) {
            $current[] = $current[0] - $this->predict($new);
        }

        return $current[count($current) - 1];
    }
}