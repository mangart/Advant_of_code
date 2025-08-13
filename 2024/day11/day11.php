<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$numbers = array();
	foreach($lines as $line) {
		$line = trim($line);
		$numbers = array_map("intval",explode(" ",$line));
		break;
	}
	return $numbers;	
}

function blink1($number,$blink,&$dict){
	if(isset($dict[$blink][$number])){
		return $dict[$blink][$number];
	} else if($blink == 1){
		if(strlen((string)$number) % 2 == 0){
			$dict[$blink][$number] = 2;
			return 2;
		} else {
			$dict[$blink][$number] = 1;
			return 1;
		}
	} else {
		if(strlen((string)$number) % 2 == 0){
			$nums = array_map("intval",str_split((string)$number,strlen((string)$number) / 2));
			$dict[$blink][$number] = blink1($nums[0],$blink - 1,$dict) + blink1($nums[1],$blink - 1,$dict);
			return $dict[$blink][$number];
		} else {
			if($number == 0){
				$dict[$blink][$number] = blink1(1,$blink - 1,$dict);;
				return $dict[$blink][$number];
			} else {
				$dict[$blink][$number] = blink1($number * 2024,$blink - 1,$dict);;
				return $dict[$blink][$number];
			}
		}		
	}
}

function part1($numbers,&$dict){
	$blinks = 25;
	$vsota = 0;
	foreach($numbers as $num){
		$vsota += blink1($num,$blinks,$dict);
	}
	return $vsota;
}

function part2($numbers,&$dict){
	$blinks = 75;
	$vsota = 0;
	foreach($numbers as $num){
		$vsota += blink1($num,$blinks,$dict);
	}
	return $vsota;			
}

$start = microtime(true);
$numbers = init('day11_input.txt');
$dict = array();

echo "The checksum is: ".part1($numbers,$dict)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($numbers,$dict)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>