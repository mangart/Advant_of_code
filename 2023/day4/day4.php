<?php

function part1($file){
	$vsota = 0;
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_replace("  "," ",$line);
		$deli = explode("|",$line);
		if(!isset($deli[1])){
			return 0;
		}
		$myNumbers = array_map("intval",explode(" ",trim($deli[1])));
		$deli = explode(":",$deli[0]);
		if(!isset($deli[1])){
			return 0;
		}
		$winningNumbers = array_map("intval",explode(" ",trim($deli[1])));
		
		$winning = array();
		foreach($winningNumbers as $winNum){
			$winning[$winNum] = 1;
		}
		$stev = -1;
		$myNums = array();
		foreach($myNumbers as $myNum){
			$myNums[$myNum] = 1;
			if(isset($winning[$myNum])){
				$stev += 1;
			}
		}

		if($stev > -1){
			$vsota += pow(2,$stev);
		}
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$vsota = 0;
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
	}
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day4_input.txt');
part2('day4_sample_input.txt');
?>

