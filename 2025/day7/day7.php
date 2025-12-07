<?php

function init($file) {
    $lines = file($file);
	$grid = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$temp = array();
		$line = str_split($line);
		array_push($grid,$line);
    }
	return $grid;
}

function part1($grid){
	$vsota = 0;
	
	return $vsota;
}

function part2($grid){
	$vsota = 0;
	
	return $vsota;
}

$grid = init('day7_sample_input.txt');
var_dump($grid);

$srt = microtime(true);
echo "The checksum for part1 is: ".part1($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";

$srt = microtime(true);
echo "The checksum for part2 is: ".part2($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";
?>