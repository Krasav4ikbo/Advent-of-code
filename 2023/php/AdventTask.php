<?php
include_once 'IAdventTask.php';

class AdventTask implements IAdventTask
{
    public int $result = 0;

    public string $content;

    public array $table = [];

    public function init($input): void
    {
        $this->readFile($input);
        $this->prepareData();
        $this->execute();
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
}