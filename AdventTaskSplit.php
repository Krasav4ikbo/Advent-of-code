<?php
namespace App;

include_once __DIR__ . '/AdventTask.php';

class AdventTaskSplit extends AdventTask
{
    public function prepareData(): void
    {
        parent::prepareData();

        foreach ($this->table as $key => $item) {
            $this->table[$key] = str_split($item);
        }
    }
}