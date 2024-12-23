<?php
include_once './PartOne.php';
class PartTwo extends PartOne
{
    public function search($numbers, $main, $result): bool
    {
        if (count($numbers) > 0) {
            $first = array_shift($numbers);
            $one = $this->search($numbers, $main, $result + $first);
            $two = $this->search($numbers, $main, $result * $first);

            if ($one || $two) {
                return true;
            }

            $three = $this->search($numbers, $main, $result.$first);

            if ($three) {
                return true;
            }
        } else if ($main == $result) {
            return true;
        }

        return false;
    }


}