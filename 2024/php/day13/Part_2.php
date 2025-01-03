<?php
include_once './../AdventTask.php';
class Part_2 extends AdventTask
{
    public function execute(): void
    {
        $data = [];
        foreach ($this->table as $row){
            if (empty($row)) {
                $this->search($data);
                $data = [];
            } else {
                $array = explode('Button A: ', $row);

                if (count($array) > 1) {
                    $coords = explode(',', $array[1]);
                    $data['a'] = [
                        'x' => preg_replace('~\D+~', '', $coords[0]),
                        'y' => preg_replace('~\D+~', '', $coords[1])
                    ];
                }

                $array = explode('Button B: ', $row);

                if (count($array) > 1) {
                    $coords = explode(',', $array[1]);
                    $data['b'] = [
                        'x' => preg_replace('~\D+~', '', $coords[0]),
                        'y' => preg_replace('~\D+~', '', $coords[1])
                    ];
                }

                $array = explode('Prize: ', $row);

                if (count($array) > 1) {
                    $coords = explode(',', $array[1]);
                    $data['p'] = [
                        'x' => 10000000000000 + preg_replace('~\D+~', '', $coords[0]),
                        'y' => 10000000000000 + preg_replace('~\D+~', '', $coords[1])
                    ];
                }
            }
        }
    }

    public function search($data)
    {
        $ax = $data['b']['x'];
        $bx = $data['b']['y'];

        $axp = $data['p']['x'] * $bx;
        $bxp = $data['p']['y'] * $ax;

        $axValue = $data['a']['x'] * $bx;

        $byValue = $data['a']['y'] * $ax;

        $y = abs($axp - $bxp) / abs($axValue - $byValue);

        if (is_int($y)) {
            $x = ($data['p']['x'] - $y*$data['a']['x']) / $data['b']['x'];
            if (is_int($x)) {
                $this->result+= $x + 3 * $y;
            }
        }
    }
}