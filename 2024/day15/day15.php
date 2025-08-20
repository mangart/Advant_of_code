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


function part1($robots){

}

function part2($robots){

	
}



$robots = init('day15_sample_input.txt');

$start = microtime(true);
echo "The checksum is: ".part1($robots)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($robots)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>