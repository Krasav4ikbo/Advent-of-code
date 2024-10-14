<?php
include_once './../AdventTask.php';

class Part_2 extends AdventTask
{
    public $new = [];

    public function execute() :void
    {
        foreach ($this->table as $key => $item) {
            $this->table[$key] = explode(' ', $item);
        }

        $current = [0, 0];
        $prev = '';

        foreach ($this->table as $key => $item) {
            $length = hexdec(substr(trim($item[2]), 2, 5));
            $side = '';
            switch (substr(trim($item[2]), 7, 1)) {
                case '0':
                    $side = 'R';
                    break;
                case '1':
                    $side = 'D';
                    break;
                case '2':
                    $side = 'L';
                    break;
                case '3':
                    $side = 'U';
                    break;
            }

            echo 'Side - ' . $side . ' length - ' . $length . "\r\n";

            for($i = 0; $i < $length; $i++) {
                switch ($side) {
                    case 'R':
                        if ($i == 0) {
                            switch ($prev){
                                case 'U':
                                    $this->new[$current[0]][$current[1]] = 'F';
                                    break;
                                case 'D':
                                    $this->new[$current[0]][$current[1]] = 'L';
                                    break;
                            }
                        }
                        $current[1]++;
                        break;
                    case 'D':
                        if ($i == 0) {
                            switch ($prev){
                                case 'R':
                                    $this->new[$current[0]][$current[1]] = '7';
                                    break;
                                case 'L':
                                    $this->new[$current[0]][$current[1]] = 'F';
                                    break;
                            }
                        }
                        $current[0]++;
                        break;
                    case 'L':
                        if ($i == 0) {
                            switch ($prev){
                                case 'U':
                                    $this->new[$current[0]][$current[1]] = '7';
                                    break;
                                case 'D':
                                    $this->new[$current[0]][$current[1]] = 'J';
                                    break;
                            }
                        }
                        $current[1]--;
                        break;
                    case 'U':
                        if ($i == 0) {
                            switch ($prev){
                                case 'R':
                                    $this->new[$current[0]][$current[1]] = 'J';
                                    break;
                                case 'L':
                                    $this->new[$current[0]][$current[1]] = 'L';
                                    break;
                            }
                        }
                        $current[0]--;
                        break;
                }
                $this->new[$current[0]][$current[1]] = '#';
            }
            $prev = $item[0];
        }

        $this->new[0][0] = '111';
        $maxY=0;
        $minY=0;
        foreach ($this->new as $x => $value)
        {
            $max = max(array_keys($value));
            $min = min(array_keys($value));
            if ($max > $maxY) {
                $maxY = $max;
            }
            if ($min < $minY) {
                $minY = $min;
            }
        }
        $table = [];
        foreach ($this->new as $x => $value)
        {
            for ($y = $minY; $y <= $maxY; $y++)
            {
                if (!empty($this->new[$x][$y])) {
                    $table[$x][$y] = $this->new[$x][$y];
                    $this->result++;
                } else {
                    $table[$x][$y] = '.';
                }
            }
        }

        foreach ($table as $x => $value)
        {
            $str =  implode('', $value);
            echo $str . "\r\n";
            $str = preg_replace('/F#*7/', '', $str);
            $str = preg_replace('/L#*J/', '', $str);
            $str = preg_replace('/F#*J/', '#', $str);
            $str = preg_replace('/L#*7/', '#', $str);
            $corner = 0;
            foreach (str_split($str) as $checkKey => $checkValue) {
                if ($checkValue == '#') {
                    $corner++;
                    continue;
                }
                if ($corner % 2 != 0) {
//                    echo '$x - '. $x . ' $checkValue - '. $checkValue . ' corner - ' . $corner . "\r\n";
                    $this->result++;
                }
            }
        }



//        print_r($this->new);
//        print_r($maxX);
//        print_r($maxY);


//        print_r($find);
    }

}