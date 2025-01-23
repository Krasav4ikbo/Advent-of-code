<?php
namespace App\Year2023\Day15;

use App\AdventTask;

class PartOne extends AdventTask
{
    public function execute(): void
    {
//        foreach ($this->table as $key => $item) {
//            $new = explode(',', $item);
//            foreach ($new as $chars) {
//                $res = 0;
//                foreach (mb_str_split($chars) as $char) {
//                    $res += mb_ord($char);
//                    $res *= 17;
//                    if ($res > 256) {
//                        $res = $res - ((int)($res / 256) * 256);
//                    }
//                }
//                $this->result += $res;
//            }
//        }

        foreach ($this->table as $key => $item) {
            $new = explode(',', $item);
            foreach ($new as $chars) {
                $res = 0;
                foreach (unpack("C*", $chars) as $char) {
                    $res += $char;
                    $res *= 17;
                    $res = $res % 256;
                }
                $this->result += $res;
            }
        }

    }
}