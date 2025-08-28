<?php

// function for initialization and construction of the grid from input file
function init($file,&$grid,&$instr){
	$lines = file($file);
	$phase = 0;
	foreach($lines as $line) {
		$line = trim($line);
		if($line == ""){
			$phase = 1;
		}
		if($phase == 0){
			$line = str_split($line);
			array_push($grid,$line);
		} else if($phase == 1){
			$phase = 2;
		} else if($phase == 2){
			$line = str_split($line);
			foreach($line as $l){
				array_push($instr,$l);
			}
		}
	}
}

function findRobot($grid){
	$pos = array();
	for($i = 0;$i <count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "@"){
				$pos = array($i,$j);
				return $pos;
			}
		}
	}
}

function getChange($direction,&$iChange,&$jChange){
	if($direction == "<"){
		$jChange = -1;
	} else if($direction == ">"){
		$jChange = 1;
	} else if($direction == "^"){
		$iChange = -1;
	} else if($direction == "v"){
		$iChange = 1;
	}
}

function makeMove(&$grid,$i,$j,$iChange,$jChange){
	if(!isset($grid[$i+$iChange][$j+$jChange]) || $grid[$i+$iChange][$j+$jChange] == "#"){
		return false;
	}
	if($grid[$i+$iChange][$j+$jChange] == "."){
		$grid[$i+$iChange][$j+$jChange] = $grid[$i][$j];
		$grid[$i][$j] = ".";
		return true;
	} else {
		if(makeMove($grid,$i+$iChange,$j+$jChange,$iChange,$jChange)){
			$grid[$i+$iChange][$j+$jChange] = $grid[$i][$j];
			$grid[$i][$j] = ".";
			return true;
		} else {
			return false;
		}
	}
}


function part1($grid,$instr){
	$pos = findRobot($grid);
	$i = $pos[0];
	$j = $pos[1];
	$direction = 0;
	foreach($instr as $ins){
		$iChange = 0;
		$jChange = 0;
		getChange($ins,$iChange,$jChange);
		$move = makeMove($grid,$i,$j,$iChange,$jChange);
		if($move){
			$i = $i + $iChange;
			$j = $j + $jChange;
		}
	}
	$vsota = 0;
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "O"){
				$vsota += 100 * $i + $j;
			}
		}
	}
	return $vsota;
}

function part2($grid,$instr){

	
}


$grid = array();
$instr = array();
$robots = init('day15_input.txt',$grid,$instr);

$start = microtime(true);
echo "The checksum is: ".part1($grid,$instr)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($grid,$instr)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>