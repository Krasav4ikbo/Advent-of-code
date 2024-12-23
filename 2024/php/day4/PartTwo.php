<?php
include_once './../AdventTaskSplit.php';

class PartTwo extends AdventTaskSplit
{
    public $letters = ['M', 'S'];
    public function execute(): void
    {
        foreach ($this->table as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($this->table[$i][$j] == 'A') {
                    if(!empty($this->table[$i+1][$j+1]) && !empty($this->table[$i-1][$j-1])
                        && in_array($this->table[$i+1][$j+1], $this->letters)
                        && in_array($this->table[$i-1][$j-1], $this->letters)
                        && $this->table[$i+1][$j+1] != $this->table[$i-1][$j-1]
                        && in_array($this->table[$i+1][$j-1], $this->letters)
                        && in_array($this->table[$i-1][$j+1], $this->letters)
                        && $this->table[$i+1][$j-1] != $this->table[$i-1][$j+1]
                ) {
                        $this->result++;
                    }
                }
            }
        }
    }
}