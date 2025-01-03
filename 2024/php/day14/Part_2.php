<?php
include_once './../AdventTask.php';

class Part_2 extends AdventTask
{
    public $x = 101;
    public $y = 103;
    public $count = 100;

    public function execute(): void
    {
        for ($i = 1000; $i < 10000; $i++) {
            $this->count = $i;
            $visited = [];
            $visitCount = 0;
            foreach ($this->table as $row) {
                $a = explode(' v=', $row);
                $v = explode(',', $a[1]);

                $cords = explode(',', substr($a[0], 2));
                $x = ($cords[0] + $v[0] * $this->count) % $this->x;
                $y = ($cords[1] + $v[1] * $this->count) % $this->y;

                if ($x < 0) {
                    $x = $this->x + $x;
                }

                if ($y < 0) {
                    $y = $this->y + $y;
                }

                if (empty($visited[$x][$y])) {
                    $visited[$x][$y] = 1;
                    $visitCount++;
                } else {
                    break;
                }
            }

            if ($visitCount == count($this->table)) {
                $this->result = $i;
//                for ($i = 0; $i < $this->x; $i++) {
//                    $str = '';
//                    for ($j = 0; $j < $this->y; $j++) {
//                        $str .= !empty($visited[$i][$j]) ? '1' : '.';
//                    }
//                    echo $str . PHP_EOL;
//                }
//                break;
            }
        }
    }
}
