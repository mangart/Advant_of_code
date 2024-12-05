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
	echo "Veljavni so: \n";
	var_dump($valid);
	foreach($valid as $val){
		$vsota += $val[floor(count($val)/2)];
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
	

	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day5_input.txt');
part2('day5_sample_input.txt');
$neki = 7;

?>