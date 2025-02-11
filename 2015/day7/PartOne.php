<?php
namespace App\Year2015\Day7;

use App\AdventTask;

class PartOne extends AdventTask
{
    protected array $instructions;
    protected array $values;

    const string SEARCH_KEY = 'a';

    public function execute(): void
    {
        foreach ($this->table as $value)
        {
            $instruction = explode(' -> ', $value);

            $this->instructions[$instruction[1]] = $instruction[0];
        }

        $this->findAllValues();
    }

    public function findValueByInstruction($key): void
    {
        if (!empty($this->values[$key])) {
            return;
        }

        if (is_numeric($key)) {
            $this->values[$key] = (int) $key;
            return;
        }

        $instruction = explode(' ', $this->instructions[$key]);

        if (count($instruction) === 1) {
            $this->findValueByInstruction($instruction[0]);

            $this->values[$key] = (int) $this->values[$instruction[0]];

            return;
        }

        if (count($instruction) === 2) {
            $this->findValueByInstruction($instruction[1]);

            $this->values[$key] = 65535 - $this->values[$instruction[1]];
        }

        if (count($instruction) === 3) {
            $this->findValueByInstruction($instruction[0]);

            $this->findValueByInstruction($instruction[2]);

            $this->values[$key] = match ($instruction[1]) {
                "LSHIFT" => $this->values[$instruction[0]] << $this->values[$instruction[2]],
                "RSHIFT" => $this->values[$instruction[0]] >> $this->values[$instruction[2]],
                "OR" => $this->values[$instruction[0]] | $this->values[$instruction[2]],
                default => $this->values[$instruction[0]] & $this->values[$instruction[2]],
            };
        }
    }

    protected function findAllValues(): void
    {
        foreach ($this->instructions as $key => $instruction) {
            $this->findValueByInstruction($key);
        }

        $this->result = $this->values[self::SEARCH_KEY];
    }
}