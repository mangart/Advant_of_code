<?php

function init($file) {
    $lines = file($file);
	$grid = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$temp = array();
		$line = str_split($line);
		array_push($grid,$line);
    }
	return $grid;
}

function findStart($grid){
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "S"){
				return "$i:$j";
			}
		}
	}
	return false;
}

function findSplits($grid,&$splits,&$visited,$startI,$startJ){
	for($i = $startI+1;$i < count($grid);$i++){
		if(!isset($grid[$i][$startJ])){
			return true;
		}
		if(isset($grid[$i][$startJ]) && $grid[$i][$startJ] == "^"){
			$splits[$i.":".$startJ] = 1;
			
			if(isset($grid[$i][$startJ-1]) && !isset($visited[$i.":".($startJ-1)])){
				$visited[$i.":".($startJ-1)] = 1;
				findSplits($grid,$splits,$visited,$i,$startJ-1);
			}
			if(isset($grid[$i][$startJ+1]) && !isset($visited[$i.":".($startJ+1)])){
				$visited[$i.":".($startJ+1)] = 1;
				findSplits($grid,$splits,$visited,$i,$startJ+1);
			}
			return true;
		}
	}
	return true;
}

function part1($grid){
	$vsota = 0;
	$splits = array();
	$start = explode(":",findStart($grid));
	$startI = intval($start[0]);
	$startJ = intval($start[1]);
	$visited = array();
	findSplits($grid,$splits,$visited,$startI,$startJ);
	return count($splits);
}

function part2($grid){
	$vsota = 0;
	
	return $vsota;
}

$grid = init('day7_input.txt');


$srt = microtime(true);
echo "The checksum for part1 is: ".part1($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";

$srt = microtime(true);
echo "The checksum for part2 is: ".part2($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";
?>