<?php
include_once './Part_1.php';

$part_1 = new Part_1();
$part_1->init('./input_part_1.txt');
echo "Result for part 1 = " . $part_1->result . "\r\n";