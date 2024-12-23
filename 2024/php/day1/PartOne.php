<?php
include_once './../AdventTask.php';

class PartOne extends AdventTask
{
    protected array $left = [];

    protected array $right = [];

    public function execute(): void
    {
        $this->sortLeftRight();

        for ($i = 0; $i < count($this->left); $i++) {
            $this->result+= abs($this->left[$i] - $this->right[$i]);
        }
    }

    protected function sortLeftRight(): void
    {
        foreach ($this->table as $row) {
            $numbers = explode('   ', $row);
            $this->left []=$numbers[0];
            $this->right []=$numbers[1];
        }

        sort($this->left);
        sort($this->right);
    }
}