<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$disk = str_split($line);
		$disk = array_map('intval',$disk);
		array_push($grid,$disk);
	}
	return $grid;	
}



function part1($grid){

}


function part2($grid){
			
}


$antenas = array();
$start = microtime(true);
$grid = init('day10_sample_input5.txt');

echo "The checksum is: ".part1($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
echo "The checksum is: ".part2($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>