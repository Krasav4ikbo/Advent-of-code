<?php
namespace App\Year2015\Day7;

class PartTwo extends PartOne
{
    public function execute(): void
    {
        parent::execute();

        $this->values = [
            'b' => $this->result
        ];

        $this->findAllValues();
    }
}