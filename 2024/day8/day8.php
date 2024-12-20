<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
	}

	return $grid;	
}

function part1($grid){

}



function part2($grid){

}



$start = microtime(true);
$positions = array();
$positions1 = array();
$current_i = 0;
$current_j = 0;
$i_change = 0;
$j_change = 0;
$grid = init('day8_sample_input.txt',$current_i,$current_j,$i_change,$j_change);
part1($grid,$positions,$positions1,$current_i,$current_j,$i_change,$j_change);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2($grid,$positions1,$current_i,$current_j,$i_change,$j_change);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>