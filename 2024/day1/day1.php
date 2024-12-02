<?php

function part1($file){
	$vsota = 0;
	$stolpec1 = array();
	$stolpec2 = array();
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
		$stolpci = array_map("intval",explode("   ",$line));
		array_push($stolpec1,$stolpci[0]);
		array_push($stolpec2,$stolpci[1]);
	}
	sort($stolpec1);
	sort($stolpec2);
	if(count($stolpec1) == count($stolpec2)){
		for($i = 0;$i < count($stolpec1);$i++){
			$vsota += abs($stolpec1[$i] - $stolpec2[$i]);
		}
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$vsota = 0;
	$lines = file($file);
	$stolpec1 = array();
	$stolpec2 = array();
	
	foreach($lines as $line) {
		$line = trim($line);
		$stolpci = array_map("intval",explode("   ",$line));
		array_push($stolpec1,$stolpci[0]);
		if(isset($stolpec2[$stolpci[1]])){
			$stolpec2[$stolpci[1]] += 1;
		} else {
			$stolpec2[$stolpci[1]] = 1;
		}
	}
	for($i = 0;$i < count($stolpec1);$i++){
		if(isset($stolpec2[$stolpec1[$i]])){
			$vsota += $stolpec1[$i] * $stolpec2[$stolpec1[$i]];
		}
	}
	
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day1_input.txt');
part2('day1_input.txt');
?>