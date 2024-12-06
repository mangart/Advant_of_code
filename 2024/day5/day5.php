<?php

function part1($file){
	$vsota = 0;
	$lines = file($file);
	$rules = array();
	$updates = array();
	$rule = true;
	$valid = array();
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
	//var_dump($rules);
	//var_dump($updates);
	
	$rules_hashmap = array();
	foreach($rules as $rule){
		$trenutni = array_map("intval",explode("|",$rule));
		//var_dump($trenutni);
		if(isset($rules_hashmap[$trenutni[0]])){
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		} else {
			$rules_hashmap[$trenutni[0]] = array();
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		}
	}
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
	//var_dump($rules);
	//var_dump($updates);
	
	$rules_hashmap = array();
	foreach($rules as $rule){
		$trenutni = array_map("intval",explode("|",$rule));
		//var_dump($trenutni);
		if(isset($rules_hashmap[$trenutni[0]])){
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		} else {
			$rules_hashmap[$trenutni[0]] = array();
			$rules_hashmap[$trenutni[0]][$trenutni[1]] = 1;
		}
	}
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
		if(!$legit){
			array_push($valid,$up);
		}

	}
	foreach($valid as $val){
		for($i = 0;$i < count($val);$i++){
			for($j = $i - 1;$j >= 0;$j--){
				if(isset($rules_hashmap[$val[$i]][$val[$j]])){
					$val = move_back($val,$i,$j);
					$i = 0;
				}
			}
		}
		$vsota += $val[floor(count($val)/2)];
	}
	

	echo "Part2 resitev je: ".$vsota."\n";
}

function move_back($val,$i,$j){
	for($k = $j;$k <= $i && $k + 1 < count($val);$k++){
		$temp = $val[$k];
		$val[$k] = $val[$k+1];
		$val[$k+1] = $temp;
	}
	return $val;
}
part1('day5_input.txt');
part2('day5_input.txt');
$neki = 7;

?>