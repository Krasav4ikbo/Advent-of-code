<?php
include_once './../AdventTask.php';
class Part_2 extends AdventTask
{
    public function execute(): void
    {
        $array = [];
        foreach ($this->table as $row){
            $array = explode(' ', $row);
        }

        $values = [];
        foreach ($array as $i => $item) {
            $values[$item] = 1;
        }

        for ($j = 0; $j < 75; $j++){
            $newArray = [];
            foreach ($values as $i => $item) {
                if ($i == 0) {
                    if (empty($newArray["1"])) {
                        $newArray["1"]=0;
                    }
                    $newArray["1"] += $item;
                } else if (strlen($i) % 2 == 0) {
                    $one = (string)(int)substr($i, 0, strlen($i) / 2);
                    $two = (string)(int)substr($i, strlen($i) / 2, strlen($i) / 2);
                    if (empty($newArray[$one])) {
                        $newArray[$one]=0;
                    }
                    if (empty($newArray[$two])) {
                        $newArray[$two]=0;
                    }
                    $newArray[$one]+= $item;
                    $newArray[$two]+= $item;
                } else {
                    $v = (string)($i * 2024);
                    if (empty($newArray[$v])) {
                        $newArray[$v]=0;
                    }
                    $newArray[$v]+= $item;
                }
            }

            $values = $newArray;
        }

        $this->result = array_sum($values);
    }
}