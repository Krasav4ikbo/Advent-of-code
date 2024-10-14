<?php
include_once './../AdventTask.php';

class Part_1 extends AdventTask
{
    const RED = 12;
    const GREEN = 13;
    const BLUE = 14;

    public function execute(): void
    {
        foreach ($this->table as $row) {
            $game = explode(':', $row);

            $gameNumber = preg_replace('/[^0-9]/', '', $game[0]);

            $gameSets = explode(';', $game[1]);

            $isGamePossible = true;
            foreach ($gameSets as $gameSet) {
                $gameCubes = explode(',', $gameSet);
                foreach ($gameCubes as $gameCube) {
                    $color = trim(preg_replace('/[0-9]+/', '', $gameCube));
                    $count = preg_replace('/[^0-9]/', '', $gameCube);
                    switch ($color) {
                        case 'red':
                            if ($count > self::RED)
                                $isGamePossible = false;
                            break;
                        case 'green':
                            if ($count > self::GREEN)
                                $isGamePossible = false;
                            break;
                        case 'blue':
                            if ($count > self::BLUE)
                                $isGamePossible = false;
                            break;
                        default:
                            echo 'error - ' . $color . ' - ' . $count;
                            break;
                    }
                }
            }

            if ($isGamePossible) {
                $this->result += $gameNumber;
            }
        }
    }
}