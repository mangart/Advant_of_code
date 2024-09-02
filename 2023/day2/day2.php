<?php

function part1($file,$red,$green,$blue){
	$lines = file($file);
	$vsota = 0;
	foreach($lines as $line) {
		$line = trim($line);
		$string = explode(":",$line);
		$kontrola = $string[0];
		$id = (int)explode(" ",$kontrola)[1];
		$seti = explode(";",trim($string[1]));
		//var_dump($id);
		$vse_v_redu = true;
		foreach($seti as $set){
			$set = trim($set);
			$deli_seta =explode(",",$set);
			foreach($deli_seta as $del_seta){
				$del_seta = trim($del_seta);
				$direktive = explode(" ",$del_seta);
				//var_dump($direktive);
				$stevilo = (int)$direktive[0];
				$barva = $direktive[1];
				if($barva == "blue"){
					if($stevilo > $blue){
						$vse_v_redu = false;
					}
				}
				if($barva == "green"){
					if($stevilo > $green){
						$vse_v_redu = false;
					}
				}
				if($barva == "red"){
					if($stevilo > $red){
						$vse_v_redu = false;
					}
				}
			}
			//echo "\n";
		}
		if($vse_v_redu){
			$vsota += $id;
		}
	}
	echo "Part1 resitev je: ".$vsota." \n";
}

function part2($file){
	$lines = file($file);
	$vsota = 0;
	foreach($lines as $line) {
		$line = trim($line);
		$string = explode(":",$line);
		$kontrola = $string[0];
		$id = (int)explode(" ",$kontrola)[1];
		$seti = explode(";",trim($string[1]));
		//var_dump($id);
		$vse_v_redu = true;
		$red = 0;
		$green = 0;
		$blue = 0;
		foreach($seti as $set){
			$set = trim($set);
			$deli_seta =explode(",",$set);
			foreach($deli_seta as $del_seta){
				$del_seta = trim($del_seta);
				$direktive = explode(" ",$del_seta);
				//var_dump($direktive);
				$stevilo = (int)$direktive[0];
				$barva = $direktive[1];
				if($barva == "blue"){
					if($stevilo > $blue){
						$blue = $stevilo;
					}
				}
				if($barva == "green"){
					if($stevilo > $green){
						$green = $stevilo;
					}
				}
				if($barva == "red"){
					if($stevilo > $red){
						$red = $stevilo;
					}
				}
			}
			//echo "\n";
		}
		$delna_vsota = $blue * $red * $green;
		$vsota += $delna_vsota;
	}
	echo "Part2 resitev je: ".$vsota." \n";
}

part1('day2_input.txt',12,13,14);
part2('day2_input.txt');
?>

