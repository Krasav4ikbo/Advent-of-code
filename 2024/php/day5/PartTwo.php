<?php
include_once './PartOne.php';

class PartTwo extends PartOne
{
    public function execute(): void
    {
        list($numbers, $i) = $this->getNumbers();
        $i++;

        while ($i < count($this->table)) {
            $n = explode(',', $this->table[$i]);
            $correct = true;
            foreach ($n as $k => $v) {
                for ($j = 0; $j < $k; $j++) {
                    if (in_array($n[$j], $numbers[$v] ?? [])) {
                        $correct = false;
                        $temp = $n[$j];
                        $n[$j] = $n[$k];
                        $n[$k] = $temp;
                    }
                }
            }

            if (!$correct) {
                $this->result += (int) $n[count($n) / 2];
            }

            $i++;
        }
    }
}