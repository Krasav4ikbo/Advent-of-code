<?php
include_once './../AdventTaskSplit.php';
class Part_2 extends AdventTaskSplit
{
    public $currentPos = [0,0];
    public $newMap = [];
    public function execute(): void
    {
        $rules = false;
        $rulesArr = [];
        foreach ($this->table as $i => $row) {
            if (empty($row)) {
                $rules = true;
            }
            foreach ($row as $j => $item) {
                if ($rules) {
                    $rulesArr []= $item;
                } else {
                    if ($item == '@') {
                        $this->newMap[$i][] = '@';
                        $this->newMap[$i][] = '.';
                    }

                    if ($item == '#') {
                        $this->newMap[$i][] = '#';
                        $this->newMap[$i][] = '#';
                    }

                    if ($item == 'O') {
                        $this->newMap[$i][] = '[';
                        $this->newMap[$i][] = ']';
                    }

                    if ($item == '.') {
                        $this->newMap[$i][] = '.';
                        $this->newMap[$i][] = '.';
                    }
                }

            }
        }
        $str = "";
        foreach ($this->newMap as $i => $row) {
            foreach ($row as $j => $item) {
                $str .=$item;
            }
            $str .=PHP_EOL;
        }

        foreach ($this->newMap as $i => $row) {
            foreach ($row as $j => $item) {
                if ($item == '@') {
                    $this->newMap[$i][$j] = '.';
                    $this->currentPos = [$i, $j];
                    break;
                }
            }
        }



        foreach ($rulesArr as $i => $rule) {
            if (in_array($rule, ['<', '>'])) {
                $this->nextStep($this->currentPos[0], $this->currentPos[1], $rule);
            } else {

                if ($this->checkNextStepUpDown($this->currentPos[0], $this->currentPos[1], $rule) === true) {
                    $this->nextStepUpDown($this->currentPos[0], $this->currentPos[1], $rule);
                }
            }

            $this->newMap[$this->currentPos[0]][$this->currentPos[1]] = '@';

//            $str .=PHP_EOL;
//            $str .= "Move: " . $rule . PHP_EOL;
//            foreach ($this->newMap as $row) {
//                foreach ($row as $item) {
//                    $str .=$item;
//                }
//                $str .=PHP_EOL;
//            }
            $this->newMap[$this->currentPos[0]][$this->currentPos[1]] = '.';
        }

        $this->newMap[$this->currentPos[0]][$this->currentPos[1]] = '@';

        foreach ($this->newMap as $i => $row) {
            foreach ($row as $j => $item) {
                if ($item == '[') {
                    $this->result+= $i*100 + $j;
                }
//                echo $item;
            }
//            echo PHP_EOL;
        }
    }

    public function nextStepUpDown($i,$j,$way)
    {
        switch ($way) {
            case "^":
                $i--;
                break;
            case "v":
                $i++;
                break;
        }

        if (in_array($this->newMap[$i][$j], ['[',']'])) {
            if ($this->newMap[$i][$j] == ']') {
                if ($this->upDownMove($i,$j,$way) && $this->upDownMove($i,$j-1,$way)) {
                    $this->newMap[$i][$j] = '.';
                    $this->newMap[$i][$j-1] = '.';
                    switch ($way) {
                        case "^":
                            $this->newMap[$i-1][$j] = ']';
                            $this->newMap[$i-1][$j-1] = '[';
                            break;
                        case "v":
                            $this->newMap[$i+1][$j] = ']';
                            $this->newMap[$i+1][$j-1] = '[';
                            break;
                    }
                }
            }

            if ($this->newMap[$i][$j] == '[') {
                if ($this->upDownMove($i,$j, $way) && $this->upDownMove($i,$j+1, $way)) {
                    $this->newMap[$i][$j] = '.';
                    $this->newMap[$i][$j+1] = '.';
                    switch ($way) {
                        case "^":
                            $this->newMap[$i-1][$j] = '[';
                            $this->newMap[$i-1][$j+1] = ']';
                            break;
                        case "v":
                            $this->newMap[$i+1][$j] = '[';
                            $this->newMap[$i+1][$j+1] = ']';
                            break;
                    }
                }
            }
        }

        if ($this->newMap[$i][$j] == '.') {
            $this->currentPos = [$i, $j];
        }
    }

    public function checkNextStepUpDown($i,$j,$way): bool
    {
        switch ($way) {
            case "^":
                $i--;
                break;
            case "v":
                $i++;
                break;
        }

        if (in_array($this->newMap[$i][$j], ['[',']'])) {
            if ($this->newMap[$i][$j] == ']') {
                return $this->checkNextStepUpDown($i,$j,$way) && $this->checkNextStepUpDown($i,$j-1,$way);
            }

            if ($this->newMap[$i][$j] == '[') {
                return $this->checkNextStepUpDown($i,$j, $way) && $this->checkNextStepUpDown($i,$j+1, $way);
            }
        }

        if ($this->newMap[$i][$j] == '.') {
            return true;
        }

        return false;
    }

    public function upDownMove($i,$j,$way)
    {
        switch ($way) {
            case "^":
                $i--;
                break;
            case "v":
                $i++;
                break;
        }

        if ($this->newMap[$i][$j] == ']') {
            if ($this->upDownMove($i,$j, $way) && $this->upDownMove($i,$j-1, $way)) {
                $this->newMap[$i][$j] = '.';
                $this->newMap[$i][$j-1] = '.';
                switch ($way) {
                    case "^":
                        $i--;
                        break;
                    case "v":
                        $i++;
                        break;
                }
                $this->newMap[$i][$j] = ']';
                $this->newMap[$i][$j-1] = '[';
                return true;
            }
        } else if ($this->newMap[$i][$j] == '[') {
            if ($this->upDownMove($i,$j, $way) && $this->upDownMove($i,$j+1, $way)) {
                $this->newMap[$i][$j] = '.';
                $this->newMap[$i][$j+1] = '.';
                switch ($way) {
                    case "^":
                        $i--;
                        break;
                    case "v":
                        $i++;
                        break;
                }
                $this->newMap[$i][$j] = '[';
                $this->newMap[$i][$j+1] = ']';
                return true;
            }
        }

        if ($this->newMap[$i][$j] == '.') {
            return true;
        }

        return false;
    }


    public function nextStep($i, $j, $way): void
    {
        switch ($way) {
            case ">":
                $j++;
                break;
            case "<":
                $j--;
                break;
        }

        if (in_array($this->newMap[$i][$j], ['[',']'])) {
            if ($this->move($i,$j, $way)) {
                $this->newMap[$i][$j] = '.';
            }
        }

        if ($this->newMap[$i][$j] == '.') {
            $this->currentPos = [$i, $j];
        }
    }

    public function move($i, $j, $way)
    {
        $current = $this->newMap[$i][$j];
        switch ($way) {
            case ">":
                $j++;
                break;
            case "<":
                $j--;
                break;
        }

        if (in_array($this->newMap[$i][$j], ['[',']'])) {
            if ($this->move($i,$j, $way)) {
                $this->newMap[$i][$j] = '.';
            }
        }

        if ($this->newMap[$i][$j] == '.') {
            $this->newMap[$i][$j] = $current;
            return true;
        }

        return false;
    }
}
