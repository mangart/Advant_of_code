<?php

function calculate($sum,$numbers,&$sums){
	if(count($numbers) == 1){
		array_push($sums,$sum+$numbers[0]);
		array_push($sums,$sum*$numbers[0]);
	} else {
		$sum1 = $sum + $numbers[0];
		$sum2 = $sum * $numbers[0];
		array_shift($numbers);
		calculate($sum1,$numbers,$sums);
		calculate($sum2,$numbers,$sums);
	}
}

function part1($file,&$positions){
	$vsota = 0;
	$lines = file($file);
	$sum = 0;
	$numbers = array();
	$sums = array();
	foreach($lines as $line) {
		$line = trim($line);
		$parts = explode(":",$line);
		$sum = intval($parts[0]);
		$nums = trim($parts[1]);
		$numbers = array_map("intval",explode(" ",$nums));
		$sum1 = $numbers[0];
		//var_dump($sum);
		//var_dump($numbers);
		array_shift($numbers);
		calculate($sum1,$numbers,$sums);
		foreach($sums as $number){
			if($number == $sum){
				$vsota += $number;
				break;
			}
		}
		$sums = array();
	}


	

	echo "Part1 resitev je: ".$vsota."\n";
}

function calculate2($sum,$numbers,&$sums){
	if(count($numbers) == 1){
		array_push($sums,$sum+$numbers[0]);
		array_push($sums,$sum*$numbers[0]);
		array_push($sums,intval(strval($sum).strval($numbers[0])));
	} else {
		$sum1 = $sum + $numbers[0];
		$sum2 = $sum * $numbers[0];
		$sum3 = intval(strval($sum).strval($numbers[0]));
		array_shift($numbers);
		calculate2($sum1,$numbers,$sums);
		calculate2($sum2,$numbers,$sums);
		calculate2($sum3,$numbers,$sums);
	}
}

function part2($file,$positions){
	$vsota = 0;
	$lines = file($file);
	$sum = 0;
	$numbers = array();
	$sums = array();
	foreach($lines as $line) {
		$line = trim($line);
		$parts = explode(":",$line);
		$sum = intval($parts[0]);
		$nums = trim($parts[1]);
		$numbers = array_map("intval",explode(" ",$nums));
		$sum1 = $numbers[0];
		//var_dump($sum);
		//var_dump($numbers);
		array_shift($numbers);
		calculate2($sum1,$numbers,$sums);
		//var_dump($sums);
		foreach($sums as $number){
			if($number == $sum){
				$vsota += $number;
				break;
			}
		}
		$sums = array();
	}
	echo "Part2 resitev je: ".$vsota."\n";
}


$start = microtime(true);
$positions = array();
part1('day7_input.txt',$positions);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2('day7_input.txt',$positions);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

?>