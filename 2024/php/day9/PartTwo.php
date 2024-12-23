<?php
include_once './../AdventTaskSplit.php';
class PartTwo extends AdventTaskSplit
{
    public function execute(): void
    {
        $restructValues = [];
        foreach ($this->table[0] as $i => $value) {
            $val = ".";
            if ($i == 0 || $i % 2 == 0) {
                $val = $i / 2;
            }

            $restructValues[]=[
                ['value' => $value, 'index' => $val]
            ];
        }

        for ($i = count($restructValues) - 1; $i > 0; $i-=2) {
            $j = 1;
            while ($j < $i) {
                if ($restructValues[$j][0]['value'] >= $restructValues[$i][0]['value']) {
                    $restructValues[$j][0]['value'] = $restructValues[$j][0]['value'] - $restructValues[$i][0]['value'];
                    $restructValues[$j][]=[
                        'value' => $restructValues[$i][0]['value'], 'index' => $restructValues[$i][0]['index']
                    ];

                    $restructValues[$i][]=[
                        'value' => $restructValues[$i][0]['value'], 'index' => "."
                    ];

                    $restructValues[$i][0]['value'] = 0;
                }

                $j+=2;
            }
        }

        $resultRow = [];
        foreach ($restructValues as $value) {
            if (count($value) != 1) {
                for ($i = 1; $i < count($value); $i++) {
                    for ($j = 0; $j < $value[$i]['value']; $j++) {
                        $resultRow[]=$value[$i]['index'];
                    }
                }
            }

            for ($j = 0; $j < $value[0]['value']; $j++) {
                $resultRow[]=$value[0]['index'];
            }
        }

        foreach ($resultRow as $i => $value) {
            if ($value != ".") {
                $this->result += $i * $value;
            }
        }
    }
}