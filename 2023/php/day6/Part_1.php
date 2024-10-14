<?php
include_once './../AdventTask.php';

class Part_1 extends AdventTask
{
    public $times = [];
    public $distances = [];
    public $wins = [];

    public function execute(): void
    {
        $times = explode(': ', $this->table[0]);

        $times = explode('  ', $times[1]);

        foreach ($times as $time) {
            if ($time) {
                $this->times[]=(int)$time;
                $this->wins[]=0;
            }

        }

        $distances = explode(': ', $this->table[1]);

        $distances = explode('  ', $distances[1]);

        foreach ($distances as $distance) {
            if ($distance)
                $this->distances[]=(int)$distance;
        }

        $min = ceil($this->distances[0] / $this->times[0]);
        $max = $this->times[0] - $min;
        $this->result = $max - $min + 1;
        foreach ($this->times as $timeKey => $time) {
            for ($i = $min; $i < $time; $i++) {
                if ((($time - $i) * $i) > $this->distances[$timeKey]) {
                    $this->wins[$timeKey]++;
                }
            }
        }

        $this->result = 1;
        foreach ($this->wins as $win) {
            $this->result *= $win;
        }

    }

}
