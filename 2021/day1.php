<?php

function part1($vsebina){
	$counter = 0;
	$prejsni = $vsebina[0];
	for($i = 1;$i < count($vsebina);$i++){
		if($vsebina[$i] > $prejsni){
			$counter += 1;
		}
		$prejsni = $vsebina[$i];
	}
	return $counter;
}

function part2($vsebina){
	$vsote = array();
	for($i = 0;$i < count($vsebina);$i++){
		if($i < count($vsebina) - 2){
			$trenutna_vsota = $vsebina[$i] + $vsebina[$i+1] + $vsebina[$i+2];
			array_push($vsote,$trenutna_vsota);
		} else if($i < count($vsebina) - 1){
			$trenutna_vsota = $vsebina[$i] + $vsebina[$i+1];
			array_push($vsote,$trenutna_vsota);
		} else {
			array_push($vsote,$trenutna_vsota);
		}
	}
	return part1($vsote);
}
$vsebina = array_map('intval',explode("\n",file_get_contents("imput_day1.txt")));

echo "Part 1 resitev je: ".part1($vsebina)."\n";
echo "Part 2 resitev je: ".part2($vsebina)."\n";




?>