<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$robots = array();
	$counter = 0;
	$temp = array();
	foreach($lines as $line) {
		$line = trim($line);
		$posVel = explode(" ",$line);
		$tempPos = explode(",",explode("=",$posVel[0])[1]);
		$tempVel = explode(",",explode("=",$posVel[1])[1]);
		$robot = array();
		$robot["px"] = intval($tempPos[0]);
		$robot["py"] = intval($tempPos[1]);
		$robot["vx"] = intval($tempVel[0]);
		$robot["vy"] = intval($tempVel[1]);
		array_push($robots,$robot);
		
	}
	return $robots;	
}

function modwrap(int $v, int $m): int {
    $r = $v % $m;
    return $r < 0 ? $r + $m : $r;   // force into [0, m-1]
}

function getStartGrid(){
	$grid = array();
	$maxX = 101;
	$maxY = 103;
	for($i = 0;$i < $maxY;$i++){
		for($j = 0;$j < $maxX;$j++){
			$grid[$i][$j] = 0;
		}
	}
	return $grid;
}
function simulateStep(&$robots){
	$maxX = 101;
	$maxY = 103;
	for($j = 0;$j < count($robots);$j++){
		$robots[$j]["px"] = modwrap($robots[$j]["px"] + $robots[$j]["vx"], $maxX);
		$robots[$j]["py"] = modwrap($robots[$j]["py"] + $robots[$j]["vy"], $maxY);
	}	
}

function part1($robots){
	$maxX = 101;
	$maxY = 103;
	$mejaX = ($maxX - 1) / 2;
	$mejaY = ($maxY - 1) / 2;
	for($j = 0;$j < count($robots);$j++){
		$robots[$j]["px"] = modwrap($robots[$j]["px"] + 100 * $robots[$j]["vx"], $maxX);
		$robots[$j]["py"] = modwrap($robots[$j]["py"] + 100 * $robots[$j]["vy"], $maxY);
	}
	$quad0 = 0;
	$quad1 = 0;
	$quad2 = 0;
	$quad3 = 0;
	$vsota = 0;
	foreach($robots as $robot){
		if($robot["px"] < $mejaX && $robot["py"] < $mejaY){
			$quad0 += 1;
		} else if($robot["px"] > $mejaX && $robot["py"] < $mejaY){
			$quad1 += 1;
		} else if($robot["px"] < $mejaX && $robot["py"] > $mejaY){
			$quad2 += 1;
		} else if($robot["px"] > $mejaX && $robot["py"] > $mejaY){
			$quad3 += 1;
		}
	}
	$vsota = $quad0 * $quad1 * $quad2 * $quad3;
	return $vsota;
}

function part2($robots){
	for($i = 1;$i < 1000000;$i++){
		$grid = getStartGrid();
		simulateStep($robots);
		foreach($robots as $robot){
			$grid[$robot["py"]][$robot["px"]] = 1;
		}
		
		for($j = 1;$j < count($grid)-1;$j++){
			for($k = 1;$k < count($grid[$j])-1;$k++){
				if($grid[$j-1][$k-1] == 1 && $grid[$j-1][$k] == 1 && $grid[$j-1][$k+1] == 1 &&
				   $grid[$j][$k-1] == 1 && $grid[$j][$k+1] == 1 &&
				   $grid[$j+1][$k-1] == 1 && $grid[$j+1][$k] == 1 && $grid[$j+1][$k+1] == 1){
					   return $i;
				   }
			}
		}
		echo "Step: $i \n";
	}
	
}



$robots = init('day14_input.txt');

$start = microtime(true);
echo "The checksum is: ".part1($robots)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($robots)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>