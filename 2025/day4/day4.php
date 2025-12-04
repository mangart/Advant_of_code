<?php

function init($file) {
    $lines = file($file);
	$grid = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
    }
	return $grid;
}

function part1($grid){
	$vsota = 0;
	// we iterate through the grid
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			// if the current cell is a '@' we check its neighbours
			if($grid[$i][$j] == "@"){
				$counter = 0;
				for($ii = -1;$ii < 2;$ii++){
					for($jj = -1;$jj < 2;$jj++){
						if($ii == 0 && $jj == 0){
							continue;
						} else {
							if(isset($grid[$i+$ii][$j+$jj])){
								// if the neighbouring cell is also an '@' we increment the counter
								if($grid[$i+$ii][$j+$jj] == '@'){
									$counter += 1;
								}
							}
						}
						// if the counter is greater than 3 we skip this cell as it can't be accesed by the forklift
						if($counter > 3){
							break 2;
						}
					}
				}
				// if the counter is less than 4 we increment the sum as it can be accessed with the forklift
				if($counter < 4){
					$vsota += 1;
				}
			}
		}
	}
	return $vsota;
}

function removeRolls(&$grid){
	$vsota = 0;
	$removable = array();
	// we iterate thorugh the grid
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			// if the current cell is an '@' we check the neighbours
			if($grid[$i][$j] == "@"){
				$counter = 0;
				for($ii = -1;$ii < 2;$ii++){
					for($jj = -1;$jj < 2;$jj++){
						if($ii == 0 && $jj == 0){
							continue;
						} else {
							if(isset($grid[$i+$ii][$j+$jj])){
								// if the neighbouring cell is an '@' we increment the counter
								if($grid[$i+$ii][$j+$jj] == '@'){
									$counter += 1;
								}
							}
						}
						// if the counter is greater than 3 durring checking we skip checking further as it already can't be accessed by
						// the forklift
						if($counter > 3){
							break 2;
						}
					}
				}
				// if the counter is less thaan 4 we increment the sum and also note the $i and $j index of the bale to be removed
				if($counter < 4){
					$vsota += 1;
					array_push($removable,$i.":".$j);
				}
			}
		}
	}
	// we iterate the list of remove coordinates and remove the bales (make them the '.' symbol) 
	foreach($removable as $rem){
		$rem = explode(":",$rem);
		$grid[$rem[0]][$rem[1]] = ".";
	}
	return $vsota;
}


function part2($grid){
	$vsota = 0;
	// we increment the sum of removable bales ('@' symbols) until any more bales can be removed
	while(($tempVsota = removeRolls($grid)) != 0){
		$vsota += $tempVsota;
	}
	return $vsota;
}

$grid = init('day4_input.txt');


$srt = microtime(true);
echo "The checksum for part1 is: ".part1($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum for part2 is: ".part2($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>