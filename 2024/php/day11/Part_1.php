<?php
include_once './../AdventTask.php';
class Part_1 extends AdventTask
{
    public function execute(): void
    {
        $array = [];
        foreach ($this->table as $row){
            $array = explode(' ', $row);
        }

        $newArray = [];
        for ($j = 0; $j < 25; $j++){
            $newArray = [];
            foreach ($array as $i => $item) {
                if ($item == 0) {
                    $newArray[] = "1";
                } else if (strlen($item) % 2 == 0) {
                    $newArray[] = (string)(int)substr($item, 0, strlen($item) / 2);
                    $newArray[] = (string)(int)substr($item, strlen($item) / 2, strlen($item) / 2);
                } else {
                    $newArray[] = (string)($item * 2024);
                }
            }
            $array = $newArray;
        }

        $this->result = count($newArray);
    }
}