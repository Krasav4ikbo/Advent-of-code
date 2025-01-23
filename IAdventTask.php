<?php
namespace App;

interface IAdventTask
{
    public function readFile($path): void;

    public function prepareData(): void;

    public function execute(): void;

    public function init($input): void;
}