<?php

function part1($file){
	$lines = file($file);
	$vsota = 0;
	foreach($lines as $line) {
		$line = trim($line);
		$stevka = 0;
		$prva_stevka = 0;
		$druga_stevka = 0;
		for($i = 0;$i < strlen($line);$i++){
			if($stevka == 0){
				if(is_numeric($line[$i])){
					$prva_stevka = (int)$line[$i];
					$zadnja_stevka = (int)$line[$i];
					$stevka = 1;
				}
			} else {
				if(is_numeric($line[$i])){
					$zadnja_stevka = (int)$line[$i];
				}
			}
		}
		$stevilo = 10 * $prva_stevka + $zadnja_stevka;
		$vsota += $stevilo;
		//echo "Stevilo je: ".$stevilo."\n";
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$stev = array();
	$stev['one'] = 1;
	$stev['two'] = 2;
	$stev['three'] = 3;
	$stev['four'] = 4;
	$stev['five'] = 5;
	$stev['six'] = 6;
	$stev['seven'] = 7;
	$stev['eight'] = 8;
	$stev['nine'] = 9;
	$lines = file($file);
	$vsota = 0;
	foreach($lines as $line) {
		$line = trim($line);
		$stevka = 0;
		$prva_stevka = 0;
		$druga_stevka = 0;
		for($i = 0;$i < strlen($line);$i++){
			if($stevka == 0){
				if(is_numeric($line[$i])){
					$prva_stevka = (int)$line[$i];
					$zadnja_stevka = (int)$line[$i];
					$stevka = 1;
				} else if(isset($stev[substr($line,$i,3)])){
					$prva_stevka = $stev[substr($line,$i,3)];
					$zadnja_stevka = $stev[substr($line,$i,3)];
					$stevka = 1;
				} else if(isset($stev[substr($line,$i,4)])){
					$prva_stevka = $stev[substr($line,$i,4)];
					$zadnja_stevka = $stev[substr($line,$i,4)];
					$stevka = 1;
				} else if(isset($stev[substr($line,$i,5)])){
					$prva_stevka = $stev[substr($line,$i,5)];
					$zadnja_stevka = $stev[substr($line,$i,5)];
					$stevka = 1;
				}					
			} else {
				if(is_numeric($line[$i])){
					$zadnja_stevka = (int)$line[$i];
				} else if(isset($stev[substr($line,$i,3)])){
					$zadnja_stevka = $stev[substr($line,$i,3)];
				} else if(isset($stev[substr($line,$i,4)])){
					$zadnja_stevka = $stev[substr($line,$i,4)];
				} else if(isset($stev[substr($line,$i,5)])){
					$zadnja_stevka = $stev[substr($line,$i,5)];
				}
			}
		}
		$stevilo = 10 * $prva_stevka + $zadnja_stevka;
		$vsota += $stevilo;
		//echo "Stevilo je: ".$stevilo."\n";
	}
	echo "Part2 resitev je: ".$vsota."\n";
}

part1('day1_input.txt');
part2('day1_input.txt');
?>
