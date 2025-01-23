<?php
namespace App\Year2015\Day1;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public function execute(): void
    {
        $string = str_split($this->table[0]);

        foreach ($string as $key => $row) {
            $this->result = ($row === '(') ? $this->result+1 : $this->result-1;
            if($this->result === -1) {
                $this->result = $key + 1;
                return;
            }
        }
    }
}