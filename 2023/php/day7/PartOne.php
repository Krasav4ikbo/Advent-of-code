<?php
namespace App\Year2023\Day7;

use App\AdventTask;

class PartOne extends AdventTask
{
    public $cards = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function execute(): void
    {
        foreach ($this->table as $item) {
            $data = explode(' ', $item);

            $this->cards[$data[0]]= $data[1];
//            $this->weigth []= $data[1];
        }

        foreach ($this->cards as $key => $card) {
            $check = str_split($key);
            $sum = [];
            foreach ($check as $keyCheck => $valueCheck) {
                if (!in_array($valueCheck, array_keys($sum))) {
                    $sum[$valueCheck] = 1;
                } else {
                    $sum[$valueCheck] += 1;
                }
            }
            $jokers = $sum['J'] ?? 0;
            unset($sum['J']);
            sort($sum);

            $position = 0;
            foreach ($sum as $sumValue) {
                if ($sumValue > 1) {
                    switch ($sumValue){
                        case 2:
                            if ($position == 3) {
                                $position = 4;
                            } else if ($position == 1) {
                                $position = 2;
                            } else {
                                $position = 1;
                            }
                            break;
                        case 3:
                            if ($position == 1) {
                                $position = 4;
                            } else {
                                $position = 3;
                            }
                            break;
                        case 4:
                            $position = 5;
                            break;
                        case 5:
                            $position = 6;
                            break;
                        default: break;
                    }
                }
            }

            if ($jokers > 0) {
                switch ($position) {
                    case 5:
                        $position = 6;
                        break;
                    case 3:
                        $position += $jokers + 1;
                        break;
                    case 2:
                        $position = 4;
                        break;
                    case 1:
                        if ($jokers == 1) {
                            $position = 3;
                        }
                        if ($jokers == 2) {
                            $position = 5;
                        }
                        if ($jokers == 3) {
                            $position = 6;
                        }
                        break;
                    case 0:
                        if ($jokers == 1) {
                            $position = 1;
                        }
                        if ($jokers == 2) {
                            $position = 3;
                        }
                        if ($jokers == 3) {
                            $position = 5;
                        }
                        if ($jokers == 4) {
                            $position = 6;
                        }
                        if ($jokers == 5) {
                            $position = 6;
                        }
                        break;
                }
            }

            $this->results[$position][$key] = $card;
        }

        $order = ['A' => 'a', 'K' => 'b', 'Q' => 'c', 'T' =>'d' , '9'=>'e', '8'=>'f', '7'=>'g', '6'=>'h', '5'=>'i', '4'=>'j', '3'=>'k', '2'=>'l', 'J' => 'z'];

        $count = count($this->cards);
        for ($i = count($this->cards); $i >= 0; $i--) {
            $res = [];
            if (!empty($this->results[$i])) {
                foreach ($this->results[$i] as $key => $value) {
                    $check = str_split($key);
                    $new = '';
                    foreach ($check as $item) {
                        $new.=$order[$item];
                    }

                    $res[$new] = $value;
                }
                ksort($res);

                foreach ($res as $resVal) {
                    $this->result += $resVal * $count;
                    $count--;
                }
            }
        }
    }

}
