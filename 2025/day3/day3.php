<?php

function init($file) {
    $lines = file($file);
	$numbers = array();
    foreach ($lines as $line) {
        $line = trim($line);
		array_push($numbers,$line);
    }
	return $numbers;
}

function part1($numbers) {
	$vsota = 0;
	foreach($numbers as $number){
		$firstNum = 0;
		$firstIndex = 0;
		$secondNum = 0;
		$dolzina = strlen($number);
		// find first number
		for($i = 0;$i < ($dolzina-1);$i++){
			if($firstNum < intval($number[$i])){
				$firstNum = intval($number[$i]);
				$firstIndex = $i;
			}
		}
		// find second number;
		for($i = $firstIndex + 1;$i < $dolzina;$i++){
			if($secondNum < intval($number[$i])){
				$secondNum = intval($number[$i]);
			}
		}
		// add the jolts to the sum
		$stevilo = $firstNum * 10 + $secondNum;
		$vsota += $stevilo;
	}
	return $vsota;
}

function part2($numbers){
	$vsota = 0;
	// we go through the list of all numbers
	foreach($numbers as $number){
		$stevila = array();
		$currentHighest = 0;
		$startIndex = 0;
		$countdown = 12;
		$dolzina = strlen($number);
		// we search for the 12 highest numbers and for the first number we don't check in the last 11 spots, because if we did
		// we couldn't construct a 12 digit number, but only an 11 digit number
		for($i = $countdown-1; $i >= 0;$i--){
			$currentHighest = 0;
			// we search for the next highest number from the index that the previous highest number was found at
			for($j = $startIndex;$j < ($dolzina - $i);$j++){
				if($currentHighest < intval($number[$j])){
					$currentHighest = intval($number[$j]);
					$startIndex = $j+1;
				}
			}
			// we add the highest number to an array
			array_push($stevila,$currentHighest);
		}
		// from the array of highest numbers we construct a 12 digit string and cast it to an a numerical type and add it to
		// the sum and at the end we return the sum
		$stevilo = intval(implode("",$stevila));
		$vsota += $stevilo;
	}
	return $vsota;
}

$numbers = init('day3_input.txt');

$srt = microtime(true);
echo "The checksum is: ".part1($numbers)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($numbers)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>