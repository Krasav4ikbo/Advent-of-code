<?php
include_once './../AdventTask.php';
class Part_1 extends AdventTask
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
                        'x' => preg_replace('~\D+~', '', $coords[0]),
                        'y' => preg_replace('~\D+~', '', $coords[1])
                    ];
                }
            }
        }
    }

    public function search($data)
    {
        $count = (int)($data['p']['x'] / $data['b']['x']);

        for ($i = 0; $i <= $count + 1; $i++) {
            $j = 0;
            while ($data['b']['x'] * ($count - $i) + ($data['a']['x'] * $j) < $data['p']['x']
                && ($data['b']['y'] * ($count - $i) + $data['a']['y'] * $j) < $data['p']['y']) {
                $j++;
            }

            if ($data['b']['x'] * ($count - $i) + ($data['a']['x'] * $j) == $data['p']['x']
                && ($data['b']['y'] * ($count - $i) + $data['a']['y'] * $j) == $data['p']['y']) {
                $this->result+= ($count - $i) + 3 * $j;
            }
        }
    }
}
