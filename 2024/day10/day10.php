<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$disk = str_split($line);
		$diskVmesna = array();
		for($i = 0;$i < count($disk);$i++){
			if($disk[$i] == "."){
				array_push($diskVmesna,-1);
			} else {
				array_push($diskVmesna,intval($disk[$i]));
			}
		}
		array_push($grid,$diskVmesna);
	}
	return $grid;	
}


function find_path($grid,$i,$j,&$ends,$currentScore){
	$nextScore = $grid[$i][$j];
	$j0 = $j - 1;
	$j1 = $j + 1;
	$i0 = $i - 1;
	$i1 = $i + 1;
	
	if($nextScore != ($currentScore + 1)){
		return;
	}
	if($nextScore == 9){
		if(isset($ends[$i.":".$j])){
			$ends[$i.":".$j] += 1;
			return;
		} else {
			$ends[$i.":".$j] = 1;
			return;
		}
	}
	// check left neighbour
	if(isset($grid[$i][$j0])){
		find_path($grid,$i,$j0,$ends,$nextScore);
	}
	// check left neighbour
	if(isset($grid[$i][$j1])){
		find_path($grid,$i,$j1,$ends,$nextScore);
	}
	// check upper neighbour
	if(isset($grid[$i0][$j])){
		find_path($grid,$i0,$j,$ends,$nextScore);
	}
	// check lower neighbour
	if(isset($grid[$i1][$j])){
		find_path($grid,$i1,$j,$ends,$nextScore);
	}
	
	return;
}

function part1($grid){
	$starts = array();
	
	$leni = count($grid);
	$lenj = count($grid);
	for($i = 0;$i < $leni;$i++){
		for($j = 0;$j < $lenj;$j++){
			if($grid[$i][$j] == 0){
				array_push($starts,$i.":".$j);
			}
		}
	}
	$vsota = 0;
	//var_dump($starts);
	foreach($starts as $start){
		$indeksi = explode(":",$start);
		$ends = array();
		find_path($grid,$indeksi[0],$indeksi[1],$ends,-1);
		$vsota += count($ends);
	}
	return $vsota;
}


function part2($grid){
	$starts = array();
	
	$leni = count($grid);
	$lenj = count($grid);
	for($i = 0;$i < $leni;$i++){
		for($j = 0;$j < $lenj;$j++){
			if($grid[$i][$j] == 0){
				array_push($starts,$i.":".$j);
			}
		}
	}
	$vsota = 0;
	foreach($starts as $start){
		$indeksi = explode(":",$start);
		$ends = array();
		find_path($grid,$indeksi[0],$indeksi[1],$ends,-1);
		foreach($ends as $end){
			$vsota += $end;
		}
	}
	return $vsota;			
}


$antenas = array();
$start = microtime(true);
$grid = init('day10_input.txt');

echo "The checksum is: ".part1($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>