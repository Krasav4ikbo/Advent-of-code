<?php
include_once './../AdventTask.php';

class PartTwo extends AdventTask
{
    public function getUnsafe($numbers): array
    {
        $unsafe = [];
        if ($numbers[0] - $numbers[1] < 0) {
            $path = true;
        } else {
            $path = false;
        }

        foreach ($numbers as $key => $number) {
            if (count($numbers) - 1 == $key) {
                continue;
            }

            $diff = $number - $numbers[$key+1];

            if (($diff < 0 && !$path)
                || ($diff > 0 && $path)
                || $diff == 0
                || abs($diff) > 3
            ) {
                $unsafe []= $key;
            }
        }

        return $unsafe;
    }

    public function execute(): void
    {
        foreach ($this->table as $rowKey => $row) {
            $numbers = explode( ' ', $row);

            $unsafe = $this->getUnsafe($numbers);

            if (count($unsafe) > 0) {

                foreach ($unsafe as $unsafeValue) {
                    $arr = [];
                    $arrN = [];
                    $arrNT = [];
                    foreach ($numbers as $key => $number) {
                        if ($key != $unsafeValue) {
                            $arr[]=$number;
                        }

                        if ($key != $unsafeValue + 1) {
                            $arrN[]=$number;
                        }

                        if ($key != $unsafeValue - 1) {
                            $arrNT[]=$number;
                        }
                    }

                    $newUnsafe = $this->getUnsafe($arrNT);
                    if (count($newUnsafe) != 0) {

                        $newUnsafe = $this->getUnsafe($arr);
                        if (count($newUnsafe) == 0) {
                            $this->result++;
                            break;
                        } else {
                            $newUnsafe = $this->getUnsafe($arrN);
                            if (count($newUnsafe) == 0) {
                                $this->result++;
                                break;
                            }
                        }
                    } else {
                        $this->result++;
                        break;
                    }
                }

            } else {
                $this->result++;
            }
        }
    }
}