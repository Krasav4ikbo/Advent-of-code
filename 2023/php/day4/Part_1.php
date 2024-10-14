<?php
include_once './../AdventTask.php';

class Part_1 extends AdventTask
{
    public function checkRow($row): void
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

        if ($result > 0) {
            $this->result += pow(2, $result-1);
        }
    }
}