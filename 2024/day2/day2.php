<?php

function increasing($vrednosti){
	for($i = 0;$i < (count($vrednosti) - 1);$i++){
		$razlika = abs($vrednosti[$i] - $vrednosti[$i+1]);
		if(!($vrednosti[$i] < $vrednosti[$i+1]) || !($razlika >= 1 && $razlika <= 3)){
			return false;
		}
	}
	return true;
}

function decreasing($vrednosti){
	for($i = 0;$i < (count($vrednosti) - 1);$i++){
		$razlika = abs($vrednosti[$i] - $vrednosti[$i+1]);
		if(!($vrednosti[$i] > $vrednosti[$i+1]) || !($razlika >= 1 && $razlika <= 3)){
			return false;
		}
	}
	return true;	
}

function part1($file){
	$vsota = 0;
	$stolpec1 = array();
	$stolpec2 = array();
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
		$vrednosti = array_map("intval",explode(" ",$line));
		if(increasing($vrednosti) || decreasing($vrednosti)){
			$vsota += 1;
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
	}
	
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day2_input.txt');
part2('day2_sample_input.txt');
?>