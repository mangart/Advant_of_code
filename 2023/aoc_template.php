<?php

function part1($file){
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
	}
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day1_input.txt');
part2('day1_input.txt');
?>

