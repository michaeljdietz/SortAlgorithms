<?php

require_once 'MergeSort.php';
require_once 'QuickSort.php';
require_once 'SortUtility.php';

$array = ["A" => 4, "B" => 2, "C" => 6, "D" => 200, "E" => 0];
$array = [2, 1];
$array = SortUtility::populateArray(20000);
$array2 = $array;

$start = microtime(true);
MergeSort::Sort($array2);
$ms = microtime(true) - $start;

$start = microtime(true);
QuickSort::Sort($array);
$qs = microtime(true) - $start;

echo "QuickSort: $qs seconds, MergeSort: $ms seconds" . PHP_EOL;