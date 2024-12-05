<?php

function check_horizontal_forward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i][$j+$k]) && $grid[$i][$j+$k] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;
}

function check_horizontal_backward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i][$j-$k]) && $grid[$i][$j-$k] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;	
}

function check_vertical_forward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i+$k][$j]) && $grid[$i+$k][$j] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;	
}

function check_vertical_backward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i-$k][$j]) && $grid[$i-$k][$j] == $iskani[$k]){	
		
		} else {
			return false;
		}
	}
	return true;
}

function check_left_diagonal_forward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i+$k][$j+$k]) && $grid[$i+$k][$j+$k] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;
}

function check_left_diagonal_backward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i-$k][$j-$k]) && $grid[$i-$k][$j-$k] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;
}

function check_right_diagonal_forward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i-$k][$j+$k]) && $grid[$i-$k][$j+$k] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;	
}

function check_right_diagonal_backward($grid,$iskani,$i,$j){
	for($k = 0;$k < 4;$k++){
		if(isset($grid[$i+$k][$j-$k]) && $grid[$i+$k][$j-$k] == $iskani[$k]){
			
		} else {
			return false;
		}
	}
	return true;	
}

function check_directions($grid,$iskani,$i,$j){
	$vsota = 0;
	if(check_horizontal_forward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_horizontal_backward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_vertical_forward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_vertical_backward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_left_diagonal_forward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_left_diagonal_backward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_right_diagonal_forward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	if(check_right_diagonal_backward($grid,$iskani,$i,$j)){
		$vsota += 1;
	}
	return $vsota;
}

function part1($file){
	$vsota = 0;
	$lines = file($file);
	$grid = array();
	$iskani = "XMAS";
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
	}
	
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			$vsota += check_directions($grid,$iskani,$i,$j);
		}
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$vsota = 0;
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
	}
	
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "A"){
				if((isset($grid[$i+1][$j+1]) && isset($grid[$i-1][$j-1]) && isset($grid[$i-1][$j+1]) && isset($grid[$i+1][$j-1])) && 
				(($grid[$i+1][$j+1] == "M" && $grid[$i-1][$j-1] == "S") ||
				($grid[$i+1][$j+1] == "S" && $grid[$i-1][$j-1] == "M")) && 
				(($grid[$i-1][$j+1] == "M" && $grid[$i+1][$j-1] == "S") || 
				($grid[$i-1][$j+1] == "S" && $grid[$i+1][$j-1] == "M"))){
					$vsota += 1;
				}
			}
		}
	}
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day4_input.txt');
part2('day4_input.txt');

?>