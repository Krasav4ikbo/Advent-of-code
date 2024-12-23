<?php
include_once './PartOne.php';

class PartTwo extends PartOne
{
    public function execute(): void
    {
        $this->sortLeftRight();

        for ($i = 0; $i < count($this->left); $i++) {
            $count = 0;
            foreach ($this->right as $number) {
                if($number == $this->left[$i]) {
                    $count++;
                }
            }
            $this->result += $count * $this->left[$i];
        }
    }
}