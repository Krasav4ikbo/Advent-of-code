<?php
namespace App\Year2023\Day13;

use App\AdventTask;

class PartOne extends AdventTask
{
    public $start = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function execute():void
    {
        $new = [];
        foreach ($this->table as $key => $item) {
            if (empty(trim($item))) {
                $this->getPattern($new);
                $this->getPatternColumn($new);
                $new = [];
            } else {
                $new [] = $item;
            }
        }
        $this->getPattern($new);
        $this->getPatternColumn($new);

    }

    public function getPattern($table)
    {
        foreach ($table as $key => $value) {
            $min = min($key + 1, count($table) - $key - 1);
            if (!empty(trim($table[$key + 1])) && trim($table[$key + 1]) == trim($value)) {
                $count = 1;
                echo $table[$key] ."\r\n";
                echo $table[$key + 1] ."\r\n";
                for ($i=1; $i <= $min; $i++){
                    echo $table[$key + 1] ."\r\n";
                    echo ' $table[$key-$i] ' . $table[$key-$i] . ' $table[$key + 1 + $i] - ' . $table[$key + 1 + $i] . "\r\n";
                    echo ' $i - ' . $i . ' key - ' . $key . ' $count - ' . $count . ' min ' . min($key + 1, count($table) - $key - 1) ."\r\n";
                    if (trim($table[$key-$i]) == trim($table[$key + 1 + $i])) {
                        echo 'euquals $i - ' . $i . ' key - ' . $key . "\r\n";
//                        echo ' $$table[$key-$i] ' . $table[$key-$i] . ' $table[$key + 1 + $i] - ' . $table[$key + 1 + $i] . "\r\n";
                        $count++;
                    }
                }
//                print_r($count);
//                print_r(min($key + 1, count($table) - $key - 1));
                if ($count == $min) {
//                    print_r($key);
//                    print_r(($key+1));
                    $this->result += 100*($key+1);
                }

            }
        }
    }

    public function getPatternColumn($tableColumn)
    {
        $table = [];
        foreach ($tableColumn as $key => $value) {
            $new = str_split($value);
            foreach ($new as $strKey => $strValue) {
                if (!empty(trim($strValue))) {
                    $table[$strKey][$key] = $strValue;
                }
            }
        }

        foreach ($table as $key => $value) {
            $table[$key] = implode($value);
        }
        
        foreach ($table as $key => $value) {
            $min = min($key + 1, count($table) - $key - 1);
            if (!empty($table[$key + 1]) && $table[$key + 1] == $value) {
                $count = 1;
                for ($i=1; $i <= $min; $i++){
                    echo ' $i - ' . $i . ' key - ' . $key . "\r\n";
                    echo ' $table[$key-$i] - ' . $table[$key-$i] . ' $table[$key-$i] - ' . $table[$key-$i] . "\r\n";
                    if ($table[$key-$i] == $table[$key + 1 + $i]) {

                        $count++;
                    }
                }
                echo ' $count - ' . $count . ' min($key, count($table) - $key - 1) - ' . $min . "\r\n";
                if ($count == $min) {
                    $this->result += ($key+1);
                }
            }
        }

    }

}