<?php

function part1($polje){
	$flashes = 0;
	for($i = 0;$i < 100;$i++){
		$has_flashed = generate_field();
		step($polje,$flashes,$has_flashed);
	}
	return $flashes;
}

function step(&$polje,&$flashes,$has_flashed){
	for($i = 0;$i < 10;$i++){
		for($j = 0;$j < 10;$j++){
			if(!$has_flashed[$i][$j]){
				$polje[$i][$j] += 1;
				if($polje[$i][$j] > 9){
					$polje[$i][$j] = 0;
					$has_flashed[$i][$j] = True;
					$flashes += 1;
					flash($polje,$flashes,$has_flashed,$i,$j);
				}
			}
		}
	}
}

function flash(&$polje,&$flashes,&$has_flashed,$i,$j){
	// upper left
	if(isset($polje[$i-1][$j-1])){
		if(!$has_flashed[$i-1][$j-1]){
			$polje[$i-1][$j-1] += 1;
			if($polje[$i-1][$j-1] > 9){
				$polje[$i-1][$j-1] = 0;
				$has_flashed[$i-1][$j-1] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i-1,$j-1);
			}
		}		
	}
	//upper
	if(isset($polje[$i-1][$j])){
		if(!$has_flashed[$i-1][$j]){
			$polje[$i-1][$j] += 1;
			if($polje[$i-1][$j] > 9){
				$polje[$i-1][$j] = 0;
				$has_flashed[$i-1][$j] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i-1,$j);
			}
		}			
	}
	// upper right
	if(isset($polje[$i-1][$j+1])){
		if(!$has_flashed[$i-1][$j+1]){
			$polje[$i-1][$j+1] += 1;
			if($polje[$i-1][$j+1] > 9){
				$polje[$i-1][$j+1] = 0;
				$has_flashed[$i-1][$j+1] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i-1,$j+1);
			}
		}			
	}
	// left
	if(isset($polje[$i][$j-1])){
		if(!$has_flashed[$i][$j-1]){
			$polje[$i][$j-1] += 1;
			if($polje[$i][$j-1] > 9){
				$polje[$i][$j-1] = 0;
				$has_flashed[$i][$j-1] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i,$j-1);
			}
		}			
	}
	//right
	if(isset($polje[$i][$j+1])){
		if(!$has_flashed[$i][$j+1]){
			$polje[$i][$j+1] += 1;
			if($polje[$i][$j+1] > 9){
				$polje[$i][$j+1] = 0;
				$has_flashed[$i][$j+1] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i,$j+1);
			}
		}			
	}
	//bottom left
	if(isset($polje[$i+1][$j-1])){
		if(!$has_flashed[$i+1][$j-1]){
			$polje[$i+1][$j-1] += 1;
			if($polje[$i+1][$j-1] > 9){
				$polje[$i+1][$j-1] = 0;
				$has_flashed[$i+1][$j-1] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i+1,$j-1);
			}
		}			
	}
	// bottom
	if(isset($polje[$i+1][$j])){
		if(!$has_flashed[$i+1][$j]){
			$polje[$i+1][$j] += 1;
			if($polje[$i+1][$j] > 9){
				$polje[$i+1][$j] = 0;
				$has_flashed[$i+1][$j] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i+1,$j);
			}
		}			
	}
	// bottom right
	if(isset($polje[$i+1][$j+1])){
		if(!$has_flashed[$i+1][$j+1]){
			$polje[$i+1][$j+1] += 1;
			if($polje[$i+1][$j+1] > 9){
				$polje[$i+1][$j+1] = 0;
				$has_flashed[$i+1][$j+1] = True;
				$flashes += 1;
				flash($polje,$flashes,$has_flashed,$i+1,$j+1);
			}
		}			
	}
}

function generate_field(){
	$neki = array();
	for($i = 0;$i < 10;$i++){
		for($j = 0;$j < 10;$j++){
			$neki[$i][$j] = False;
		}
	}
	return $neki;
}
function part2($polje){
	for($i = 0;$i < 2000;$i++){
		$has_flashed = generate_field();
		step($polje,$flashes,$has_flashed);
		if(check_array($polje)){
			return $i+1;
		}
	}
}


function check_array($polje){
	for($i = 0;$i < 10;$i++){
		for($j = 0;$j < 10;$j++){
			if($polje[$i][$j] != 0){
				return False;
			}
		}
	}
	return True;
}
$lines = explode("\n",file_get_contents("input_day11.txt"));
$polje = array();
foreach($lines as $line){
	$line = trim($line);
	$vrstica = str_split($line);
	$vrstica = array_map('intval',$vrstica);
	array_push($polje,$vrstica);
}

echo "Part 1 resitev je: ".part1($polje)."\n";
echo "Part 2 resitev je: ".part2($polje)."\n";


?>