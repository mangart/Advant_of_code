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

function part12($numbers,$n){
	$vsota = 0;
	// we go through the list of all numbers and search for the highest n-digit number
	foreach($numbers as $number){
		$currentHighest = 0;
		$startIndex = 0;
		$dolzina = strlen($number);
		$numberString = "";
		// we search for the highest n-digit number and for the first number we don't check in the last n-1 spots, because if we 
		//did we couldn't construct a n-digit number, but only an n-1 or lower digit number and so on.
		for($i = $n-1; $i >= 0;$i--){
			$currentHighest = 0;
			// we search for the next highest number from the index that the previous highest number was found at
			for($j = $startIndex;$j < ($dolzina - $i);$j++){
				if($currentHighest < intval($number[$j])){
					$currentHighest = intval($number[$j]);
					$startIndex = $j+1;
				}
			}
			// we add the highest number to the number string
			$numberString .= $currentHighest;
		}
		// we add the numerical value of the n-digit string to the sum and at the end we return the sum
		$vsota += intval($numberString);
	}
	return $vsota;
}

$numbers = init('day3_input.txt');

$srt = microtime(true);
echo "The checksum for part1 is: ".part12($numbers,2)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum for part2 is: ".part12($numbers,12)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>