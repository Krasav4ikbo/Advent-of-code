<?php
include_once './../AdventTask.php';

class Part_2 extends AdventTask
{
    public $red = 0;
    public $green = 0;
    public $blue = 0;

    public function execute(): void
    {
        foreach ($this->table as $row) {
            $this->red = 0;
            $this->green = 0;
            $this->blue = 0;

            $game = explode(':', $row);

            $gameSets = explode(';', $game[1]);

            foreach ($gameSets as $gameSet) {
                $gameCubes = explode(',', $gameSet);
                foreach ($gameCubes as $gameCube) {
                    $color = trim(preg_replace('/[0-9]+/', '', $gameCube));
                    $count = preg_replace('/[^0-9]/', '', $gameCube);
                    switch ($color) {
                        case 'red':
                            if ($count > $this->red) $this->red = $count;
                            break;
                        case 'green':
                            if ($count > $this->green) $this->green = $count;
                            break;
                        case 'blue':
                            if ($count > $this->blue) $this->blue = $count;
                            break;
                        default:
                            echo 'error - ' . $color . ' - ' . $count;
                            break;
                    }
                }
            }

            $this->result += $this->red*$this->green*$this->blue;
        }
    }
}