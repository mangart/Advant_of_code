<?php
function preveri_okolico($grid,$i,$j){
	if((isset($grid[$i-1][$j-1]) 
		&& !is_numeric($grid[$i-1][$j-1]) 
	&& $grid[$i-1][$j-1] != '.') || 
	(isset($grid[$i-1][$j]) && !is_numeric($grid[$i-1][$j]) && $grid[$i-1][$j] != '.') || 
	(isset($grid[$i-1][$j+1]) && !is_numeric($grid[$i-1][$j+1]) && $grid[$i-1][$j+1] != '.') || 
	(isset($grid[$i][$j-1]) && !is_numeric($grid[$i][$j-1]) && $grid[$i][$j-1] != '.') || 
	(isset($grid[$i][$j+1]) && !is_numeric($grid[$i][$j+1]) && $grid[$i][$j+1] != '.') || 
	(isset($grid[$i+1][$j-1]) && !is_numeric($grid[$i+1][$j-1]) && $grid[$i+1][$j-1] != '.') || 
	(isset($grid[$i+1][$j]) && !is_numeric($grid[$i+1][$j]) && $grid[$i+1][$j] != '.') || 
	(isset($grid[$i+1][$j+1]) && !is_numeric($grid[$i+1][$j+1]) && $grid[$i+1][$j+1] != '.')){
		return true;
	}
	return false;
}



function part1($file){
	$lines = file($file);
	$vsota = 0;
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		array_push($grid,$line);
	}
	var_dump($grid);
	$stevilka = 0;
	$v_procesu = false;
	$je_v_redu = false;
	$stevilke = array();
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < strlen($grid[$i]);$j++){
			if(!$v_procesu){
				if(is_numeric($grid[$i][$j])){
					$v_procesu = true;
				}
			}
			if($v_procesu){
				if(is_numeric($grid[$i][$j])){
					$stevilka = $stevilka * 10 + (int)$grid[$i][$j];
					 $v = preveri_okolico($grid,$i,$j);
					 if($v){
						 $je_v_redu = true;
					 }
				} else {
					if($je_v_redu){
						array_push($stevilke,$stevilka);
					}
					$stevilka = 0;
					$je_v_redu = false;
					$v_procesu = false;
				}
			}
		}
	}
	var_dump($stevilke);
	foreach($stevilke as $stev){
		$vsota += $stev;
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$lines = file($file);
	$vsota = 0;
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		array_push($grid,$line);
	}
	var_dump($grid);
	$stevilka = 0;
	$v_procesu = false;
	$je_v_redu = false;
	$stevilke = array();
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < strlen($grid[$i]);$j++){
			if($grid[$i][$j] == '*'){
				echo "Vrstica: ".$i." Stolpec: ".$j."\n";
			}
		}
	}
	echo "Part2 resitev je: \n";
}

part1('day3_input.txt');
part2('day3_sample_input.txt');
?>

