<?php

include_once './Part_1.php';
include_once './Part_2.php';

$part_1 = new Part_1();
$part_1->init('./input.txt');
echo "Result for part 1 = " . $part_1->result . "\r\n";

$part_2 = new Part_2();
$part_2->init('./input.txt');
echo "Result for part 2 = " . $part_2->result . "\r\n";