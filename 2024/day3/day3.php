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
			} else if($state == 5){
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
		//echo $stevilka1." ".$stevilka2."\n";
		$vsota += $stevilka1 * $stevilka2;
	}
	
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
$vsota = 0;
	$lines = file($file);
	$muls = array();
	$state = 0;
	$current = "";
	$enabled = true;
	foreach($lines as $line) {
		$line = trim($line);
		for($i = 0;$i < strlen($line);$i++){
			if($enabled){
				if($state == 0){
					if($line[$i] == "m"){
						$state = 1;
						$current = "m";
					} else if($line[$i] == "d"){
						$state = 6;
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
				} else if($state == 5){
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
				} else if($state == 6){
					if($line[$i] == "o"){
						$state = 7;
					} else {
						$state = 0;
					}
				} else if($state == 7){
					if($line[$i] == "n"){
						$state = 8;
					} else {
						$state = 0;
					}
				} else if($state == 8){
					if($line[$i] == "'"){
						$state = 9;
					} else {
						$state = 0;
					}
				} else if($state == 9){
					if($line[$i] == "t"){
						$state = 10;
					} else {
						$state = 0;
					}
				} else if($state == 10){
					if($line[$i] == "("){
						$state = 11;
					} else {
						$state = 0;
					}
				} else if($state == 11){
					if($line[$i] == ")"){
						$enabled = false;
					}
					$state = 0;
				}
			} else {
				if($state == 0){
					if($line[$i] == "d"){
						$state = 1;
					} else {
						$state = 0;
					}
				} else if($state == 1){
					if($line[$i] == "o"){
						$state = 2;
					} else {
						$state = 0;
					}
				} else if($state == 2){
					if($line[$i] == "("){
						$state = 3;
					} else {
						$state = 0;
					}
				} else if ($state == 3){
					if($line[$i] == ")"){
						$enabled = true;
					}
					$state = 0;
				}
			}
		}
	}
	$vsota = 0;
	foreach($muls as $mul){
		$deli = explode(",",$mul);
		$stevilka1 = get_number($deli[0]);
		$stevilka2 = get_number($deli[1]);
		//echo $stevilka1." ".$stevilka2."\n";
		$vsota += $stevilka1 * $stevilka2;
	}
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day3_input.txt');
part2('day3_input.txt');

?>