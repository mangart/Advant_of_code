<?php

// function for initialization and construction of the grid from input file
function init($file,&$current_i,&$current_j,&$i_change,&$j_change){
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
	}
	$current_i = 0;
	$current_j = 0;
	$i_change = 0;
	$j_change = 0;
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "^"){
				$current_i = $i;
				$current_j = $j;
				$i_change = -1;
				$j_change = 0;
				$grid[$i][$j] = ".";
				break 2;
			} else if($grid[$i][$j] == "ˇ"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 1;
				$j_change = 0;
				$grid[$i][$j] = ".";
				break 2;
			} else if($grid[$i][$j] == ">"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 0;
				$j_change = 1;
				$grid[$i][$j] = ".";
				break 2;
			} else if($grid[$i][$j] == "<"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 0;
				$j_change = -1;
				$grid[$i][$j] = ".";
				break 2;
			}
		}
	}
	return $grid;	
}

function part1($grid,&$positions,&$positions1,$current_i,$current_j,$i_change,$j_change){
	$vsota = 0;
	$positions = array();
	while(isset($grid[$current_i+$i_change][$current_j+$j_change])){
		array_push($positions1,$current_i.",".$current_j.",".$i_change.",".$j_change);
		if(isset($positions[$current_i.",".$current_j])){
			$positions[$current_i.",".$current_j] += 1;
		} else {
			$positions[$current_i.",".$current_j] = 1;
		}
		$counter = 0;
		while(isset($grid[$current_i+$i_change][$current_j+$j_change]) && $grid[$current_i+$i_change][$current_j+$j_change] == "#" && $counter < 4){
			if(isset($grid[$current_i+$i_change][$current_j+$j_change]) && $grid[$current_i+$i_change][$current_j+$j_change] == "#"){
				if($i_change == -1){
					$i_change = 0;
					$j_change = 1;
				} else if($j_change == 1){
					$i_change = 1;
					$j_change = 0;
				} else if($i_change == 1){
					$i_change = 0;
					$j_change = -1;
				} else if($j_change == -1){
					$i_change = -1;
					$j_change = 0;
				}				
			}
			$counter += 1;
		}
		$current_i += $i_change;
		$current_j += $j_change;
	}
	$positions[$current_i.",".$current_j] = 1;
	array_push($positions1,$current_i.",".$current_j.",".$i_change.",".$j_change);
	$vsota += count($positions);
	echo "Part1 resitev je: ".$vsota."\n";
}



function part2($grid,$positions,$current_i,$current_j,$i_change,$j_change){
	$distinct_positions = array();
	for($i = 0;$i < count($positions) - 1;$i++){
		$naslednja = array_map("intval",explode(",",$positions[$i+1]));
		if(!isset($distinct_positions[$naslednja[0].",".$naslednja[1]])){
			$grid[$naslednja[0]][$naslednja[1]] = "#";
			if(cycle($grid,$current_i,$current_j,$i_change,$j_change)){
				$distinct_positions[$naslednja[0].",".$naslednja[1]] = 1;	
			}
			$grid[$naslednja[0]][$naslednja[1]] = ".";
		}
	}
	echo "Part2 resitev je: ".count($distinct_positions)."\n";
	
}

function cycle($grid,$current_i,$current_j,$i_change,$j_change){
	$positions = array();
	while(isset($grid[$current_i][$current_j])){
		$position_key = "$current_i,$current_j,$i_change,$j_change";
		if(isset($positions[$position_key])){
			return true;
		}
		$positions[$position_key] = 1;
		$counter = 0;
		while(isset($grid[$current_i+$i_change][$current_j+$j_change]) && $grid[$current_i+$i_change][$current_j+$j_change] == "#" && $counter < 4){
			if(isset($grid[$current_i+$i_change][$current_j+$j_change]) && $grid[$current_i+$i_change][$current_j+$j_change] == "#"){
				if($i_change == -1){
					$i_change = 0;
					$j_change = 1;
				} else if($j_change == 1){
					$i_change = 1;
					$j_change = 0;
				} else if($i_change == 1){
					$i_change = 0;
					$j_change = -1;
				} else if($j_change == -1){
					$i_change = -1;
					$j_change = 0;
				}				
			}
			$counter += 1;
		}
		
		$current_i += $i_change;
		$current_j += $j_change;
	}
	return false;
	
}

$start = microtime(true);
$positions = array();
$positions1 = array();
$current_i = 0;
$current_j = 0;
$i_change = 0;
$j_change = 0;
$grid = init('day6_input.txt',$current_i,$current_j,$i_change,$j_change);
part1($grid,$positions,$positions1,$current_i,$current_j,$i_change,$j_change);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2($grid,$positions1,$current_i,$current_j,$i_change,$j_change);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>