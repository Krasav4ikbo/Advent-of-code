<?php
namespace App\Year2023\Day4;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public array $weight = [];

    public array $results = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $row) {
            $this->results[$key] = $this->getRowRes($row);
            $this->weight[$key] = 1;
        }

        foreach ($this->results as $key => $value) {
            for ($j=1; $j <= $this->weight[$key]; $j++) {
                for ($i = 1; $i <= $value; $i++) {
                    $this->weight[$key + $i] += 1;
                }
            }
        }

        $this->result = array_sum($this->weight);
    }

    public function getRowRes($row): int
    {
        $result = 0;

        $numbers = explode(': ', $row);

        $cards = explode(' | ', $numbers[1]);
        $winning = explode(' ', $cards[0]);
        $owned  = explode(' ', $cards[1]);
        $existing = [' ', ''];

        foreach ($owned as $value) {
            if (in_array($value, $winning) && !in_array($value, $existing)) {
                $result += 1;
                $existing [] = $value;
            }
        }

        return $result;
    }
}