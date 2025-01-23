<?php
namespace App\Year2015\Day4;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public function execute(): void
    {
        $key = $this->table[0];
        $find = '';
        $i = 0;
        while (substr($find, 0, 6) !== '000000') {
            $i++;
            $find = md5($key.$i);
        }

        $this->result = $i;
    }
}