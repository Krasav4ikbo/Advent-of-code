<?php
include_once './PartOne.php';
include_once './PartTwo.php';

$partOne = new PartOne();
$partOne->init('./input.txt');

$partTwo = new PartTwo();
$partTwo->init('./input.txt');