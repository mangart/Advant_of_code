<?php

function get_number($string){
	$stevilo = 0;
	for($i = 0;$i < strlen($string);$i++){
		if(ctype_digit($string[$i])){
			$stevilo = $stevilo * 10 + intval($string[$i]);
		}
	}
	return $stevilo;
}
function part1($file){
	$vsota = 0;
	$lines = file($file);
	$muls = array();
	$state = 0;
	$current = "";
	foreach($lines as $line) {
		$line = trim($line);
		for($i = 0;$i < strlen($line);$i++){
			if($state == 0){
				if($line[$i] == "m"){
					$state = 1;
					$current = "m";
				}
			} else if($state == 1){
				if($line[$i] == "u"){
					$state = 2;
					$current .= "u";
				} else {
					$current = "";
					$state = 0;
				}
			} else if($state == 2){
				if($line[$i] == "l"){
					$state = 3;
					$current .= "l";
				} else {
					$current = "";
					$state = 0;
				}
			} else if($state == 3){
				if($line[$i] == "("){
					$state = 4;
					$current .= "(";
				} else {
					$current = "";
					$state = 0;
				}
			} else if($state == 4){
				if(ctype_digit($line[$i])){
					$current .= $line[$i];
				} else if($line[$i] == ","){
					$state = 5;
					$current .= ",";
				} else {
					$state = 0;
					$current = "";
				}
			} else if($state = 5){
				if(ctype_digit($line[$i])){
					$current .= $line[$i];
				} else {
					if($line[$i] == ")"){
						$current .= ")";
						array_push($muls,$current);
					}
					$state = 0;
					$current = "";
				}
			}
		}
	}
	$vsota = 0;
	foreach($muls as $mul){
		$deli = explode(",",$mul);
		$stevilka1 = get_number($deli[0]);
		$stevilka2 = get_number($deli[1]);
		echo $stevilka1." ".$stevilka2."\n";
		$vsota += $stevilka1 * $stevilka2;
	}
	
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$vsota = 0;
	$lines = file($file);
	foreach($lines as $line) {
		$line = trim($line);
	}
	
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day3_input.txt');
part2('day3_sample_input.txt');

?>