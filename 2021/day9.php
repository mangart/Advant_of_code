<?php
function part1($polje){
	$lokacije = get_low_point_locations($polje);
	$vsota = 0;
	foreach($lokacije as $lok){
		$i = $lok[0];
		$j = $lok[1];
		$vsota += $polje[$i][$j] + 1;
	}
	return $vsota;
}

// gets i and j indexses of low point location
function get_low_point_locations($polje){
	$tocke = array();
	for($i = 0;$i < count($polje);$i++){
		for($j = 0;$j < count($polje[$i]);$j++){
			// top left edge
			if($i == 0 && $j == 0){
				if($polje[$i][$j] < $polje[$i+1][$j] && $polje[$i][$j] < $polje[$i][$j+1]){
					array_push($tocke,array($i,$j));
				}
			}
			// top right edge
			else if($i == 0 && $j == (count($polje[$i])-1)){
				if($polje[$i][$j] < $polje[$i+1][$j] && $polje[$i][$j] < $polje[$i][$j-1]){
					array_push($tocke,array($i,$j));
				}
			}
			// lower left edge
			else if($i == (count($polje)-1) && $j == 0){
				if($polje[$i][$j] < $polje[$i-1][$j] && $polje[$i][$j] < $polje[$i][$j+1]){
					array_push($tocke,array($i,$j));
				}
			}
			// lower right edge
			else if($i == (count($polje)-1) && $j == (count($polje[$i])-1)){
				if($polje[$i][$j] < $polje[$i-1][$j] && $polje[$i][$j] < $polje[$i][$j-1]){
					array_push($tocke,array($i,$j));
				}
			}
			// top side
			else if($i == 0){
				if($polje[$i][$j] < $polje[$i][$j-1] && $polje[$i][$j] < $polje[$i+1][$j] && $polje[$i][$j] < $polje[$i][$j+1]){
					array_push($tocke,array($i,$j));
				}
			}
			// bottom side
			else if($i == (count($polje)-1)){
				if($polje[$i][$j] < $polje[$i][$j-1] && $polje[$i][$j] < $polje[$i-1][$j] && $polje[$i][$j] < $polje[$i][$j+1]){
					array_push($tocke,array($i,$j));
				}
			}
			// left side
			else if($j == 0){
				if($polje[$i][$j] < $polje[$i-1][$j] && $polje[$i][$j] < $polje[$i][$j+1] && $polje[$i][$j] < $polje[$i+1][$j]){
					array_push($tocke,array($i,$j));
				}
			}
			// right side 
			else if($j == (count($polje[$i])-1)){
				if($polje[$i][$j] < $polje[$i-1][$j] && $polje[$i][$j] < $polje[$i][$j-1] && $polje[$i][$j] < $polje[$i+1][$j]){
					array_push($tocke,array($i,$j));
				}
			}
			// every other possible option is middle
			else{
				if($polje[$i][$j] < $polje[$i-1][$j] && $polje[$i][$j] < $polje[$i][$j-1] && $polje[$i][$j] < $polje[$i+1][$j] && $polje[$i][$j] < $polje[$i][$j+1]){
					array_push($tocke,array($i,$j));
				}
			}
		}
	}
	return $tocke;
}
function part2($polje){
	$lokacije = get_low_point_locations($polje);
	$obiskane = array();
	$velikosti = array();
	foreach($lokacije as $lok){
		array_push($velikosti,potuj($polje,$lok[0],$lok[1],$obiskane));
	}
	rsort($velikosti);
	return $velikosti[0] * $velikosti[1] * $velikosti[2];
}

// returns the size of the basin (number of possitions that are inside a basin
function potuj($polje,$i,$j,&$obiskani){
	$vsota = 0;
	$obiskani[$i][$j] = 1;
	if(isset($polje[$i-1][$j]) && !isset($obiskani[$i-1][$j]) && $polje[$i-1][$j] < 9){
		$vsota += potuj($polje,$i-1,$j,$obiskani);
	}
	if(isset($polje[$i+1][$j]) && !isset($obiskani[$i+1][$j]) && $polje[$i+1][$j] < 9){
		$vsota += potuj($polje,$i+1,$j,$obiskani);
	}
	if(isset($polje[$i][$j-1]) && !isset($obiskani[$i][$j-1]) && $polje[$i][$j-1] < 9){
		$vsota += potuj($polje,$i,$j-1,$obiskani);
	}
	if(isset($polje[$i][$j+1]) && !isset($obiskani[$i][$j+1]) && $polje[$i][$j+1] < 9){
		$vsota += potuj($polje,$i,$j+1,$obiskani);
	}
	return $vsota + 1;
}


$lines = explode("\n",file_get_contents("input_day9.txt"));
$polje = array();
foreach($lines as $line){
	$line = trim($line);
	$vrstica = array_map('intval',str_split($line));
	array_push($polje,$vrstica);
}
//var_dump($polje);
echo "Part 1 resitev je: ".part1($polje)."\n";
echo "Part 2 resitev je: ".part2($polje)."\n";

?>