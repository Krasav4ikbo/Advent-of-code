<?php
include_once './../AdventTask.php';

class PartOne extends AdventTask
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
                    }
                }
            }

            if ($correct) {
                $this->result += (int) $n[count($n) / 2];
            }

            $i++;
        }
    }

    protected function getNumbers()
    {
        $i = 0;
        $numbers = [];
        while ($this->table[$i] !== "") {
            $n = explode('|', $this->table[$i]);
            $numbers[$n[0]][] = $n[1];
            $i++;
        }

        return [$numbers, $i];
    }
}