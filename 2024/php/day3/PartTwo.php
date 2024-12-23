<?php
include_once './PartOne.php';

class PartTwo extends PartOne
{
    public function execute(): void
    {
        $fullString = "";

        foreach ($this->table as $row) {
            $fullString.=$row;
        }

        $donts = explode("don't()", $fullString);

        $this->calculate($donts[0]);

        array_shift($donts);

        foreach ($donts as $dont) {
            $dos = explode('do()', $dont);
            foreach ($dos as $doCount => $do) {
                if($doCount > 0) {
                    $this->calculate($do);
                }
            }
        }
    }


}