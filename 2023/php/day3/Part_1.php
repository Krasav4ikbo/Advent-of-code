<?php
include_once './../AdventTask.php';

class Part_1 extends AdventTask
{
    public function execute(): void
    {
        foreach ($this->table as $key => $row) {
            $replacedRow = 0;

            foreach ($row as $charKey => $charValue) {
                if (is_numeric($charValue)) {
                    $replacedRow = $replacedRow*10 + $charValue;
                }

                if (!is_numeric($charValue) || $charKey == count($row) - 1) {
                    $numberLength = strlen((string)$replacedRow);
                    if($numberLength > 0 && $replacedRow > 0) {
                        $isSum = false;
                        $charValue = trim($charValue);

                        if (!is_numeric($charValue) && (($charValue != '.' && $charValue != '') || ($charKey - $numberLength - 1 >= 0 && $row[$charKey - $numberLength - 1] != '.'))){
                            $this->result +=$replacedRow;
                            $isSum = true;
                        }

                        if (!$isSum) {
                            if ($key != 0) {
                                for ($i=0; $i <= $numberLength + 1; $i++) {
                                    if($charKey - $i < 0) {
                                        continue;
                                    }
                                    $check = trim($this->table[$key - 1][$charKey - $i]);
                                    if(!is_numeric($check) && $check != '' && $check != '.') {
                                        $isSum = true;
                                    }
                                }
                            }

                            if ($key != count($this->table) - 1) {
                                for ($i=0; $i <= $numberLength + 1; $i++) {
                                    if($charKey - $i < 0) {
                                        continue;
                                    }
                                    $check = trim($this->table[$key + 1][$charKey - $i]);
                                    if(!is_numeric($check) && $check != '' && $check != '.') {
                                        $isSum = true;
                                    }
                                }
                            }

                            if ($isSum) {
                                $this->result +=$replacedRow;
                            }
                        }
                    }
                    $replacedRow = 0;
                }
            }
        }
    }
}