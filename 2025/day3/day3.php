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
	var_dump($numbers);
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
		$stevilo = $firstNum * 10 + $secondNum;
		echo "Stevilo je: $number, Jolts je: $stevilo \n";
		$vsota += $stevilo;
	}
	return $vsota;
}

function part2($numbers){

}

$numbers = init('day3_input.txt');

$srt = microtime(true);
echo "The checksum is: ".part1($numbers)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($numbers)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>