<?php
include_once './../AdventTask.php';

class PartOne extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $row) {
            $this->calculate($row);
        }
    }

    public function calculate($string)
    {
        preg_match_all('~mul\(\d{1,3},\d{1,3}\)~', $string, $matches);

        foreach ($matches[0] as $match) {
            $match = preg_replace('~mul\(~', '', $match);
            $match = preg_replace('~\)~', '', $match);
            $numbers = explode(',', $match);
            $this->result += $numbers[0] * $numbers[1];
        }
    }
}