<?php
namespace App\Year2015\Day5;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $value)
        {
            $pair = [];
            $triple = 0;
            $string = str_split($value);
            foreach ($string as $key=>$char) {
                if($key >= count($string) - 1) {
                    break;
                }

                // init pair array
                if (empty($pair[$char.$string[$key + 1]])) {
                    $pair[$char.$string[$key + 1]] = 0;
                }

                // check pair from same chars
                if ($string[$key + 1] == $char) {
                    // check is it quattro or not triple
                    if (empty($string[$key + 2])
                        || ($string[$key + 2] != $char)
                        || (empty($string[$key + 3]) || ($string[$key + 3] == $char))
                    ){
                        $pair[$char.$string[$key + 1]]++;
                    }
                } else {
                    $pair[$char.$string[$key + 1]]++;
                }

                if(!empty($string[$key + 1]) && !empty($string[$key + 2]) && $string[$key + 2] == $char) {
                    $triple++;
                }
            }

            foreach ($pair as $pairKey => $pairValue) {
                if($pairValue > 1 && $triple > 0) {
                    $this->result++;
                    break;
                }
            }
        }
    }
}