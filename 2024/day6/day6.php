<?php

function part1($file,&$positions){
	$vsota = 0;
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
				break 2;
			} else if($grid[$i][$j] == "ˇ"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 1;
				$j_change = 0;
				break 2;
			} else if($grid[$i][$j] == ">"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 0;
				$j_change = 1;
				break 2;
			} else if($grid[$i][$j] == "<"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 0;
				$j_change = -1;
				break 2;
			}
		}
	}
	$positions = array();
	//echo "current i: $current_i, current j: $current_j, change in i: $i_change, change in j: $j_change \n";
	while(isset($grid[$current_i+$i_change][$current_j+$j_change])){
		if(isset($positions[$current_i])){
			$positions[$current_i][$current_j] = 1;
		} else {
			$positions[$current_i] = array();
			$positions[$current_i][$current_j] = 1;
		}
		if($grid[$current_i+$i_change][$current_j+$j_change] == "#"){
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
		$current_i += $i_change;
		$current_j += $j_change;
		//echo "curI: $current_i, curJ: $current_j, chI: $i_change, chJ: $j_change \n";
	}
	$positions[$current_i][$current_j] = 1;
	foreach($positions as $pos){
		$vsota += count($pos);
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file,$positions){
	$vsota = 0;
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
				break 2;
			} else if($grid[$i][$j] == "ˇ"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 1;
				$j_change = 0;
				break 2;
			} else if($grid[$i][$j] == ">"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 0;
				$j_change = 1;
				break 2;
			} else if($grid[$i][$j] == "<"){
				$current_i = $i;
				$current_j = $j;
				$i_change = 0;
				$j_change = -1;
				break 2;
			}
		}
	}
	/*for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){*/
	foreach($positions as $key => $pos){
		foreach($pos as $subkey => $value){
			if($grid[$key][$subkey] != "#" && $grid[$key][$subkey] != "^"){
				$grid[$key][$subkey] = "#";
				if(cycle($grid,$current_i,$current_j,$i_change,$j_change)){
					$vsota += 1;
				}
				$grid[$key][$subkey] = ".";
			}
		}
	}

	echo "Part2 resitev je: ".$vsota."\n";
}

function cycle($grid,$current_i,$current_j,$i_change,$j_change){
	$positions = array();
	//$positions[$current_i][$current_j][$i_change][$j_change] = 1;
	//echo "current i: $current_i, current j: $current_j, change in i: $i_change, change in j: $j_change \n";
	while(isset($grid[$current_i][$current_j])){
		$position_key = "$current_i,$current_j,$i_change,$j_change";
		if(isset($positions[$position_key])){
			//$positions[$current_i][$current_j] = 1;
			return true;
		} else {
			//$positions[$current_i] = array();
			$positions[$position_key] = 1;
		}
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
		$current_i += $i_change;
		$current_j += $j_change;
		//echo "curI: $current_i, curJ: $current_j, chI: $i_change, chJ: $j_change \n";
	}
	//var_dump($positions);
	return false;
}

$start = microtime(true);
$positions = array();
part1('day6_input.txt',$positions);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2('day6_input.txt',$positions);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
/*foreach($positions as $pos){
	echo count($pos)."\n";
}*/
?>