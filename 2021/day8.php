<?php
// not optimal solution
function part1($output){
	$vsota = 0;
	foreach($output as $out){
		foreach($out as $ou){
			$ou = trim($ou);
			$dolzina = strlen($ou);
			switch ($dolzina) {
				case 2:
					$vsota += 1;
					break;
				case 3:
					$vsota += 1;
					break;
				case 4:
					$vsota += 1;
					break;
				case 7:
					$vsota += 1;
					break;
			}			
		}
	}
	return $vsota;
}

// very space efficient solution
function part2($output){
	$unikatni = get_unique($output);
	var_dump($unikatni);
}

function get_unique($output){
	$unikatni = array();
	foreach($output as $out){
		foreach($out as $ou){
			$ou = trim($ou);
			$dolzina = strlen($ou);
			switch ($dolzina) {
				case 2:
					$unikatni[1] = $ou;
					break;
				case 3:
					$unikatni[7] = $ou;
					break;
				case 4:
					$unikatni[4] = $ou;
					break;
				case 7:
					$unikatni[8] = $ou;
					break;
			}			
		}
	}
	return $unikatni;
}



$lines = explode("\n",file_get_contents("input_day8_example.txt"));
$values = array();
$output = array();
foreach($lines as $line){
	$vrstica = explode(" | ",$line);
	$values1 = explode(" ",$vrstica[0]);
	$output1 = explode(" ",$vrstica[1]);
	array_push($values,$values1);
	array_push($output,$output1);
}
var_dump($output);
echo "Part 1 resitev je: ".part1($output)."\n";
echo "Part 2 resitev je: ".part2($output)."\n";

?>