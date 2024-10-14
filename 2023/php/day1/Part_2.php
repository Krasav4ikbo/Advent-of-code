<?php
include_once './../AdventTask.php';

class Part_2 extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $row) {
            $row = $this->convert($row);

            $numbers = preg_replace('/[^0-9]/', '', $row);

            $res = $numbers[0] * 10 + $numbers[strlen($numbers) - 1];

            $this->result += $res;
        }
    }

    public function convert($row): string
    {
        $stringArray = str_split($row);

        $replacedRow = '';

        foreach ($stringArray as $char) {
            $replacedRow .= $char;
            $this->convertWordsToLetters($replacedRow);
        }

        return $replacedRow;
    }

    public function convertWordsToLetters(&$row): void
    {
        $words = [
            'one' => 'o1e',
            'two' => 't2o',
            'three' => 't3e',
            'four' => 'f4r',
            'five' => 'f5e',
            'six' => 's6x',
            'seven' => 's7n',
            'eight' => 'e8t',
            'nine' => 'n9e'
        ];

        foreach ($words as $pattern => $value) {
            $row = preg_replace('/' . $pattern . '/', $value, $row);
        }
    }
}