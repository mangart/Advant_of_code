<?php

function part1($file){
	$vsota = 0;
	$lines = file($file);
	$rules = array();
	$updates = array();
	$rule = true;
	$valid = array();
	// we read a file and split rules and updates into two arrays
	foreach($lines as $line) {
		$line = trim($line);
		if($line == ""){
			$rule = false;
		}
		else if($rule){
			array_push($rules,$line);
		} else {
			array_push($updates,$line);
		}
	}
	
	// we go through the rules and make a hashmap with the main key being the elemet that goes first and 
	// the value is another hashmap that has all the elements that go after it as keys
	$rules_hashmap = array();
	foreach($rules as $rule){
		$trenutni = array_map("intval",explode("|",$rule));
		if(isset($rules_hashmap[$trenutni[0]])){
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		} else {
			$rules_hashmap[$trenutni[0]] = array();
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		}
	}
	// we go through the array of updates and first transform each line into a hashmap that has a number from the array as
	// the key and another hashmap as the value and the keys of this nested hashmap are numbers that come before it in the 
	// line
	foreach($updates as $upd){
		$up = array_map("intval",explode(",",$upd));
		$updates_hashmap = array();
		for($i = 0;$i < count($up);$i++){
			$updates_hashmap[$up[$i]] = array();
			for($j = $i - 1;$j >= 0;$j--){
				$updates_hashmap[$up[$i]][$up[$j]] = 1; 
			}
		}
		$legit = true;
		foreach($updates_hashmap as $key => $value){
			foreach($updates_hashmap[$key] as $podkey => $podvalue){
				if(isset($rules_hashmap[$key][$podkey])){
					$legit = false;
				}
			}
		}
		// if the line is correctly ordered acording to the rules we add it to the array of correct lines
		if($legit){
			array_push($valid,$up);
		}

	}

	foreach($valid as $val){
		$vsota += $val[floor(count($val)/2)];
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
$vsota = 0;
	$lines = file($file);
	$rules = array();
	$updates = array();
	$rule = true;
	$valid = array();
	// we read a file and split rules and updates into two arrays
	foreach($lines as $line) {
		$line = trim($line);
		if($line == ""){
			$rule = false;
		}
		else if($rule){
			array_push($rules,$line);
		} else {
			array_push($updates,$line);
		}
	}
	
	// we go through the rules and make a hashmap with the main key being the elemet that goes first and 
	// the value is another hashmap that has all the elements that go after it as keys
	$rules_hashmap = array();
	foreach($rules as $rule){
		$trenutni = array_map("intval",explode("|",$rule));
		if(isset($rules_hashmap[$trenutni[0]])){
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		} else {
			$rules_hashmap[$trenutni[0]] = array();
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		}
	}
	// we go through the array of updates and first transform each line into a hashmap that has a number from the array as
	// the key and another hashmap as the value and the keys of this nested hashmap are numbers that come before it in the 
	// line
	foreach($updates as $upd){
		$up = array_map("intval",explode(",",$upd));
		$updates_hashmap = array();
		for($i = 0;$i < count($up);$i++){
			$updates_hashmap[$up[$i]] = array();
			for($j = $i - 1;$j >= 0;$j--){
				$updates_hashmap[$up[$i]][$up[$j]] = 1; 
			}
		}
		$legit = true;
		// we go through the updates hashmap and check if the all the numbers before the current number are not among the rules
		// if that specific rule is set, we know that the number before the current number violates the rule as it is suppose
		// to go after the current number if that particular rule is set so we know that line is false, but if no such rules
		// exist than we know that the line is valid
		foreach($updates_hashmap as $key => $value){
			foreach($updates_hashmap[$key] as $podkey => $podvalue){
				if(isset($rules_hashmap[$key][$podkey])){
					$legit = false;
				}
			}
		} 
		// because this is part two of the assignment and we are looking for lines that are not correct we add it to the array of
		// lines that interests us
		if(!$legit){
			array_push($valid,$up);
		}

	}
	// we go through each incorect line and correct it if a certain number violates a rule we move it back after the current
	// number 
	foreach($valid as $val){
		for($i = 0;$i < count($val);$i++){
			for($j = $i - 1;$j >= 0;$j--){
				if(isset($rules_hashmap[$val[$i]][$val[$j]])){
					$val = move_back($val,$i,$j);
					$i = 0;
				}
			}
		}
		// when the line is corrected we add the middle element of the line to the sum (vsota in slovenian)
		$vsota += $val[floor(count($val)/2)];
	}
	

	echo "Part2 resitev je: ".$vsota."\n";
}

// a function to move a certain element after another element in an array
// Let say we have an array like this (1,2,3,4,5,6,7) and we want to move the element 3 after element 6 this function produces a
// resulting array that looks like this (1,2,4,5,6,3,7)
function move_back($val,$i,$j){
	for($k = $j;$k <= $i && $k + 1 < count($val);$k++){
		$temp = $val[$k];
		$val[$k] = $val[$k+1];
		$val[$k+1] = $temp;
	}
	return $val;
}
$start = microtime(true);
part1('day5_input.txt');
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2('day5_input.txt');
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

?>