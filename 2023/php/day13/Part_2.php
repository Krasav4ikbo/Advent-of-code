<?php
include_once './../AdventTask.php';

class Part_2 extends AdventTask
{
    public $start = [];
    public $order = [];

    public $weigth = [];
    public $results = [];

    public function execute(): void
    {
        $new = [];
        foreach ($this->table as $key => $item) {
            if (empty(trim($item))) {
                $this->getPattern($new);
                $this->getPatternColumn($new);
                $new = [];
            } else {
                $new [] = $item;
            }
        }
        $this->getPattern($new);
        $this->getPatternColumn($new);
    }

    public function getPattern($table)
    {
        foreach ($table as $key => $value) {
            $min = min($key + 1, count($table) - $key - 1);
            $count = 0;
            $checked = false;
            if (!empty(trim($table[$key + 1])) && trim($table[$key + 1]) == trim($value)) {
                $count = 1;
                for ($i = 1; $i <= $min; $i++) {
                    if (trim($table[$key - $i]) == trim($table[$key + 1 + $i])) {
                        $count++;
                    } else if (!$checked) {
                        $sep = str_split(trim($table[$key - $i]));
                        foreach ($sep as $sepKey => $sepValue) {
                            $newArray = $sep;
                            $newArray[$sepKey] = ($sepValue == '.') ? '#' : '.';
                            $newStr = implode($newArray);
                            if ($newStr == trim($table[$key + 1 + $i])) {
                                $count++;
                                $checked = true;
                                break;
                            }
                        }
                    }
                }

                if ($count == $min && $checked) {
                    $this->result += 100 * ($key + 1);
                    return;
                }

            } else {
                echo $table[$key] . "\r\n";
                echo $table[$key + 1] . "\r\n";
                $sep = str_split(trim($table[$key]));
                foreach ($sep as $sepKey => $sepValue) {
                    $newArray = $sep;
                    $newArray[$sepKey] = ($sepValue == '.') ? '#' : '.';
                    $newStr = implode($newArray);
                    if ($newStr == trim($table[$key + 1])) {
                        $count++;
                        for ($i = 1; $i <= $min; $i++) {
                            if (trim($table[$key - $i]) == trim($table[$key + 1 + $i])) {
                                $count++;
                            }
                        }
                        if ($count == $min) {
                            $this->result += 100 * ($key + 1);
                            return;
                        }
                        break;
                    }
                }
            }
        }
    }

    public function getPatternColumn($tableColumn)
    {
        $table = [];
        foreach ($tableColumn as $key => $value) {
            $new = str_split($value);
            foreach ($new as $strKey => $strValue) {
                if (!empty(trim($strValue))) {
                    $table[$strKey][$key] = $strValue;
                }
            }
        }

        foreach ($table as $key => $value) {
            $table[$key] = implode($value);
        }

        foreach ($table as $key => $value) {
            $min = min($key + 1, count($table) - $key - 1);
            $count = 0;
            $checked = false;
            if (!empty(trim($table[$key + 1])) && trim($table[$key + 1]) == trim($value)) {
                $count = 1;
                for ($i = 1; $i <= $min; $i++) {
                    if (trim($table[$key - $i]) == trim($table[$key + 1 + $i])) {
                        $count++;
                    } else if (!$checked) {
                        $sep = str_split(trim($table[$key - $i]));
                        foreach ($sep as $sepKey => $sepValue) {
                            $newArray = $sep;
                            $newArray[$sepKey] = ($sepValue == '.') ? '#' : '.';
                            $newStr = implode($newArray);
                            if ($newStr == trim($table[$key + 1 + $i])) {
                                echo 'euquals NEW  $i - ' . $i . ' key - ' . $key . "\r\n";
                                $count++;
                                $checked = true;
                                break;
                            }
                        }
                    }
                }

                if ($count == $min && $checked) {
                    echo 'euquals NEW 22 $i - ' . $i . ' key - ' . $key . "\r\n";
                    $this->result += ($key + 1);
                    return;
                }

            } else {
                echo 'min - ' . $min . "\r\n";
                echo $table[$key] . "\r\n";
                echo $table[$key + 1] . "\r\n";
                $sep = str_split(trim($table[$key]));
                foreach ($sep as $sepKey => $sepValue) {
                    $newArray = $sep;
                    $newArray[$sepKey] = ($sepValue == '.') ? '#' : '.';
                    $newStr = implode($newArray);
                    if ($newStr == trim($table[$key + 1])) {
                        echo 'euquals NEW  1  - ' . ' key - ' . $key . "\r\n";
                        $count++;
                        for ($i = 1; $i <= $min; $i++) {
                            if (trim($table[$key - $i]) == trim($table[$key + 1 + $i])) {
                                $count++;
                            }
                        }
                        if ($count == $min) {
                            echo 'euquals ADD  1 ' .  ' key - ' . $key . "\r\n";
                            $this->result += ($key + 1);
                            return;
                        }
                        break;
                    }
                }
            }
        }

//        print_r($table);
    }

}