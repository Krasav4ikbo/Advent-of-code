<?php
include_once './../AdventTask.php';
class PartOne extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $i => $row) {
            $numbs = explode(': ', $row);
            $main = $numbs[0];
            $numbers = explode(' ', $numbs[1]);
            $first = array_shift($numbers);

            if ($this->search($numbers, $main, $first)) {
                $this->result+=(int) $main;
            }
        }
    }

    public function search($numbers, $main, $result): bool
    {
        if (count($numbers) > 0) {
            $first = array_shift($numbers);
            $one = $this->search($numbers, $main, $result + $first);
            $two = $this->search($numbers, $main, $result * $first);
            if ($one || $two) {
                return true;
            }
        } else if ($main == $result) {
            return true;
        }

        return false;
    }
}