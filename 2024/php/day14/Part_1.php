<?php
include_once './../AdventTask.php';
class Part_1 extends AdventTask
{
    public $x = 101;
    public $y = 103;
    public $count = 100;
    public function execute(): void
    {
        $corners = [0,0,0,0];

        foreach ($this->table as $row){
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

            if ($x == ($this->x - 1) / 2 || $y == ($this->y - 1) / 2) {
            } else {
                if ($x > $this->x / 2) {
                    if ($y > $this->y / 2) {
                        $corners[3]++;
                    } else {
                        $corners[1]++;
                    }
                } else {
                    if ($y > $this->y / 2) {
                        $corners[2]++;
                    } else {
                        $corners[0]++;
                    }
                }
            }

            $this->result = 1;

            foreach ($corners as $v) {
                $this->result *=$v;
            }
        }
    }
}
