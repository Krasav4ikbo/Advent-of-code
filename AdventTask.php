<?php
namespace App;

include_once __DIR__ . '/IAdventTask.php';

class AdventTask implements IAdventTask
{
    public int $result = 0;

    public string $content;

    public array $table = [];

    protected float $start;

    protected float $end;

    public function init($input): void
    {
        $this->start  = microtime( true );

        $this->readFile($input);

        $this->prepareData();

        $this->execute();

        $this->end = microtime( true );

        $this->printResult();
    }

    public function prepareData(): void
    {
        $this->table = explode(PHP_EOL, $this->content);
    }

    public function execute(): void {}

    public function readFile($path): void
    {
        $this->content = file_get_contents($path);
    }

    public function printResult(): void
    {
        $yellowColor = "\033[33m";
        $defaultColor  = "\033[0m";

        printf( PHP_EOL );
        printf( $yellowColor . static::class . ': ' . $defaultColor . '%s' . PHP_EOL, $this->result);
        printf( $yellowColor . 'Time: ' . $defaultColor . '%s seconds' . PHP_EOL, round( $this->end - $this->start, 4 ) );
        printf( $yellowColor . 'Peak memory: ' . $defaultColor . '%s MiB' . PHP_EOL, round(memory_get_peak_usage()/pow(2, 20), 4) );
        printf( PHP_EOL );
    }
}