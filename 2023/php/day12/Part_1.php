<?php
include_once './../AdventTask.php';

class Part_1 extends AdventTask
{
    public $start = [];
    public $order = [];

    public $weigth = [];
    public $results = [];


    public function execute(): void
    {
        foreach ($this->table as $key => $item) {
            $combinations = [];
            $value = explode(' ', $item);
            $string = $value[0];
            $count = explode(',', $value[1]);
//            print_r($count);
            $temp = $string;
            foreach ($count as $numKey => $number) {
                $start = $numKey;
                while($start + $number < strlen($string)) {
                    $str = substr($temp, $start, $number+1);

                    if (substr_count($str, '#') <= $number && substr_count($str, '?') > 0 && strlen($str) > $number) {
                        $common = 0;
//                        echo 'str - ' . $str . ' - ' . substr_count($str, '#') . ' number  - ' . $number . "\r\n";
                        for ($i = 0; $i < strlen($str); $i++) {
//                            echo 'str - ' . $str . ' -  $common ' . $common. "\r\n";
                            if ($common == strlen($str) - 1) {
                                break;
                            }
                            if (in_array($str[$i], ['?', '#'])) {
                                $common++;
                            } else {
                                $common = 0;
                            }
                        }

                        if ($common == strlen($str) - 1) {
                            $combinations[$numKey][]=$str;
                        }
                    }
                    $start++;
                }
                $temp = substr($temp, $number);
                print_r($temp);
            }
            print_r($combinations);
            $res = count($combinations[count($combinations) - 1]);
            echo '$res - ' . $res  . "\r\n";
            echo '$res - ' . (count($combinations) > 1) ? $res * 2 : $res  . "\r\n";
            $this->result+=(count($combinations) > 1) ? $res * 2 : $res;
        }
    }
}