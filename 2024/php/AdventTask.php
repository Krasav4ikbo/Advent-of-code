<?php
include_once 'IAdventTask.php';

class AdventTask implements IAdventTask
{
    public int $result = 0;

    public string $content;

    public array $table = [];

    protected $start;

    protected $end;

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

    public function printResult()
    {
        $yellow = "\033[33m";
        $reset  = "\033[0m";

        printf( PHP_EOL );
        printf( $yellow . static::class . ': ' . $reset . '%s' . PHP_EOL, $this->result);
        printf( $yellow . 'Time: ' . $reset . '%s seconds' . PHP_EOL, round( $this->end - $this->start, 4 ) );
        printf( PHP_EOL );
    }
}