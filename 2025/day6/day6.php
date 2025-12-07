<?php

function init($file) {
    $lines = file($file);
	$grid = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$temp = array();
		$line = explode(" ",$line);
		foreach($line as $l){
			if($l != ""){
				array_push($temp,$l);
			}
		}
		array_push($grid,$temp);
    }
	for($i = 0;$i < count($grid)-1;$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			$grid[$i][$j] = intval($grid[$i][$j]);
		}
	}
	return $grid;
}

function part1($grid){
	$vsota = 0;
	if(!isset($grid)){
		echo "Grid has no columns!!!\n";
		return $vsota;
	}
	$rows = count($grid[0]);

	for($j = 0;$j < count($grid[0]);$j++){
		$operand = $grid[count($grid)-1][$j];
		$tempSum = 0;
		if($operand == "*"){
			$tempSum = 1;
		}
		for($i = 0;$i < count($grid)-1;$i++){
			if($operand == "+"){
				$tempSum += $grid[$i][$j];
			} else if($operand == "*"){
				$tempSum *= $grid[$i][$j];
			}
		}
		$vsota += $tempSum;
	}
	return $vsota;
}


function part2($grid){
	$vsota = 0;

	return $vsota;
}




$grid = init('day6_input.txt');

$srt = microtime(true);
echo "The checksum for part1 is: ".part1($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";

$srt = microtime(true);
echo "The checksum for part2 is: ".part2($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";
?>