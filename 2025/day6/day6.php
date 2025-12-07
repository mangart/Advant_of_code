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

function initPart2($file,&$operands) {
    $lines = file($file);
	$grid = array();
	$operands = array();
    for($i = 0;$i < count($lines)-1;$i++) {
		$line = rtrim($lines[$i]);
		$line = str_split($line);
		array_push($grid,$line);
    }
	$temp = explode(" ",$lines[count($lines)-1]);
	foreach($temp as $t){
		if($t != ""){
			array_push($operands,$t);
		}
	}
	$grid = transpose($grid);
	return $grid;
}

function transpose($grid) {
    array_unshift($grid, null);
    return call_user_func_array('array_map', $grid);
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

function part2($grid,$operandi){
	$vsota = 0;
	for($i = 0;$i < count($grid);$i++){
		$operand = $operandi[$i];
		$tempSum = 0;
		if($operand == "*"){
			$tempSum = 1;
		}
		for($j = 0;$j < count($grid[$i]);$j++){
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

function transformArray($grid2){
	$newGrid = array();
	$tempGrid = array();
	foreach($grid2 as $grid){
		if(count(array_unique($grid)) == 1 && $grid[0] == " "){
			array_push($newGrid,$tempGrid);
			$tempGrid = array();
		} else {
			$stevilo = 0;
			foreach($grid as $gr){
				if($gr != " "){
					$st = intval($gr);
					$stevilo = $stevilo * 10 + $st;
				}
			}
			array_push($tempGrid,$stevilo);
		}
	}
	array_push($newGrid,$tempGrid);
	return $newGrid;
}

$grid = init('day6_input.txt');
$operands = array();
$grid2 = initPart2('day6_input.txt',$operands);

$grid2 = transformArray($grid2);


$srt = microtime(true);
echo "The checksum for part1 is: ".part1($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";

$srt = microtime(true);
echo "The checksum for part2 is: ".part2($grid2,$operands)."\n";
echo (microtime(true) - $srt)." seconds\n";
?>